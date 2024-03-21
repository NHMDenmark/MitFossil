<script setup>
import {useGoogleMaps} from "@/Composables/useGoogleMaps";
import { getIdentify } from "@/Composables/useFossil";

const props = defineProps({
    fossil: { type: Object }
});

const onLoadMap = (map, setMarker) => {
    const latLng = { lat: props.fossil.latitude, lng: props.fossil.longitude };
    const identify = getIdentify(props.fossil);

    setMarker({ position: latLng, title: identify?.fossil_common, canClick: false });

    map.setCenter(latLng);
    map.setZoom(12);
}

useGoogleMaps({
    name: 'miniMap',
    onLoadMap: onLoadMap,
    zoom: 6,
    lat: 56.221384,
    lng: 11.573501,
    mapTypeControl: true
});


</script>

<template>
    <div class="row">
        <div class="col-12">
            <div id="miniMap" style="width: 100%; height: 300px"></div>
        </div>
    </div>
</template>
