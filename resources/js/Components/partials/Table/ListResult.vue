<template>
    <div class="row mt-3 ">
        <div v-if="fossils?.data?.length > 0" class="col list-view">
            <div v-for="item in fossils.data" :key="item.id" class="list-view-item" @click="onClickItem($event, item)">
                <div class="list-view-photo">
                    <img class="img-fluid" :src="getPath( item )" alt="image default">
                </div>
                <div class="list-view-content">
                    <div class="list-view-id">
                        <p class="text-m fw-600">{{ getTitle(item) }}</p>
                    </div>
                    <div class="list-view-description">
                        <h3 class="heading-m divider-right-dash flex-wrap">
                            <TaxonomyValue :identify="item.fossil_identify" ></TaxonomyValue>
                            <StarVotes :fossil="item" :identify="item.fossil_identify" :show-big="true"></StarVotes>
                        </h3>
                        <div class="text-s d-flex divider-right flex-wrap">
                            <span>{{ $t('components.modal_view.date_find') }} {{ item.created_at }}</span>
                            <span>{{ $t('components.modal_view.founded_by') }} {{ item.user.username ?? $t('general.anonymous') }}</span>
                            <span v-if="item.validated_fossil && !item.fossil_identify?.vote_curator">{{ $t('components.modal_view.community_validated') }}</span> <!-- Validar votos -->
                            <span v-if="item.fossil_identify?.vote_curator">{{ $t('components.modal_view.expert_validated') }}</span> <!-- Este voto solo lo hace el curator-->
                            <span v-if="item.vote_scientific">{{ $t('components.modal_view.scientific_validated') }}</span> <!-- Este voto solo lo hace el curator-->
                            <span v-if="item.vote_danekrae">{{ $t('components.modal_view.danekrae_validated') }}</span> <!-- Este voto solo lo hace el admin -->
                        </div>
                    </div>
                    <div class="list-view-action">
                        <Wizard
                            v-if="user"
                            @ok="onNotify"
                            :options="$page.props.curators"
                            :title="$t('components.modal_view.notify_action')"
                            :subtitle="$t('components.wizzard.notify_action_title')"
                            :question="$t('components.wizzard.question_notify')"
                            :actionText="$t('form.select')"
                            :custom-button="'btn-mit-3'"
                            :sub-options="['region', 'speciality']"
                            :show-clear="false">
                        </Wizard>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="!fossils || fossils?.data?.length === 0" class="col bg-white border-light shadow rounded p-0 col-divider">
            <div class="row p-4 text-center">
                <div class="col">
                    {{ $t('components.card_table.not_found') }}
                </div>
            </div>
        </div>

        <loading :show="loading"></loading>
    </div>
</template>

<script setup>
import {useFossil} from "@/Composables/useFossil";
import {computed, onMounted, onUnmounted, ref} from "vue";
import {useFilterStore} from "@/Core/stores/filterStore";
import emitter from 'tiny-emitter/instance';
import TaxonomyValue from "@/Components/partials/Table/TaxonomyValue.vue";
import StarVotes from "@/Components/partials/Modal/StarVotes.vue";
import Wizard from "@/Components/Wizard.vue";
import {sendNotify} from "@/Composables/useNotification";
import {usePage} from "@inertiajs/vue3";
import Loading from "@/Components/partials/Loading.vue";

const fossils = ref({});
const loading = ref(false);
const store = useFilterStore();
const user = usePage().props.auth.user;

const props = defineProps({
   origin: { type: String, required: true }
});

const { acciones, getPath } = useFossil();

async function loadFossil(params, page) {
    loading.value = true;

    const accion = acciones.get( props.origin );

    if(accion) {
        const result = await accion(params, page);

        if(page) {
            fossils.value.current_page = result.current_page;
            fossils.value.next_page_url = result.next_page_url;
            fossils.value.data = [ ...fossils.value.data, ...result.data ];
        } else {
            fossils.value = result;
        }
    }

    loading.value = false;
}

onMounted(async () => {
    window.addEventListener( 'scroll', onScroll );

    const opt = {
        search: store.search,
        noValidated: store.noValidated,
        noClassified: store.noClassified,
        filter: store.filter
    }

    await loadFossil(opt, null);

    emitter.on('filter-fossil', async (opt) => {
        await loadFossil(opt, null);
    });
});

onUnmounted(() => {
    window.removeEventListener('scroll', onScroll);

    emitter.off('filter-fossil');
});

async function onScroll(event) {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        if(fossils.value.next_page_url) {
            // Si se llega al final de la página, cargar más datos
            const opt = {
                search: store.search,
                noValidated: store.noValidated,
                noClassified: store.noClassified,
                filter: store.filter
            }

            await loadFossil(opt, fossils.value.current_page + 1);
        }
    }
}

function onClickItem(event, item) {
    if(!event.target.classList.contains('btn-mit-3') &&
        !event.target.classList.contains('wz')) {
        emitter.emit('show_fossil', item);
    }
}

async function onNotify(curator) {
    const data = {
        user_id: user.id,
        user_curator_id: curator.value,
        fossil_id: fossil.value.id,
    }

    const result = await sendNotify(data);
}

const getTitle = (fossil) => {
    let result = '';

    if(user && fossil.user_id === user.id) {
        if(fossil.personal_id !== null){
            result += fossil.personal_id;
        }
    } else {
        result += '#'+fossil.id;
    }

    return result;
};
</script>
