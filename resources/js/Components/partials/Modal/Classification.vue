<script setup>
import {computed, ref} from 'vue';
import DisplayInput from "@/Components/DisplayInput.vue";

const props = defineProps({
    fossil: { type: Object}
});

const identify = computed(() => props.fossil.fossil_identify);
</script>

<template>
    <div class="mt-5">
        <h5 class="text-primary heading-s mb-3 upper-xs"> {{ $t('components.classification') }} </h5>
        <DisplayInput :label="$t('form.fossil_common')" :value="identify?.fossil_common"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.fossil_kingdom')" :value="identify?.fossil_kingdom"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.fossil_phylum')" :value="identify?.fossil_phylum"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.fossil_class')" :value="identify?.fossil_class"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.fossil_order')" :value="identify?.fossil_order"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.fossil_family')" :value="identify?.fossil_family"></DisplayInput>
        <DisplayInput class="mt-3" :label="$t('form.fossil_genre')" :value="identify?.fossil_genre"></DisplayInput>
        <!--<DisplayInput class="mt-3" :label="$t('form.fossil_subgenre')" :value="identify?.fossil_subgenre"></DisplayInput>-->
        <DisplayInput class="mt-3" :label="$t('form.specific_epithet')" :value="identify?.specific_epithet"></DisplayInput>
        <!--<DisplayInput class="mt-3" :label="$t('form.fossil_subspecies')" :value="identify?.fossil_subspecies"></DisplayInput>-->
    </div>
</template>
