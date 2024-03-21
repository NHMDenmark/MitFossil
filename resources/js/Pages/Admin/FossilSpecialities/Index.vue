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
    { value: 'description', label: t( 'layout.admin.description' )},
];
let props = defineProps({
    fossil_speciality: {}
});
</script>

<template>
    <Head :title="$t('layout.admin.fossil_speciality')" />

    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <CardHeader :title="$t('layout.admin.fossil_speciality')">
                <PrimaryButton :url="route('admin.fossil-speciality.create')">  {{ $t('form.add') }} {{ $t('layout.admin.fossil_speciality') }}   </PrimaryButton>
            </CardHeader>

            <Table class="mt-3" :header="table" :items="fossil_speciality" paginate>
                <template #buttons="{ id,active }">
                    <div class="d-flex">
                        <PrimaryButton :url="route('admin.fossil-speciality.edit', id)" class="me-2"> {{ $t('form.edit') }}  </PrimaryButton>
                        <DesactivateForm :active="active" route_="admin.fossil-speciality.destroy" :id="id"></DesactivateForm>
                        <DeleteForm :id="id" route_="admin.fossil-speciality.destroy" :title="'Slet ' + $t('layout.admin.fossil_speciality')"></DeleteForm>
                    </div>
                </template>
            </Table>
        </div>
    </AdminLayout>
</template>
