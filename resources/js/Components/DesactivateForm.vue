<template>
    <PrimaryButton v-if="props.active === 0" @click="handleClick(props.id)" class="me-2">{{ $t('form.activate')}}</PrimaryButton>
    <DangerButton v-if="props.active === 1" class="btn-mit me-2"  @click="handleClick(props.id)">{{ $t('form.' + title)}}</DangerButton>

    <Modal
        ref="modal"
        :title="$t('components.modal.'+(props.active === 1 ? 'desactive' : 'activate'))+' '+text"
        :show-cancel-button="true"
        :text-cancel-button="$t('components.modal.cancel')"
        :textOkButton="$t('components.modal.accept')"
        @ok="handleModalOk">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <p class="text-m">{{ $t('components.modal.userModalDesactive.' + (props.active === 1 ? 'question_desactive' : 'question_active') ) }}</p>
                </div>
            </div>
        </div>

    </Modal>

</template>

<script setup>
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import {useForm} from "@inertiajs/vue3";
import {onMounted, ref} from "vue";

const modal = ref();
const objectDestroy = ref();

const props = defineProps({
    active: { types: [Boolean, Number] },
    title: { type: String, default: 'desactive' },
    text: { type: String, default: '' },
    id: Number,
    open: Boolean,
    route_: String,
})

const form = useForm({
    id: null,
    action: 'change-status',
});

onMounted(() => {
    if(props.open === true) {
        modal.value.show();
    }
});

const handleClick = (id) => {
    form.id = id;
    modal.value.show();
};

const handleModalOk = () => {
    form.delete(route(props.route_, form.id), {
        preserveScroll: true,
        onFinish: () => {
            modal.value.hide();
        }
    });
};
</script>
