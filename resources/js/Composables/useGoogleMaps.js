import {onMounted, ref} from "vue";
import { Loader } from "@googlemaps/js-api-loader";
export function useGoogleMaps(options) {
    const isSupported = 'navigator' in window && 'geolocation' in navigator;

    const loader = new Loader({
        apiKey: 'AIzaSyDsT8Rc9NhnYDWY_TBhwEvP_W3jYLPuFYU',
    });

    onMounted( async () => {
        await loader.load();

        const divMap = document.getElementById(options.name);
        let iconName = 'green';
        let markers = [];

        const icons = {
            base: {
                scaledSize: new google.maps.Size(30, 30), // scaled size
                //origin: new google.maps.Point(0,0), // origin
                //anchor: new google.maps.Point(0, 0) // anchor
            },
            green: { url: '/storage/images/pin-green-3.svg' },
            white: { url: '/storage/images/pin-white-3.svg' },
        }

        const map = new google.maps.Map(divMap, {
            center: {
                lat: options.lat ?? 55.941231,
                lng: options.lng ?? 10.156647
            },
            zoom: options.zoom ?? 8,
            zoomControl: options.zoomControl ?? true,
            mapTypeControl: options.mapTypeControl ?? false,
            scaleControl: options.scaleControl ?? false,
            streetViewControl: options.streetViewControl ?? false,
            rotateControl: options.rotateControl ?? false,
            fullscreenControl: options.fullscreenControl ?? false,
        });

        map.addListener('maptypeid_changed', () => {
            iconName = map.getMapTypeId() === 'roadmap' ? 'green' : 'white';
            const color = icons[iconName];
            const icon = { ...icons.base, ...color };

            for(let i in markers ) {
                const m = markers[i];
                m.setIcon( icon );
            }
        });

        let actualInfo = null;

        const setMarker = (param, paramInfo) => {
            const color = icons[iconName];
            const icon = { ...icons.base, ...color };

            const markerParams = { ...param, icon: icon }
            const marker = new google.maps.Marker(markerParams);

            marker.setMap( map );

            let info = null;

            if(paramInfo) {
                info = setInfoWindows(paramInfo);
            }

            if(param.canClick === true) {
                marker.addListener("click", () => {
                    if(options.onBeforeInfo)
                        options.onBeforeInfo();

                    if(actualInfo) {
                        actualInfo.close();
                    }

                    if(info) {
                        info.open({
                            anchor: marker,
                            map,
                        });
                    }

                    actualInfo = info;

                    if(options.onMarkerClick) {
                        options.onMarkerClick();
                    }
                });
            }

            markers.push(marker);

            return marker;
        }

        const setInfoWindows = (param) => {
            return new google.maps.InfoWindow(param);
        }

        const clearMarkers = () => {
            for(let i in markers ) {
                const m = markers[i];
                m.setMap(null);
            }

            markers = [];
        }

        if(options.onBoundChange) {
            google.maps.event.addListener(map, 'bounds_changed', options.onBoundChange);
        }

        setTimeout( async() => {
            await options.onLoadMap( map, setMarker, setInfoWindows, clearMarkers );
        }, 200);

    });

    return { isSupported };
}
