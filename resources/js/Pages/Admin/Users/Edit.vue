<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import SelectInput from "@/Components/SelectInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputImage from "@/Components/InputImage.vue";
import InputTextInline from "@/Components/InputTextInline.vue";
import {useI18n} from "vue-i18n";

const {t} = useI18n({})

const props = defineProps({
    user: { type: Object }
})

const roles = [
    { value: 'admin',  label: t( 'rol.admin' ) },
    { value: 'curator',  label: t( 'rol.curator' ) },
    { value: 'customer',  label: t( 'rol.customer' ) },
]

const form = useForm({
    name: props.user.name,
    username: props.user.username,
    email: props.user.email,
    zip_code: props.user.zip_code,
    year_birth: props.user.year_birth,
    picture: props.user.picture,
    role: props.user.role,
    password: null,
    password_confirmation: null,
});
</script>

<template>
    <Head title="Add User" />

    <AdminLayout>

        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="col bg-white border-light shadow rounded p-0 col-divider">
                <div class="p-4">
                    <h5 class="heading-s fw-700 mb-3">{{ $t('form.edit')}} {{ $t('layout.admin.user_text') }}</h5>

                    <form @submit.prevent="form.put(route('admin.users.update', user.id))">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="edit-picture">
                                    <InputImage
                                        id="picture"
                                        class="m-auto"
                                        :options="{ ratio: '1:1', size: '1000, 1000' }"
                                        :old-value="form.picture"
                                        v-model="form.picture"
                                        required />
                                    <InputLabel for="picture" :value="$t('form.edit_picture')" />
                                </div>

                                <InputError class="mt-2" :message="form.errors.picture" />
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="name" v-model="form.name" :label="$t('form.name')" />
                                            <InputError class="mt-2" :message="form.errors.name" />
                                        </div>
                                    </div>

                                    <div class="col-12  col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="username" v-model="form.username" :label="$t('form.username')" />
                                            <InputError class="mt-2" :message="form.errors.username" />
                                        </div>
                                    </div>

                                    <div class="col-12  col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="email" v-model="form.email" :label="$t('form.email_2')" />
                                            <InputError class="mt-2" :message="form.errors.email" />
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
                                            <InputTextInline type="number" name="zip_code" v-model="form.zip_code" :label="$t('form.zip_code')" />
                                            <InputError class="mt-2" :message="form.errors.zip_code" />
                                        </div>
                                    </div>

                                    <div class="col-12  col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline type="number" name="year_birth" v-model="form.year_birth" :label="$t('form.year_birth')" />
                                            <InputError class="mt-2" :message="form.errors.year_birth" />
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
                                            <InputTextInline name="password_confirmation" v-model="form.password_confirmation" :label="$t('form.repeat_password')"  type="password" />
                                            <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-end">
                                <PrimaryButton class="me-2" type="link" :url="route('admin.users.index')">{{ $t('form.back') }}</PrimaryButton>
                                <PrimaryButton type="submit" :disabled="form.processing">{{ $t('form.save') }}</PrimaryButton>

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
