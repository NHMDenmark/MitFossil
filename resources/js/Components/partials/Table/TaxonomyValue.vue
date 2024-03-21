<script setup>
import {computed} from "vue";
import { getLowesTaxonomy } from "@/Composables/useFossil";
import {useI18n} from "vue-i18n";

const { t } = useI18n();

const props = defineProps( {
    identify: { type: Object }
})

const lowest = computed(() => {
   return getLowesTaxonomy( props.identify, t('form.unknown') );
});
</script>

<template>
    <div class="d-inline divider-right-dash">
        <template v-if="identify">
            <span v-if="(identify?.fossil_common !== null && identify?.fossil_common !== $t('form.unknown')) || (lowest !== null && lowest === '' && lowest !== $t('form.unknown'))" >{{ identify.fossil_common }}</span>
        </template>
        <span v-html="lowest"></span>
    </div>
</template>
