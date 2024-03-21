<template>
    <div class="col bg-white border-light shadow rounded p-0 col-divider fossil-filter">
        <div class="p-4">
            <h5 class="heading-s fw-700 mb-3">{{ title }}</h5>

            <FilterPartial :origin="origin"></FilterPartial>
        </div>
    </div>
</template>

<script setup>
import FilterPartial from './FilterPartial.vue';

defineProps({
    origin: { type: String, required: true },
    title: { type: String }
});
</script>
