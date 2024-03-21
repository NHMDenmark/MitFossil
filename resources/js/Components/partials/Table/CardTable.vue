<template>
    <div class="col">
        <div v-if="showActions" class="row mt-3 select-view">
            <div class="col">
                <InputCheck v-if="showList && (showMap || showGallery)" class="d-inline-flex me-4 mb-2" id="v-list" v-model="view" value="list">{{ $t('components.card_table.view_list') }}</InputCheck>
                <InputCheck v-if="showMap && (showList || showGallery)" class="d-inline-flex me-4 mb-2" id="v-map" v-model="view" value="map">{{ $t('components.card_table.view_map') }}</InputCheck>
                <InputCheck v-if="showGallery && (showMap || showList)" class="d-inline-flex me-4 mb-2" id="v-gallery" v-model="view" value="gallery">{{ $t('components.card_table.view_gallery') }}</InputCheck>
            </div>
        </div>

        <ListResult v-if="showList && view === 'list'" :origin="origin"></ListResult>
        <MapResult v-if="showMap && view === 'map'" :origin="origin"></MapResult>
        <GalleryResult v-if="showGallery && view === 'gallery'" :origin="origin"></GalleryResult>
    </div>
</template>

<script setup>
import {computed, onMounted, ref} from 'vue';
import InputCheck from "@/Components/InputCheck.vue";
import ListResult from "./ListResult.vue";
import MapResult from "./MapResult.vue";
import GalleryResult from "./GalleryResult.vue";

const view = ref(null);

const props = defineProps({
    showList: { type: Boolean, default: true },
    showMap: { type: Boolean, default: true },
    showGallery: { type: Boolean, default: true },
    showDefault: { type: String, default: 'list' },
    origin: { type: String, required: true },
});

onMounted(() => {
    view.value = props.showDefault ?? 'list';
});

const showActions = computed(() => {
   const result = props.showList ? 1 : 0 +
       props.showMap ? 1 : 0 +
       props.showGallery ? 1 : 0;

   return result > 0;
});
</script>
