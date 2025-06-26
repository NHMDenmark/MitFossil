<script setup>
import Modal from "@/Components/Modal.vue";
import emitter from 'tiny-emitter/instance'
import {computed, onMounted, onUnmounted, ref} from 'vue';
import Gallery from "./Gallery.vue";
import Map from "./Map.vue";
import Location from "./Location.vue";
import Classification from "./Classification.vue";
import GeologicalContext from "./GeologicalContext.vue";
import Lithostratigraphy from "./Lithostratigraphy.vue";
import Dimensions from "./Dimensions.vue";
import Notes from "./Notes.vue";
import Identifies from "./Identifies.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {router, usePage} from "@inertiajs/vue3";
import {getIdentifyData, getUserVotes, active_fossil, desactive_fossil} from "@/Composables/useFossil";
import {sendNotify, sendReport} from "@/Composables/useNotification";
import {useForm} from "@inertiajs/vue3";
import TaxonomyValue from "@/Components/partials/Table/TaxonomyValue.vue";
import StarVotes from "@/Components/partials/Modal/StarVotes.vue";
import NewSuggest from "@/Components/partials/Modal/NewSuggest.vue";
import Wizard from "@/Components/Wizard.vue";
import WizardReport from "@/Components/WizardReport.vue";
import Comments from "@/Components/partials/Modal/Comments.vue";
import { useI18n } from "vue-i18n";

const modalView = ref();
const modalConfirm = ref();
const modalNotified = ref();
const modalConfitmTitle = ref('');
const modalConfitmText = ref('');
let modalConfirmAction = '';
const fossil = ref({});
const origin = usePage().props.origin;
const user = usePage().props.auth.user;
const rule = usePage().props.auth.rule;
const showNewIdentify = ref(false);
const identify_data = ref({});
const { t } = useI18n();

const formDelete = useForm({
    fossil_id: null,
    action: null,
    origin: origin
});

onMounted(async () => {
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

<template>
    <Modal @hide="fossil = {}" ref="modalView" :title="title" :width="80" :textOkButton="$t('components.modal.ok')" :show-cancel-button="false">
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
                    <a :href="`/fossil/${fossil.id}`">Åbn som link</a>
                </div>
            </div>
            <div class="row mt-3 row-buttons row-buttons-popup">
                <div class="col-12">
                    <div class="d-flex flex-wrap gap-2">
                        <PrimaryButton @click="modalView.hide();" :url="route('customer.new-fossil.edit', fossil.id) + '?origin=' + $page.props.origin" v-if="fossil.user_id === user?.id || canCuratorAction" class="d-inline">{{ $t('components.modal_view.edit_action') }}</PrimaryButton>
                        <!--<PrimaryButton @click="notifyDeleteFossil" v-if="fossil.user_id === user?.id || (canCuratorAction && !fossil.send_delete) && user?.role === 'admin'" class="d-inline">{{ $t('components.modal_view.notify_delete_action') }}</PrimaryButton>-->
                        <PrimaryButton @click="notifyDeleteFossil" v-if="fossil.user_id === user?.id" class="d-inline">{{ $t('components.modal_view.notify_delete_action') }}</PrimaryButton>
                        <PrimaryButton @click="deleteFossil" v-if="user?.role === 'admin'" class="d-inline">{{ $t('components.modal_view.delete_action') }}</PrimaryButton>
                        <PrimaryButton @click="deleteFossilReport" v-if="user?.role === 'admin'" class="d-inline">{{ $t('components.modal_view.delete_action_report') }}</PrimaryButton>
                        <Wizard
                            v-if="$page.props.auth.user"
                            @ok="onNotify"
                            :options="$page.props.curators"
                            :title="$t('components.modal_view.notify_action')"
                            :subtitle="$t('components.wizzard.notify_action_title')"
                            :question="$t('components.wizzard.question_notify')"
                            :actionText="$t('form.select')"
                            :sub-options="['region', 'speciality']"
                            :show-clear="false">
                        </Wizard>
                        <WizardReport
                            v-if="$page.props.auth.user"
                            @ok="onReport2"
                            :options="$page.props.curators"
                            :title="$t('components.modal_view.report_action')"
                            :report_action_inappropriate="$t('components.modal_view.report_action_inappropriate')"
                            :report_action_not_fossil="$t('components.modal_view.report_action_not_fossil')"
                            :report_action_comment="$t('components.modal_view.report_action_comment')"
                            :subtitle="$t('components.modal_view.report_action_title')"
                            :question="$t('components.modal_view.report_wizard_question')"
                            :back="$t('components.modal_view.report_wizard_back')"
                            :ok="$t('components.modal_view.report_wizard_ok')">
                        </WizardReport>
                        <!--<PrimaryButton @click="onReport" v-if="user?.role !== 'admin'" class="d-inline"> {{ $t('components.modal_view.report_action') }}</PrimaryButton>-->
                        <PrimaryButton @click="onDesactiveFossil" v-if="fossil.active === 1 && canCuratorAction" class="d-inline"> {{ $t('form.desactive') }}</PrimaryButton>
                        <PrimaryButton @click="onActiveFossil" v-if="fossil.active === 0 && canCuratorAction" class="d-inline"> {{ $t('form.active') }}</PrimaryButton>
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

            <div class="mt-3">
                <PrimaryButton v-if="user && !showNewIdentify" @click="showNewIdentify = true" :variant="'normal'">
                    {{ $t('components.identifies.suggest_identification') }}
                </PrimaryButton>
            </div>

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
            :textOkButton="$t('components.modal.accept')">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <p class="text-m">Den valgte kurator har nu modtaget din anmodning om hjælp. Kuratorerne er frivillige, så svartiden kan variere.</p>
                    </div>
                </div>
            </div>
        </Modal>

    </Modal>
</template>
