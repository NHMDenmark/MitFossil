<template>
    <!-- Modal -->
    <teleport to="body">
        <div class="modal fade" ref="modal" tabindex="-1" aria-labelledby="titleModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" :style="{'max-width': width + '%'}">
                <div class="modal-content">
                    <div class="modal-header pb-0">
                        <div class="container-fluid">
                            <h5 class="modal-title" id="titleModal" v-html="title"></h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <slot/>
                    </div>
                    <div v-if="textCancelButton || textOkButton" class="modal-footer" :class="{'justify-content-between': showCancelButton, 'justify-content-end': !showCancelButton }">
                        <DangerButton v-if="textCancelButton" @click="cancel" class-name="w-25"> {{ textCancelButton }} </DangerButton>
                        <PrimaryButton v-if="textOkButton" @click="ok" class-name="w-25"> {{ textOkButton }} </PrimaryButton>
                    </div>
                </div>
            </div>
        </div>
    </teleport>
</template>

<script setup>
import {onMounted, onUnmounted, ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";

const { Modal } = bootstrap;

defineProps({
    title: String,
    width: Number,
    showCancelButton: Boolean,
    textCancelButton: String,
    textOkButton: String
});

defineExpose({ show, hide });

const emit = defineEmits(['ok', 'cancel', 'hide']);

const modal = ref();
const instace = ref();

onMounted(() => {
    instace.value = new Modal( modal.value, {} );
    modal.value.addEventListener('hidden.bs.modal', event => {
        emit('hide');
    })
});

onUnmounted(() => {
    if(modal.value) {
        modal.value.removeEventListener('hidden.bs.modal');
    }
});

function show() {
    instace.value.show();
}

function hide() {
    instace.value.hide();
    emit('hide');
}

function ok() {
    instace.value.hide();
    emit('ok');
}

function cancel() {
    instace.value.hide();
    emit('cancel');
}
</script>
