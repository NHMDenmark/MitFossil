<script setup>
import {Head} from "@inertiajs/vue3";
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
import CardSearch from "@/Components/partials/Search/CardSearch.vue";
import CardTable from "@/Components/partials/Table/CardTable.vue";
import ModalView from "@/Components/partials/Modal/ModalView.vue";
import {onMounted} from "vue";
import emitter from 'tiny-emitter/instance';
import {useFilterStore} from "@/Core/stores/filterStore";

const store = useFilterStore();

const props = defineProps({
    fossil: { type: Object }
})

onMounted(() => {
    if(props.fossil) {
        emitter.emit('show_fossil', props.fossil);
    }

  store.noValidated = false;
  store.noClassified = false;
  store.search = null;
  store.filter = {
    newest: 'newest',
    taxonomy: null,
    age: null,
    date: null,
  };
});
</script>

<template>
    <Head :title="$t('pages.emuseum.fossil_title')" />

    <CustomerLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="d-flex flex-column flex-xl-row gap-45 align-items-start">
                <CardSearch :title="$t('pages.emuseum.fossil_title')" :origin="$page.props.origin"></CardSearch>
            </div>
            <div class="row mt-5">
                <CardTable :origin="$page.props.origin"></CardTable>
            </div>
        </div>

        <ModalView></ModalView>
    </CustomerLayout>
</template>
