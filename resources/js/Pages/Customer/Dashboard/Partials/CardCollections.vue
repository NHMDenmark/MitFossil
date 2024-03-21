<template>
    <div class="p-4">
        <h5 class="heading-s fw-700 mb-3">{{ title }}</h5>
        <p class="mb-4"><slot></slot></p>

        <template v-if="collections.length > 0">
            <div class="d-grid d-grid-dashboard gap-4 mb-3">
                <img v-for="item in collections"
                     :key="item.id"
                     :src="getPath(item)"
                     :alt="'image-' + item.id"
                     class="img-fluid cursor-pointer"
                     @click="imageClick(item)"/>
            </div>
            <div class="d-flex justify-content-sm-end">
                <Link :href="url" class="rounded text-uppercase btn-mit">
                    {{ $t('form.see_more') }}
                </Link>
            </div>
        </template>

        <template v-if="collections.length === 0">
            <div class="text-center">
                <strong>{{ $t('components.card_table.not_found') }}</strong>
            </div>
        </template>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import {useFossil} from "@/Composables/useFossil"
import emitter from 'tiny-emitter/instance';

defineProps({
    title: { type: String },
    collections: { type: Array },
    url: { type: String }
});

const { getPath } = useFossil();

function imageClick(item) {
    emitter.emit('show_fossil', item);
}
</script>
