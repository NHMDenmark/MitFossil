import axios from "axios";

export async function sendNotify(request) {
    const { data } = await axios.post( route('api.customer.notification.notify'), request);

    return data;
}

export async function sendReport(request) {
    const { data } = await axios.post( route('api.customer.notification.report'), request);

    return data;
}
export async function sendDeletedFossil(request) {
    const { data } = await axios.post( route('api.customer.notification.deleted-fossil'), request);

    return data;
}
