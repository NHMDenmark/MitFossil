<script setup>
import DisplayInput from "@/Components/DisplayInput.vue";
import DisplayTextarea from "@/Components/DisplayTextarea.vue";

const props = defineProps({
    fossil: { type: Object},
    showMap: { type: Boolean }
});
</script>

<template>
    <div class="mt-5">
        <h5 class="text-primary heading-s mb-3 upper-xs">{{ $t('components.location') }}</h5>
        <DisplayInput :label="$t('form.country')" :value="fossil?.country?.description"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.county')" :value="showMap === false ? $t('form.hidden') : fossil?.county?.description"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.municipality')" :value="showMap === false ? $t('form.hidden') : fossil?.municipality"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.city')" :value="showMap === false ? $t('form.hidden') : fossil?.city"></DisplayInput>
        <DisplayTextarea class="mt-3" :label="$t('form.locality')" :value="showMap === false ? $t('form.hidden') : fossil?.locality_name"></DisplayTextarea>
        <DisplayInput class="mt-3" :label="$t('form.latitude')" :value="showMap === false ? $t('form.hidden') : fossil?.latitude"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.longitude')" :value="showMap === false ? $t('form.hidden') : fossil?.longitude"></DisplayInput>
    </div>
</template>
