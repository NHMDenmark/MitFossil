import axios from 'axios';

export const saveImage = async (request) => {
    const { data } = await axios.post( route('api.admin.resources.store'), request);

    return data.path;
}
