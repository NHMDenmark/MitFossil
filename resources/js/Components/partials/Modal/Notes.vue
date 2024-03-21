<script setup>
import DisplayInput from "@/Components/DisplayInput.vue";
import DisplayTextarea from "@/Components/DisplayTextarea.vue";

const props = defineProps({
    fossil: { type: Object}
});
</script>

<template>
    <div class="mt-5">
        <h5 class="text-primary heading-s mb-3 upper-xs">{{ $t('components.notes') }}</h5>
        <DisplayInput :label="$t('form.identifier')" :value="fossil?.identifier"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.collector')" :value="fossil?.collector"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.date_find')" :value="fossil?.date_find"></DisplayInput>
        <DisplayTextarea class="mt-3" :label="$t('form.notes')" :value="fossil?.notes"></DisplayTextarea>
        <DisplayTextarea class="mt-3" :label="$t('form.personal_id')" :value="fossil?.personal_id"></DisplayTextarea>
    </div>
</template>
