<script setup>
import DisplayInput from "@/Components/DisplayInput.vue";

const props = defineProps({
    fossil: { type: Object}
});
</script>

<template>
    <div class="mt-5">
        <h5 class="text-primary heading-s mb-3 upper-xs">{{ $t('components.lithostratigraphy') }}</h5>
        <DisplayInput :label="$t('form.group')" :value="fossil?.group"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.formation')" :value="fossil?.formation"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.member')" :value="fossil?.member"></DisplayInput>
    </div>
</template>
