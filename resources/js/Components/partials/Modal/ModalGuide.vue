<script setup>
import Modal from "@/Components/Modal.vue";
import emitter from 'tiny-emitter/instance'
import { onMounted, onUnmounted, ref } from 'vue';
import Gallery from "./Gallery.vue";
import Map from "./Map.vue";
import Location from "./Location.vue";
import Classification from "./Classification.vue";
import GeologicalContext from "./GeologicalContext.vue";
import Lithostratigraphy from "./Lithostratigraphy.vue";
import Dimensions from "./Dimensions.vue";
import Notes from "./Notes.vue";
import Identifies from "./Identifies.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { usePage } from "@inertiajs/vue3";
import { voteUserIdentify } from "@/Composables/useFossil";
import Accordion from "@/Components/Accordion.vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();

const modalView = ref();

function show() {
    modalView.value.show();
}

const accordeon = [
    { title: t('pages.new_fossil.accordions.help.title_1'), text: t('pages.new_fossil.accordions.help.desc_1')},
    { title: t('pages.new_fossil.accordions.help.title_2'), text: t('pages.new_fossil.accordions.help.desc_2')},
    { title: t('pages.new_fossil.accordions.help.title_3'), text: t('pages.new_fossil.accordions.help.desc_3')},
    { title: t('pages.new_fossil.accordions.help.title_4'), text: t('pages.new_fossil.accordions.help.desc_4')},
    { title: t('pages.new_fossil.accordions.help.title_5'), text: t('pages.new_fossil.accordions.help.desc_5')},
    { title: t('pages.new_fossil.accordions.help.title_6'), text: t('pages.new_fossil.accordions.help.desc_6')},
    { title: t('pages.new_fossil.accordions.help.title_7'), text: t('pages.new_fossil.accordions.help.desc_7')},
    { title: t('pages.new_fossil.accordions.help.title_8'), text: t('pages.new_fossil.accordions.help.desc_8')},
]

defineExpose({ show });

</script>

<template>
    <Modal ref="modalView" :title="$t('pages.new_fossil.guide_title')" :width="80" :textOkButton="$t('components.modal.ok')" :show-cancel-button="false">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <Accordion :items="accordeon" />
                </div>
            </div>
        </div>
    </Modal>
</template>
