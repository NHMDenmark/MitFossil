<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Table from "@/Components/Table.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CardHeader from "@/Components/partials/CardHeader.vue";
import DesactivateForm from "@/Components/DesactivateForm.vue";
import DeleteForm from "@/Components/DeleteForm.vue";
import InputTextInline from "@/Components/InputTextInline.vue";
import InputError from "@/Components/InputError.vue";
import {useI18n} from "vue-i18n";

const {t} = useI18n({})

const table = [
    { value: 'title', label: t( 'layout.admin.map_resources_title' )},
    { value: 'latitude', label: t( 'form.latitude' )},
    { value: 'longitude', label: t( 'form.longitude' )},
];

let props = defineProps({
    mapResources: { type: Array },
    page: { type: Object }
});

const form = useForm({
    id: props.page.id,
    title: props.page.title,
    text: props.page.text,
    origin: 'map-resource'
});

function onSubmit() {
    form.post(route('admin.pages.store'));
}
</script>

<template>
    <Head :title="$t('layout.admin.map_resources_text')" />
    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <CardHeader :title="$t('layout.admin.map_resources_text')">
                <PrimaryButton :url="route('admin.map-resources.create')"> {{ $t('form.add') }} {{ $t('layout.admin.map_resources_title') }}  </PrimaryButton>
            </CardHeader>

            <div class="col bg-white border-light shadow rounded p-0 col-divider mt-3">
                <form @submit.prevent="onSubmit" class="p-4">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <InputTextInline name="name" v-model="form.title" :label="$t('layout.admin.resource_name')" />
                                        <InputError class="mt-2" :message="form.errors.title" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <InputTextInline name="endpoint" v-model="form.text" :label="$t('layout.admin.resource_description')" />
                                        <InputError class="mt-2" :message="form.errors.text" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 d-flex justify-content-end">
                            <PrimaryButton type="submit" :disabled="form.processing">{{ $t('form.save') }} </PrimaryButton>

                            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">{{ $t('form.saved') }} .</p>
                            </Transition>
                        </div>
                    </div>
                </form>
            </div>

            <Table class="mt-3" :header="table" :items="mapResources" paginate>
                <template #buttons="{ id,active }">
                    <div class="d-flex">
                        <PrimaryButton :url="route('admin.map-resources.edit', id)" class="me-2"> {{ $t('form.edit') }}  </PrimaryButton>
                        <DesactivateForm :active="active" route_="admin.map-resources.destroy" :id="id" :text="$t('layout.admin.map_resources_title')"></DesactivateForm>
                        <DeleteForm :id="id" route_="admin.map-resources.destroy" :title="'Slet ' + $t('layout.admin.map_resources_title')"></DeleteForm>
                    </div>
                </template>
            </Table>
        </div>
    </AdminLayout>

</template>

