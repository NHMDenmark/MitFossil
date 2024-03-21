<template>
    <DangerButton @click="onClick(props.id)">{{ $t('form.delete')}}</DangerButton>

    <Modal
        ref="modal"
        :show-cancel-button="true"
        :title="title"
        :text-cancel-button="$t('components.modal.cancel')"
        :textOkButton="$t('components.modal.accept')"
        @ok="onModalOk">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <p class="text-m">{{ $t('components.modal.userModalDesactive.question_delete') }}</p>
                </div>
            </div>
        </div>

    </Modal>

</template>

<script setup>
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import {useForm} from "@inertiajs/vue3";
import {onMounted, ref} from "vue";

const modal = ref();

const props = defineProps({
    id: Number,
    title: String,
    route_: String,
    open: Boolean
})

const form = useForm({
    id: props.id,
    action: 'delete'
});

onMounted(() => {
    if(props.open === true) {
        modal.value.show();
    }
});

const onClick = (id) => {
    modal.value.show();
};

const onModalOk = () => {
    modal.value.hide();
    form.delete(route(props.route_, form.id), {
        preserveScroll: true
    });
};

</script>
