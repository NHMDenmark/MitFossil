<script setup>
import {Head} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Table from "@/Components/Table.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CardHeader from "@/Components/partials/CardHeader.vue";
import DesactivateForm from "@/Components/DesactivateForm.vue";
import DeleteForm from "@/Components/DeleteForm.vue";
import {useI18n} from "vue-i18n";

const {t} = useI18n({})

const table = [
    { value: 'name', label: t('layout.admin.files_name')},    
    { value: 'size', label: t( 'layout.admin.files_size' )},
];

let props = defineProps({
    files: {}
});
</script>

<template>
    <Head :title="$t('layout.admin.files_text')" />

    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <CardHeader :title="$t('layout.admin.files_text')" >
                <PrimaryButton :url="route('admin.files.create')">  {{ $t('form.add') }} {{ $t('layout.admin.files_text_2') }}   </PrimaryButton>
            </CardHeader>

            <Table class="mt-3" :header="table" :items="files" paginate>
                <template #buttons="{ id }">
                    <div class="d-flex">
                        <PrimaryButton :url="route('admin.files.edit', id)" class="me-2">
                            {{ $t('form.edit') }}
                        </PrimaryButton>
                        <DeleteForm :title="'Slet ' + $t('layout.admin.files_text_2')" :id="id" route_="admin.files.destroy"></DeleteForm>
                    </div>
                </template>
            </Table>
        </div>
    </AdminLayout>
</template>
