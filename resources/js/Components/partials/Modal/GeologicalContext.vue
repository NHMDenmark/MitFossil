<script setup>
import DisplayInput from "@/Components/DisplayInput.vue";

const props = defineProps({
    fossil: { type: Object}
});
</script>

<template>
    <div class="mt-5">
        <h5 class="text-primary heading-s mb-3 upper-xs">{{ $t('components.geological_context') }}</h5>
        <DisplayInput :label="$t('form.eon')" :value="fossil?.eon?.description"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.era')" :value="fossil?.era?.description"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.period')" :value="fossil?.period?.description"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.epoch')" :value="fossil?.epoch?.description"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.age')" :value="fossil?.age?.description"></DisplayInput>
    </div>
</template>
