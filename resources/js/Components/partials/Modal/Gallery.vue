<script setup>
import { useFossil } from "@/Composables/useFossil";
import {computed } from "vue";
import { api as viewerApi } from "v-viewer";

const props = defineProps({
    images: { type: Array },
    rule: { type: Object }
});

const { getPath } = useFossil();

const primary = computed(() => {
    return props.images.find(x => x.principal === 1 );
});

const others = computed(() => {
    return props.images.filter(x => x.principal === 0 );
});

function onShow(index) {
    viewerApi({
        images: props.images.map(x => getPath(x, true) ),
        options: {
            "inline": true,
            "button": true,
            "navbar": false,
            "title": (image, imageData) => `${ props.rule ? props.rule.description : image.alt }`,
            "toolbar": true,
            "tooltip": true,
            "movable": false,
            "zoomable": true,
            "rotatable": false,
            "scalable": false,
            "transition": true,
            "fullscreen": true,
            "keyboard": false,
            initialViewIndex: index
        }
    });
}
</script>

<template>
    <div class="row">
        <div class="col-12 col-lg-8">
            <div v-if="primary" class="fossil-image-container" @click="onShow(0)">
                <img :src="getPath(primary, true)" alt="image default" class="img-fluid">
            </div>
        </div>
        <div class="col-12 col-lg-4 col-map-images">
            <div class="row row-map">
                <div class="col" id="mapSection">
                    <slot></slot>
                </div>
            </div>
            <div v-if="others" class="row row-images">
                <div class="col-6" v-for="(item, index) in others" :key="item.id">
                    <div class="fossil-image-container xs" @click="onShow(index + 1)">
                        <img :src="getPath(item, true)" alt="image default" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
