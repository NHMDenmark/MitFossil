<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import InputTextInline from "@/Components/InputTextInline.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const form = useForm({
    name: null,
    file: null
});
</script>

<template>
    <Head title="Add File" />

    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="col bg-white border-light shadow rounded p-0 col-divider">
                <div class="p-4">
                    <h5 class="heading-s fw-700 mb-3">{{ $t('form.add') }} {{ $t('layout.admin.files_text_2') }}</h5>

                    <form @submit.prevent="form.post(route('admin.files.store'))">
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="name" v-model="form.name" :label="$t('layout.admin.files_name')" />
                                            <InputError class="mt-2" :message="form.errors.name" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="form-group">
                                            <input class="form-control" type="file" id="formFile" @input="form.file = $event.target.files[0]">
                                            <InputError class="mt-2" :message="form.errors.name" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-end">
                                <PrimaryButton class="me-2" type="link" :url="route('admin.files.index')">{{ $t('form.back') }}</PrimaryButton>
                                <PrimaryButton type="submit" :disabled="form.processing">{{ $t('form.add') }}</PrimaryButton>

                                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">{{ $t('form.saved') }}</p>
                                </Transition>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
