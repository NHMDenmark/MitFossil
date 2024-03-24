<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Table from "@/Components/Table.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CardHeader from "@/Components/partials/CardHeader.vue";
import {onMounted, ref} from "vue";
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();

const table = [
    { value: 'username', label: 'Brugernavn'},
    { value: 'role', label: 'Rolle', render: (value) => ( t(`rol.${value}`) )},
];

const form = useForm({
    id: null
});

const modal = ref();
const scope = ref({
    modalTitle: '',
    user_delete_id: null
});

let props = defineProps({
    users: {},
    user_delete: { type: Object },
});

onMounted(() => {
   if(props.user_delete) {
       onDeleteClick(props.user_delete.id, props.user_delete);
   }
});

const onDeleteClick = (id, item) => {
    scope.value.modalTitle = 'Slet ' + item.username + ' fra MitFossil ';
    form.id = id;
    modal.value.show();
};

const onModalOk = () => {
    form.delete(route('admin.users.destroy', form.id));
    modal.value.hide();
};

</script>

<template>
    <Head :title="$t('layout.admin.user_text')" />

    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <CardHeader :title="$t('layout.admin.user_text')">
                <PrimaryButton :url="route('admin.users.create')"> {{ $t('form.create')}} {{ $t('layout.admin.user_text') }} </PrimaryButton>
            </CardHeader>

            <Table class="mt-3" :header="table" :items="users" paginate>
                <template #buttons="{ id, item }">
                    <PrimaryButton :url="route('admin.users.edit', id)"> {{ $t('form.edit')}}  </PrimaryButton>
                    <DangerButton @click="onDeleteClick(id, item)"> {{ $t('form.delete') }}  </DangerButton>
                </template>
            </Table>
        </div>

        <Modal
            ref="modal"
            :show-cancel-button="true"
            :title="scope.modalTitle"
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
    </AdminLayout>
</template>
