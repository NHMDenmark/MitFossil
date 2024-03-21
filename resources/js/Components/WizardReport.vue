<template>
    <div class="wz wizzard d-flex mt-3">
        <div class="wz wizard-button d-flex d-justify-content-center flex-wrap gap-3">
            <primary-button class="wz" class-name="wz" @click="onClick">{{title}}</primary-button>
        </div>
        <div v-if="showContent" class="wz wizzard-dropdown wizzard-report bg-white p-4 pb-0 border-light rounded shadow">
            <div class="wz row">
                <div v-if="!confirmFilter" class="wz col-12 wizzard-body">
                    <h5 class="wz heading-s fw-700 mb-3">{{ subtitle }}</h5>
                    <i @click="showContent = false" class="wz fas fa-close wizzard-close"></i>
                    <primary-button class="wz text-center py-2" @click="onOkInappropiate">
                        {{ report_action_inappropriate }}
                    </primary-button>
                    <primary-button class="wz text-center py-2" @click="onOkNotFossil">
                        {{ report_action_not_fossil }}
                    </primary-button>
                    <primary-button class="wz text-center py-2 pb-4" @click="onOkComment">
                        {{ report_action_comment }}
                    </primary-button>
                </div>
                <Transition v-if="confirmFilter" enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <div class="wz col-12 wizzard-body text-center">
                        <p class="text">{{ question }}</p>

                        <button @click="confirmFilter = false" type="button" class="btn btn-danger btn-mit ">{{ back }}</button>

                        <primary-button class="wz wizzard-button text-center pb-4 pt-2" @click="onOk">
                            {{ ok }}
                        </primary-button>
                    </div>
                </Transition>
            </div>
        </div>
    </div>
</template>

<script setup>
import {ref, watch, computed, onMounted, onUnmounted} from 'vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from '@/Components/Modal.vue';

const props = defineProps({
    title: { type: String },
    subtitle: { type: String },
    report_action_inappropriate: { type: String},
    report_action_not_fossil: { type: String},
    report_action_comment: { type: String},
    question: { type: String },
    back: { type: String },
    ok: { type: String },
});

const filtro = ref('');
let optionChosen = ref(null);
const selectedValue = ref(null);
const confirmFilter = ref(false);
const modalView = ref();
const selectedOption = ref(null);
const showContent = ref(false);

const onClick = () => {
    showContent.value = !showContent.value;
};

function onOkInappropiate() {
    optionChosen = 'okInappropiate';
    confirmFilter.value = true;
};

function onOkNotFossil() {
    optionChosen = 'okNotFossil';
    confirmFilter.value = true;
};

function onOkComment() {
    optionChosen = 'okComment';
    confirmFilter.value = true;
};

function onOk() {
    emits('ok', optionChosen);
    showContent.value = false;
    confirmFilter.value = false;
};

const emits = defineEmits(['ok', 'close']);

</script>
