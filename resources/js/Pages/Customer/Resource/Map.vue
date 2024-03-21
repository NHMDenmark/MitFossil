<script setup>
import {Link} from "@inertiajs/vue3";
import {useGoogleMaps} from "@/Composables/useGoogleMaps";
import CustomerLayout from "@/Layouts/CustomerLayout.vue";

const props = defineProps({
    map_resources: { type: Array },
    map_page: { type: Object }
});

const onLoadMap = (map, setMarker) => {
    for(let i = 0; i < props.map_resources.length; i++) {
        const item = props.map_resources[i];

        const latLng = { lat: item.latitude, lng: item.longitude };

        const contentString = `<div class="map-container map-resource p-3">
                        <h4 class="heading-s d-flex flex-column fw-700">
                            <span>${item.title}</span> <!-- item.id -->
                        </h4>
                        <div class="text text-s d-flex flex-column">
                            ${ item.text }
                        </div>
                    </div>`;

        setMarker({ position: latLng, title: item.title, canClick: true }, { content: contentString, ariaLabel: item.title });
    }
}

useGoogleMaps({
    name: 'resource_map',
    onLoadMap: onLoadMap,
    zoom: 7,
    lat: 56.221384,
    lng: 11.573501,
    mapTypeControl: true
});
</script>

<template>
    <CustomerLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="d-flex flex-column flex-xl-row gap-45 align-items-start mt-4">
                <div class="col bg-white border-light shadow rounded p-0 col-divider">
                    <div class="row p-4">
                        <h5 class="heading-s fw-700 mb-3">{{ map_page.title }}</h5>

                        <div class="p-3 mit-resource">
                            {{ map_page.text }}
                        </div>

                        <div class="flex-content container-fluid">
                            <div class="row mt-3 mb-3" >
                                <div class="col-12">
                                    <div id="resource_map"></div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-sm-end mt-3">
                            <Link :href="route('customer.resources')" class="rounded text-uppercase btn-mit">
                                {{ $t('form.back') }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </CustomerLayout>
</template>
