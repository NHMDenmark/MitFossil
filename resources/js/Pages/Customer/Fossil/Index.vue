<template>
    <Head :title="`Fossil #${fossil.id}`" />
    <CustomerLayout>
        <div class="fossil-container">
            <div v-if="fossil.id" class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h1 class="heading-xl flex-wrap">
                            <TaxonomyValue :identify="fossil.fossil_identify"></TaxonomyValue>
                            <StarVotes :fossil="fossil" :identify="fossil.fossil_identify" :show-big="true"></StarVotes>
                        </h1>
                        <div class="text-s d-flex divider-right flex-wrap">
                            <span>{{ $t('components.modal_view.date_find') }} {{ fossil.created_at }}</span>
                            <span>{{ $t('components.modal_view.founded_by') }} <strong> {{ fossil.user.username ?? $t('general.anonymous') }} </strong></span>
                            <span v-if="fossil.validated_fossil && !fossil.fossil_identify?.vote_curator">{{ $t('components.modal_view.community_validated') }}</span> <!-- Validar votos -->
                            <span v-if="fossil.fossil_identify?.vote_curator">{{ $t('components.modal_view.expert_validated') }}</span> <!-- Este voto solo lo hace el curator-->
                            <span v-if="fossil.vote_scientific">{{ $t('components.modal_view.scientific_validated') }}</span> <!-- Este voto solo lo hace el curator-->
                            <span v-if="fossil.vote_danekrae">{{ $t('components.modal_view.danekrae_validated') }}</span> <!-- Este voto solo lo hace el admin -->
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <Gallery :images="fossil.images" :rule="fossil.copyright_rule">
                            <Map :fossil="fossil" v-if="showMap && (fossil.latitude !== null && fossil.longitude !== null)" />
                        </Gallery>
                    </div>
                </div>

                <Identifies :fossil="fossil"></Identifies>

                <Transition name="slide-fade">
                    <NewSuggest v-if="showNewIdentify" :fossil="fossil" :data="identify_data" @close="showNewIdentify = false"></NewSuggest>
                </Transition>

                <Comments :comments="fossil.fossil_comments" :fossil="fossil"></Comments>

                <div class="fossil-details row mt-3">
                    <div class="col-12 col-lg-6">
                        <Classification :fossil="fossil"></Classification>

                        <GeologicalContext :fossil="fossil"></GeologicalContext>
                    </div>
                    <div class="col-12 col-lg-6">
                        <lithostratigraphy :fossil="fossil"></lithostratigraphy>
                        <Location :fossil="fossil" :show-map="showMap"></Location>
                    </div>
                    <div class="col-12 col-lg-6">
                        <Dimensions :fossil="fossil"></Dimensions>
                        <Notes :fossil="fossil"></Notes>
                    </div>
                </div>
            </div>

            <Modal
                ref="modalConfirm"
                :show-cancel-button="true"
                :title="modalConfitmTitle"
                :text-cancel-button="$t('components.modal.cancel')"
                :textOkButton="$t('components.modal.accept')"
                @ok="onOkConfirm">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <p class="text-m">  {{ modalConfitmText }} </p>
                        </div>
                    </div>
                </div>
            </Modal>

            <Modal
                ref="modalNotified"
                :show-cancel-button="true"
                textOkButton="OK">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <p class="text-m">Den valgte kurator har nu modtaget din anmodning om hjælp. Kuratorerne er frivillige, så svartiden kan variere. Kuratorerne er også eksperter på hvert deres område, så de kan ikke nødvendigvis hjælpe med alle anmodninger.</p>
                        </div>
                    </div>
                </div>
            </Modal>
        </div>
    </CustomerLayout>
</template>
<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import emitter from 'tiny-emitter/instance'
import Wizard from "@/Components/Wizard.vue";
import Notes from "@/Components/partials/Modal/Notes.vue";
import NewSuggest from "@/Components/partials/Modal/NewSuggest.vue";
import Location from "@/Components/partials/Modal/Location.vue";
import Dimensions from "@/Components/partials/Modal/Dimensions.vue";
import StarVotes from "@/Components/partials/Modal/StarVotes.vue";
import WizardReport from "@/Components/WizardReport.vue";
import Gallery from "@/Components/partials/Modal/Gallery.vue";
import GeologicalContext from "@/Components/partials/Modal/GeologicalContext.vue";
import Map from "@/Components/partials/Modal/Map.vue";
import Comments from "@/Components/partials/Modal/Comments.vue";
import Lithostratigraphy from "@/Components/partials/Modal/Lithostratigraphy.vue";
import TaxonomyValue from "@/Components/partials/Table/TaxonomyValue.vue";
import Identifies from "@/Components/partials/Modal/Identifies.vue";
import Classification from "@/Components/partials/Modal/Classification.vue";
import Modal from "@/Components/Modal.vue";
import {computed, onMounted, onUnmounted, ref} from "vue";
import {Head, useForm, usePage} from "@inertiajs/vue3";
import {useI18n} from "vue-i18n";
import {active_fossil, desactive_fossil, getIdentifyData, getUserVotes} from "@/Composables/useFossil";
import {sendNotify, sendReport} from "@/Composables/useNotification";
import CustomerLayout from "@/Layouts/CustomerLayout.vue";


const modalView = ref();
const modalConfirm = ref();
const modalNotified = ref();
const modalConfitmTitle = ref('');
const modalConfitmText = ref('');
let modalConfirmAction = '';
let fossil = ref({});
const origin = usePage().props.origin;
const user = usePage().props.auth.user;
const rule = usePage().props.auth.rule;
const showNewIdentify = ref(false);
const identify_data = ref({});
const { t } = useI18n();

const props = defineProps({
    fossil: { type: Object }
})

onMounted(async () => {
    fossil.value = props.fossil
    emitter.on('show_fossil', async (f) => {
        fossil.value = f;

        modalView.value.show();

        const votes = await getUserVotes( f.id );

        fossil.value.fossil_identifies.forEach((x) => {
            const vote = votes.find( (y) => y.id === x.id );

            if(vote) {
                x.vote_data = vote;
            }
        });
    });

    identify_data.value = await getIdentifyData();
})

onUnmounted(() => {
    emitter.off('show_fossil');
});

const canCuratorAction = computed(() => {
    if(!user) return false;

    return user.role === 'admin' || user.role === 'curator';
});

const title = computed(() => {
    let result = '#';
    result += fossil.value.id;

    if(fossil.value.active === 0) {
        result += `  <span class="badge bg-danger">${ t('form.desactived') }</span>`;
    }

    return result;
});

const showMap = computed(() => {
    if(fossil.value.length === 0)
        return false;

    if(fossil.value.hide_location === 1) {
        if(fossil.value.user_id !== user?.id && !canCuratorAction.value) {
            return false;
        }
    }

    return true;
});

const notifyDeleteFossil = () => {
    modalConfirmAction = 'notify-delete';
    modalConfitmTitle.value = t('components.modal_view.notify_delete_title_anmod');
    modalConfitmText.value = t('components.modal.confirm_text').replace('{0}', 'fossil');
    modalConfirm.value.show();
}

const deleteFossil = () => {
    modalConfirmAction = 'delete';
    modalConfitmTitle.value = t('components.modal_view.notify_delete_title_anmodning');
    modalConfitmText.value = t('components.modal.confirm_text').replace('{0}', 'fossil');
    modalConfirm.value.show();
}

const deleteFossilReport = () => {
    modalConfirmAction = 'delete-report';
    modalConfitmTitle.value = t('components.modal_view.notify_delete_title_anmeldt');
    modalConfitmText.value = t('components.modal.confirm_text').replace('{0}', 'fossil');
    modalConfirm.value.show();
}

const onDesactiveFossil = async () => {
    modalConfirmAction = 'desactive';
    modalConfitmTitle.value = t('form.desactive');
    modalConfitmText.value = t('components.modal.confirm_text').replace('{0}', 'fossil');
    modalConfirm.value.show();
}

const onActiveFossil = async () => {
    modalConfirmAction = 'active';
    modalConfitmTitle.value = t('form.active');
    modalConfitmText.value = t('components.modal.confirm_text').replace('{0}', 'fossil');
    modalConfirm.value.show();
}

async function onNotify(curator) {
    const data = {
        user_id: user?.id,
        user_curator_id: curator.value,
        fossil_id: fossil.value.id,
    }

    const result = await sendNotify(data);
    modalNotified.value.show()
}

async function onReport2(option) {
    const data = {
        user_id: user?.id,
        fossil_id: fossil.value.id,
        report_option: option,
    }
    const result = await sendReport(data);
}


async function onReport() {
    modalConfirmAction = 'report';
    modalConfitmTitle.value = t('components.modal_view.report_action');
    modalConfitmText.value = t('components.modal.report_text').replace('{0}', 'fossil');
    modalConfirm.value.show();
}

async function onOkConfirm() {
    formDelete.fossil_id = fossil.value.id;
    formDelete.origin = origin;

    if(modalConfirmAction === 'notify-delete') {
        formDelete.action = 'notify';

        formDelete.delete(route('customer.new-fossil.destroy'), {
            onFinish: () => {
                fossil.value.send_delete = true;
            }
        });
    } else if (modalConfirmAction === 'delete') {
        formDelete.action = 'delete';

        formDelete.delete(route('customer.new-fossil.destroy'), {
            onFinish: () => {
                modalView.value.hide();

                emitter.emit('filter-fossil', {
                    search: '',
                    noValidated: false,
                    noClassified: false
                });
            }
        });
    } else if (modalConfirmAction === 'delete-report') {
        formDelete.action = 'delete-report';

        formDelete.delete(route('customer.new-fossil.destroy'), {
            onFinish: () => {
                modalView.value.hide();

                emitter.emit('filter-fossil', {
                    search: '',
                    noValidated: false,
                    noClassified: false
                });
            }
        });
    } else if(modalConfirmAction === 'active') {
        const result = await active_fossil({ id: fossil.value.id });

        fossil.value.active = result.active ? 1 : 0;

        emitter.emit('filter-fossil', {
            search: '',
            noValidated: false,
            noClassified: false
        });
    } else if(modalConfirmAction === 'desactive') {
        const result = await desactive_fossil({ id: fossil.value.id });

        fossil.value.active = result.active ? 1 : 0;

        emitter.emit('filter-fossil', {
            search: '',
            noValidated: false,
            noClassified: false
        });
    } else if(modalConfirmAction === 'report') {
        const data = {
            user_id: user.id,
            fossil_id: fossil.value.id,
        }

        const result = await sendReport(data);

        if(result.ok) {
            fossil.value.send_report = true;
        }
    }
}
</script>
<style>
.fossil-container {
    max-width: 1200px;
    width: 98%;
    margin: 0 auto;
}
</style>
