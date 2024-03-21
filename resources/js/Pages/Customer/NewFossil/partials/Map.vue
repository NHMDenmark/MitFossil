<script setup>
import {useGoogleMaps} from "@/Composables/useGoogleMaps";
import InputLabel from "@/Components/InputLabel.vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n({});

const props = defineProps({
    label: { type: String },
    lat: { type: Number },
    lng: { type: Number },
    canClick: { type: Boolean }
})

let marker = null;

const emit = defineEmits(['setMarker'])

const onLoadMap = (map, setMarker) => {
    if(props.canClick) {
        google.maps.event.addListener(map, 'click', function(event) {
            if(marker) {
                marker.setMap(null);
            }

            marker = setMarker({ position: event.latLng, title: t('pages.new_fossil.position_text'), canClick: false });
            map.panTo(event.latLng);

            emit('setMarker', event.latLng);
        });
    }

    if(props.lat && props.lng) {
        const latlng = { lat: props.lat, lng: props.lng };
        marker = setMarker({ position: latlng, title: t('pages.new_fossil.position_text'), canClick: false });
        map.setCenter(latlng);
    }
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
    <div class="row mb-3">
        <div class="col-12">
            <input-label v-if="label" class="mb-3" :value="label" ></input-label>
            <div id="miniMap" style="width: 100%; height: 300px"></div>
        </div>
    </div>
</template>
