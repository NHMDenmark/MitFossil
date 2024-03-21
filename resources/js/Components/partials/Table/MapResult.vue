<template>
    <div>
        <div class="row mt-3 mb-3" >
            <div class="col-12">
                <div id="divMap" style="width: 100%; height: 80vh; max-height: 600px;"></div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {useGoogleMaps} from "@/Composables/useGoogleMaps";
import {useFossil, getLowesTaxonomy} from "@/Composables/useFossil";
import {useFilterStore} from "@/Core/stores/filterStore";
import jquery from 'jquery';
import emitter from 'tiny-emitter/instance';
import {computed, onMounted, onUnmounted} from "vue";
import {useI18n} from "vue-i18n";
import {usePage} from "@inertiajs/vue3";

const store = useFilterStore();
const { getPath, acciones } = useFossil();
const { t } = useI18n({});
let timeoutId = null;
let clicked = false;
const user = usePage().props.auth.user;

const props = defineProps({
    origin: { type: String, required: true }
});

const scope = {
    map: null,
    setMarker: null,
    clearMarkers: null,
    fossils: [],
    ref: null
};

onMounted(() => {
    emitter.on('filter-fossil', async (opt) => {
        await loadData(opt);
    });
});

onUnmounted(() => {
    emitter.off('filter-fossil');
})

const onLoadMap = async (map, setMarker, setInfoWindows, clearMarkers) => {
    scope.map = map;
    scope.setMarker = setMarker;
    scope.clearMarkers = clearMarkers;
    scope.ref = jquery( '#divMap' );
}

const onBoundChange = (event) => {
    if(!clicked) {
        if(timeoutId) {
            clearTimeout(timeoutId);
        }

        timeoutId = setTimeout(async () => {
            const opt = {
                search: store.search,
                noValidated: store.noValidated,
                noClassified: store.noClassified,
                filter: store.filter
            }

            await loadData(opt);

            timeoutId = null;
        }, 300);
    }
}

const onBeforeInfo = () => {
    clicked = true;
}

const onMarkerClick = () => {
    setTimeout(() => {
        const elMarker = scope.ref.find('.map-marker');

        elMarker.click( (event) => {
            event.preventDefault();
            const id = elMarker.data('id');
            const fossil = scope.fossils.find((x) => x.id === id);
            emitter.emit('show_fossil', fossil);
        })

        clicked = false;
    }, 200);
}

function getBounds(options) {
    const bounds = scope.map.getBounds();
    const southWest = bounds.getSouthWest();
    const northEast = bounds.getNorthEast();

    return  {
        map: {
            minLat: southWest.lat(),
            minLng: southWest.lng(),
            maxLat: northEast.lat(),
            maxLng: northEast.lng()
        },
        search: options.search,
        filter: options.filter
    };
}

function numerStar (fossil) {
    let result = 0;

    if(fossil.validated_fossil) {
        result++;
    }

    if(fossil.fossil_identify.vote_curator) {
        result++;
    }

    if(fossil.vote_scientific){
        result++;
    }

    if(((fossil.fossil_identify.vote_curator) || (fossil.vote_scientific)) && !(fossil.validated_fossil)) {
        result++;
    }

    return result;
}

function danekraeStar (fossil) {
    let result = 0;

    if(fossil.vote_danekrae){
        result++;
    }

    return result;
}

async function loadData(options = null) {
    const accion = acciones.get( props.origin );

    if(!accion) return;

    scope.fossils = await accion(getBounds(options), null);

    scope.clearMarkers();

    for(let i in scope.fossils ) {
        const fossil = scope.fossils[i];
        const latLng = { lat: fossil.latitude, lng: fossil.longitude };

        const identify = fossil.fossil_identify;
        let lower = getLowesTaxonomy( identify, t('form.unknown'));

        const commom = identify && (identify.fossil_common !== t('form.unknown') || lower !== t('form.unknown')) ? '<span>' + identify.fossil_common + '</span>' : '';

        lower = `<span>${ lower }</span>`;

        let stars = numerStar(fossil)
        let starsString = '';

        if(stars > 0) {
            starsString += `<i class="fa-solid fa-star"></i>`;
        }

        if(stars > 1) {
            starsString += `<i class="fa-solid fa-star"></i>`;
        }

        if(stars > 2) {
            starsString += `<i class="fa-solid fa-star"></i>`;
        }

        let danekraeStars = danekraeStar(fossil)

        if(danekraeStars > 0) {
            starsString += `<i class="fa-solid fa-star c-light-green"></i>`;
        }

        let title = '#';

        if(user && fossil.user_id === user.id) {
            title += fossil.personal_id;
        } else {
            title += fossil.id;
        }

        const contentString = `
            <a href="#" class="map-marker" data-id="${fossil.id}" style="text-decoration: none;">
                <div class="map-container map-fossil">
                    <figure class="figure map-figure">
                        <img src="${ getPath(fossil) }" class="figure-img img-fluid mb-0" alt="${ fossil.identifier }">
                    </figure>
                    <div class="p-3">
                        <h4 class="heading-s d-flex flex-wrap divider-right-dash fw-700">
                            ${ commom }
                            ${ lower } 
                        </h4>
                        <div class="text-s d-flex flex-column text-center">
                          <span class="w-100 text-center mb-2 d-flex gap-1 justify-content-center">${ starsString }</span>
                        </div>
                        <div class="text-s d-flex flex-column text-center">
                            <span>${ t('components.modal_view.date_find') } ${ fossil.created_at }</span>
                            <span>${ t('components.modal_view.founded_by') } ${ fossil.user.username }</span>
                        </div>
                    </div>
                </div>
            </a>`;

        if(!fossil.hide_location) {
            scope.setMarker(
                { position: latLng, title: fossil.common, canClick: true },
                { content: contentString, ariaLabel: fossil.common, maxHeight: 300 });
        }
    }
}

useGoogleMaps({
    name: 'divMap',
    onLoadMap: onLoadMap,
    onBoundChange: onBoundChange,
    onBeforeInfo: onBeforeInfo,
    onMarkerClick: onMarkerClick,
    zoom: 7,
    lat: 56.21384,
    lng: 11.573501,
    mapTypeControl: true
});
</script>
