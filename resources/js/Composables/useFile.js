import axios from "axios";

export async function getFiles() {
    const { data } = await axios.post( route('api.admin.files'));

    return data;
}
