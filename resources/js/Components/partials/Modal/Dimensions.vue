<script setup>
import DisplayInput from "@/Components/DisplayInput.vue";

const props = defineProps({
    fossil: { type: Object}
});
</script>

<template>
    <div class="mt-5">
        <h5 class="text-primary heading-s mb-3 upper-xs">{{ $t('components.dimensions') }}</h5>
        <DisplayInput :label="$t('form.length')" :value="fossil?.length"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.width')" :value="fossil?.width"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.height')" :value="fossil?.height"></DisplayInput>
    </div>
</template>
