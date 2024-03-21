<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Table from "@/Components/Table.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CardHeader from "@/Components/partials/CardHeader.vue";
import DesactivateForm from "@/Components/DesactivateForm.vue";
import {ref} from "vue";
import Modal from "@/Components/Modal.vue";
import DeleteForm from "@/Components/DeleteForm.vue";
import {useI18n} from "vue-i18n";

const {t} = useI18n({})

const table = [
    { value: 'image', label: t( 'layout.admin.thumbnail' ), render: (value) => value ? `<img src="${ value }" alt="Resource" class="img-fluid" width="50">` : '' },
    { value: 'name', label: t( 'layout.admin.resource_name')},
    { value: 'description', label: t( 'layout.admin.resource_description' )},
];

let props = defineProps({
    resources: {}
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
    formDelete.delete(route('admin.resources.destroy', formDelete.id ));
}
</script>

<template>
    <Head :title="$t('layout.admin.resources_text')" />

    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <CardHeader :title="$t('layout.admin.resources_text')">
                <PrimaryButton :url="route('admin.resources.create')"> {{ $t('form.add')}} {{ $t('layout.admin.resources_text_2') }} </PrimaryButton>
            </CardHeader>

            <Table class="mt-3" :header="table" :items="resources" paginate>
                <template #buttons="{ id,active }">
                    <div class="d-flex">
                        <PrimaryButton :url="route('admin.resources.edit', id)" class="me-2"> {{ $t('form.edit') }}  </PrimaryButton>
                        <DesactivateForm :active="active" route_="admin.resources.destroy" :id="id" :text="$t('layout.admin.resources_text_2')"></DesactivateForm>
                        <DeleteForm :id="id" route_="admin.resources.destroy" :title="'Slet ' + $t('layout.admin.resources_text_2')"></DeleteForm>
                    </div>
                </template>
            </Table>
        </div>
    </AdminLayout>
</template>
