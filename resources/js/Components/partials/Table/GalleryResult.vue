<template>
    <div class="row mt-3">
        <div v-if="fossils.data?.length > 0" class="gallery-view">
            <div class="gallery-view-item bg-white" v-for="item in fossils.data" :key="item.id" @click="onClickItem($event, item)">
                <figure>
                    <img :src="getPath(item)" alt="image default">
                    <figcaption>
                        <h3 class="heading-s title divider-right-dash my-1">
                            <TaxonomyValue :identify="item.fossil_identify"></TaxonomyValue>
                        </h3>
                        <div class="meta">
                            <span>{{ $t('components.modal_view.date_find') }} {{ item.created_at }}</span>
                            <span>{{ $t('components.modal_view.founded_by') }} {{ item.user.username ?? $t('general.anonymous') }}</span>
                        </div>
                    </figcaption>
                </figure>
                <div class="gallery-view-action">
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
        <div v-if="fossils.data?.length === 0" class="col bg-white border-light shadow rounded p-0 col-divider">
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
import {useFilterStore} from "@/Core/stores/filterStore";
import emitter from 'tiny-emitter/instance';
import {computed, onMounted, onUnmounted, ref} from "vue";
import TaxonomyValue from "./TaxonomyValue.vue";
import Wizard from "@/Components/Wizard.vue";
import {sendNotify} from "@/Composables/useNotification";
import {usePage} from "@inertiajs/vue3";
import Loading from "@/Components/partials/Loading.vue";

const fossils = ref([]);
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
        await loadFossil( opt, null );
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

            await loadFossil( opt, fossils.value.current_page + 1 );
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
</script>
