<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import SelectInput from "@/Components/SelectInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputImage from "@/Components/InputImage.vue";
import InputTextInline from "@/Components/InputTextInline.vue";

const roles = [
    { value: 'admin', label: 'Administrator' },
    { value: 'curator', label: 'Kurator' },
]

const form = useForm({
    username: null,
    role: 'admin',
});
</script>

<template>
    <Head title="Add User" />

    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="col bg-white border-light shadow rounded p-0 col-divider">
                <div class="p-4">
                    <h5 class="heading-s fw-700 mb-3">{{ $t('form.create')}} {{ $t('layout.admin.user_text') }}</h5>

                    <form @submit.prevent="form.post(route('admin.users.store'))">

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12  col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="username" v-model="form.username" :label="$t('form.username')" />
                                            <InputError class="mt-2" :message="form.errors.username" />
                                        </div>
                                    </div>

                                    <div class="col-12  col-sm-6 mt-3">
                                        <div class="form-group">
                                            <div class="d-flex align-items-md-center flex-column flex-md-row">
                                                <InputLabel for="role" :value="$t('form.rol')" />
                                                <SelectInput
                                                    id="role"
                                                    class="w-full"
                                                    v-model="form.role"
                                                    :options="roles"
                                                    required
                                                />
                                            </div>

                                            <InputError class="mt-2" :message="form.errors.role" />
                                        </div>
                                    </div>

                                    <div class="col-12  col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="password" v-model="form.password" :label="$t('form.password')" type="password" />
                                            <InputError class="mt-2" :message="form.errors.password" />
                                        </div>
                                    </div>

                                    <div class="col-12  col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="password_confirmation" v-model="form.password_confirmation" :label="$t('form.repeat_password')" type="password" />
                                            <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-end">
                                <PrimaryButton class="me-2" type="link" :url="route('admin.users.index')">{{ $t('form.back') }}</PrimaryButton>
                                <PrimaryButton type="submit" :disabled="form.processing">{{ $t('form.create') }}</PrimaryButton>

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
