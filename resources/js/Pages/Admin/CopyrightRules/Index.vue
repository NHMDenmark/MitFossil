<script setup>
import {Head} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Table from "@/Components/Table.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CardHeader from "@/Components/partials/CardHeader.vue";
import DesactivateForm from "@/Components/DesactivateForm.vue";
import DeleteForm from "@/Components/DeleteForm.vue";

const table = [
    { value: 'description', label: 'Licens'},
    { value: 'notes', label: 'Beskrivelse'},
];
let props = defineProps({
    copyright_rules: {}
});
</script>

<template>
    <Head :title="$t('layout.admin.copyright_rules_text')" />
    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <CardHeader :title="$t('layout.admin.copyright_rules_text')">
                <PrimaryButton :url="route('admin.copyright-rules.create')"> {{ $t('form.add') }} {{ $t('layout.admin.copyright_rules_text_2') }}  </PrimaryButton>
            </CardHeader>

            <Table class="mt-3" :header="table" :items="copyright_rules" paginate>
                <template #buttons="{ id,active }">
                    <PrimaryButton :url="route('admin.copyright-rules.edit', id)"> {{ $t('form.edit') }}  </PrimaryButton>
                    <DesactivateForm :active="active" route_="admin.copyright-rules.destroy" :id="id"></DesactivateForm>
                    <DeleteForm :id="id" route_="admin.copyright-rules.destroy" :title="'Slet ' + $t('layout.admin.copyright_rules_text_2')"></DeleteForm>
                </template>
            </Table>
        </div>
    </AdminLayout>

</template>

