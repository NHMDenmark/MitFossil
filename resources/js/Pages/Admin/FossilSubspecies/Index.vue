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
    subspecies: {}
});
</script>

<template>
    <Head title="Fossil Subspecies" />

    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <CardHeader title="Fossil Subspecies">
                <PrimaryButton :url="route('admin.fossil-subspecies.create')"> ADD SUBSPECIES </PrimaryButton>
            </CardHeader>

            <Table class="mt-3" :header="table" :items="subspecies" paginate>
                <template #buttons="{ id,active }">
                    <div  class="d-flex">
                        <PrimaryButton :url="route('admin.fossil-subspecies.edit', id)" class="me-2"> EDIT  </PrimaryButton>
                        <DesactivateForm :active="active" route_="admin.fossil-subspecies.destroy" :id="id"></DesactivateForm>
                        <DeleteForm :id="id" route_="admin.fossil-subspecies.destroy" :title="'SUBSPECIES'"></DeleteForm>
                    </div>
                </template>
            </Table>
        </div>
    </AdminLayout>
</template>
