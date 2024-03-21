<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import { ref } from 'vue';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Table from "@/Components/Table.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CardHeader from "@/Components/partials/CardHeader.vue";
import Modal from "@/Components/Modal.vue";
import DesactivateForm from "@/Components/DesactivateForm.vue";
import DeleteForm from "@/Components/DeleteForm.vue";

import {useI18n} from "vue-i18n";

const {t} = useI18n({})

const table = [
    { value: 'description', label: t( 'layout.admin.taxonomies_text_2' )},
];

let props = defineProps({
    taxonomies: {}
});

const modalConfirm = ref();

const formDelete = useForm({
    id: null
});

function onDelete(id) {
    formDelete.id = id;
    modalConfirm.value.show();
}

function onOkConfirm() {
    formDelete.delete(route('admin.fossil-taxonomies.destroy', formDelete.id ));
}
</script>

<template>
    <Head :title="$t('layout.admin.taxonomies_text')" />

    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <CardHeader :title="$t('layout.admin.taxonomies_text')">
                <PrimaryButton :url="route('admin.fossil-taxonomies.create')">  {{ $t('form.add') }} {{ $t('layout.admin.taxonomies_text_2') }}  </PrimaryButton>
            </CardHeader>

            <Table class="mt-3" :header="table" :items="taxonomies" paginate>
                <template #buttons="{ id, active }">
                    <div class="d-flex">
                        <PrimaryButton :url="route('admin.fossil-taxonomies.edit', id)" class="me-2">  {{ $t('form.edit') }}   </PrimaryButton>
                        <DesactivateForm :active="active" route_="admin.fossil-taxonomies.destroy" :id="id" :text="$t('layout.admin.taxonomies_text_2')"></DesactivateForm>
                        <DeleteForm :id="id" route_="admin.fossil-taxonomies.destroy" :title="'Slet ' + $t('layout.admin.taxonomies_text_2')"></DeleteForm>
                    </div>
                </template>
            </Table>
        </div>

        <Modal
        ref="modalConfirm"
        :show-cancel-button="true"
        :title="title"
        :text-cancel-button="$t('components.modal.cancel')"
        :textOkButton="$t('components.modal.accept')"
        @ok="onOkConfirm">
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
