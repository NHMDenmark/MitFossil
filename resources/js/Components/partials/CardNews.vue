<template>
    <div class="col">
        <div v-bind:class = "(variant !== 'home')?'border-light shadow rounded p-0 col-divider':'grid-news-home'">
            <h5 v-if="title" class="p-4 heading-s fw-700 mb-0 pb-0">{{ title }}</h5>

            <div v-for="(item, index) in news" :key="index" class="d-grid-news p-4 gap-3 gap-sm-4">
                <h5 class="heading-s fw-700 d-sm-none mb-0">{{ item.name }}</h5>
                <img :src="item.image ?? '/storage/images/default.jpg'" :alt="'new-' + index" class="img-fluid">

                <div class="news-card-content">
                    <h5 class="heading-s fw-700 d-none d-sm-block">{{ item.name }}</h5>
                    <p class="news-card-text">{{ item.description }}</p>
                    <Link class="btn-mit-2" :href="route('customer.news.show', item.endpoint)">{{ $t('form.read_more') }}</Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import {onMounted, ref} from "vue";
import { getNews } from "@/Composables/useNews";

defineProps({
    title: { type: String },
    variant: { type: String, default: 'normal' }
})

onMounted(async () => {
    news.value = await getNews();
});

const news = ref([]);
</script>
