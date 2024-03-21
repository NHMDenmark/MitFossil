import axios from 'axios';

export function useFossil() {
    const getPath = (fossil, image = false) => {
        console.l
        if(image) {
            return fossil.path;
        } else {
            if(fossil.images.length > 0) {
                const img = fossil.images.find(x => x.principal);

                if(img) {
                    return img.path;
                }
            }
        }

        return '/storage/images/default.jpg';
    }

    const convertRequest = (request) => {
        const jsonString = JSON.stringify(request);

        const utf8Buffer = new TextEncoder().encode(jsonString);

        return btoa(String.fromCharCode.apply(null, utf8Buffer));
    }

    const getMyCollection = async (request, page = null) => {
        const params = convertRequest(request);
        const pPage = page ? `&page=${ page }` : '';

        const { data } = await axios.get( route('api.customer.fossil.my-collection') + '?params=' + params + pPage);

        return data.fossils;
    }

    const getIdentifyFossils = async (request, page = null) => {
        const params = convertRequest(request);
        const pPage = page ? `&page=${ page }` : '';

        const { data } = await axios.get( route('api.customer.fossil.identify') + '?params=' + params + pPage);

        return data.fossils;
    }

    const getCuratedFossils = async (request, page = null) => {
        const params = convertRequest(request);
        const pPage = page ? `&page=${ page }` : '';

        const { data } = await axios.get( route('api.customer.fossil.curated') + '?params=' + params + pPage);

        return data.fossils;
    }

    const getExpertsFossils = async (request, page = null) => {
        const params = convertRequest(request);
        const pPage = page ? `&page=${ page }` : '';

        const { data } = await axios.get( route('api.customer.fossil.experts') + '?params=' + params + pPage);

        return data.fossils;
    }

    const getOtherExpertsFossils = async (request, page = null) => {
        const params = convertRequest(request);
        const pPage = page ? `&page=${ page }` : '';

        const { data } = await axios.get( route('api.customer.fossil.fossil-experts') + '?params=' + params + pPage);

        return data.fossils;
    }

    const getMapFossils = async (request, page = null) => {
        const params = convertRequest(request);
        const pPage = page ? `&page=${ page }` : '';

        const { data } = await axios.get( route('api.customer.fossil.map') + '?params=' + params + pPage);

        return data.fossils;
    }

    const acciones = new Map();

    acciones.set('my-collection', async function(request, page) {
        return await getMyCollection( request, page );
    });

    acciones.set('identify', async function(request, page) {
        return await getIdentifyFossils(request, page);
    });

    acciones.set('curated', async function(request, page) {
        return await getCuratedFossils(request, page);
    });

    acciones.set('experts', async function(request, page) {
        return await getExpertsFossils(request, page);
    });

    acciones.set('fossil-experts', async function(request, page) {
        return await getOtherExpertsFossils(request, page);
    });

    acciones.set('curator', async function(request, page) {
        return await getOtherExpertsFossils(request, page);
    });

    acciones.set('map', async function(request, page) {
       return await getMapFossils(request, page);
    });

    return { getPath, getMyCollection, getIdentifyFossils, getCuratedFossils, getExpertsFossils, getOtherExpertsFossils, getLowesTaxonomy, acciones }
}

export function getIdentify(fossil) {
    let index = 0;

    for (let i = 0; i < fossil.fossil_identifies.length; i++ ) {
        const iden = fossil.fossil_identifies[i];

        if(iden.vote_expert) {
            index = i;
            break;
        }

        if(iden.vote_curator) {
            index = i;
        }
    }

    return fossil.fossil_identifies[index];
}

export async function voteUserIdentify(identify) {
    const { data } = await axios.post( route('api.customer.fossil.vote-user'), identify);

    return data;
}
export async function voteCuratorIdentify(identify) {
    const { data } = await axios.post( route('api.customer.fossil.vote-curator'), identify);

    return data;
}
export async function voteScientific(fossil) {
    const { data } = await axios.post( route('api.customer.fossil.vote-scientific'), fossil);

    return data;
}

export async function voteDanekrea(fossil) {
    const { data } = await axios.post( route('api.customer.fossil.vote-danekrae'), fossil);

    return data;
}

export async function saveIdentify(identify) {
    const { data } = await axios.post( route('api.customer.fossil.save-identify'), identify);

    return data;
}

export async function deleteFossil(fossil) {
    const { data } = await axios.post( route('api.customer.fossil.delete-fossil'), fossil);

    return data;
}

export async function addComment(comment) {
    const { data } = await axios.post( route('api.customer.fossil.add-comment'), comment);

    return data;
}

export async function deleteComment(comment) {
    const { data } = await axios.post( route('api.customer.fossil.delete-comment'), comment);

    return data;
}

export async function desactive_fossil(fossil) {
    const { data } = await axios.post( route('api.customer.fossil.desactive-fossil'), fossil);

    return data;
}

export async function active_fossil(fossil) {
    const { data } = await axios.post( route('api.customer.fossil.active-fossil'), fossil);

    return data;
}

export async function getIdentifyData() {
    const { data } = await axios.get( route('api.customer.fossil.identify-data'));

    return data;
}

export async function getUserVotes(fossil_id) {
    const { data } = await axios.post( route('api.customer.fossil.users-votes'),{ fossil_id: fossil_id });

    return data;
}

export function getLowesTaxonomy (identify, unknown){
    if(!identify) {
        return '';
    }

    identify.specific_epithet = identify.specific_epithet ? identify.specific_epithet : unknown;
    identify.fossil_genre = identify.fossil_genre ? identify.fossil_genre : unknown;
    identify.fossil_family = identify.fossil_family ? identify.fossil_family : unknown;
    identify.fossil_order = identify.fossil_order ? identify.fossil_order : unknown;
    identify.fossil_class = identify.fossil_class ? identify.fossil_class : unknown;
    identify.fossil_phylum = identify.fossil_phylum ? identify.fossil_phylum : unknown;
    identify.fossil_kingdom = identify.fossil_kingdom ? identify.fossil_kingdom : unknown;

    if(identify.fossil_genre && identify.fossil_genre !== unknown) {
        if(identify.specific_epithet && identify.specific_epithet !== unknown) {
            return '<i>' + identify.fossil_genre + ' ' + identify.specific_epithet + '</i>';
        } else {
            return '<i>' + identify.fossil_genre + '</i> sp.';
        }
    }
    if(identify.fossil_family && identify.fossil_family !== unknown) {
        return identify.fossil_family;
    }
    if(identify.fossil_order && identify.fossil_order !== unknown) {
        return identify.fossil_order;
    }
    if(identify.fossil_class && identify.fossil_class !== unknown) {
        return identify.fossil_class;
    }
    if(identify.fossil_phylum && identify.fossil_phylum !== unknown) {
        return identify.fossil_phylum;
    }
    if(identify.fossil_kingdom && identify.fossil_kingdom !== unknown) {
        return identify.fossil_kingdom;
    }

    return unknown;
}
