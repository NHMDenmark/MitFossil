import axios from 'axios';

export const getNews = async (request) => {
    const { data } = await axios.get(route('api.customer.news'));

    return data.news;
}
