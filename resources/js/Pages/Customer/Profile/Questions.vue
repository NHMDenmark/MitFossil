<script setup>
import {useForm} from "@inertiajs/vue3";
import CustomerLayout from '@/Layouts/CustomerLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import {Head, usePage} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CardStats from "@/Components/partials/CardStats.vue";
import CardCollections from "@/Pages/Customer/Dashboard/Partials/CardCollections.vue";
import ModalView from "@/Components/partials/Modal/ModalView.vue";
import {onMounted} from "vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputImage from "@/Components/InputImage.vue";
import InputTextInline from "@/Components/InputTextInline.vue";
import TextInput from "@/Components/TextInput.vue";

const user = usePage().props.auth.user;

const form = useForm({
    user: user,
    first: null,
    second: null,
    third: null,
    password: null,
    password_confirmation: null
});
</script>

<template>
    <Head :title="$t('pages.profile.questions')" />

    <CustomerLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="col bg-white border-light shadow rounded p-0 col-divider">
                <div class="p-4">
                    <h5 class="heading-s fw-700 mb-3">{{ $t('pages.profile.questions') }}</h5>
                    <form @submit.prevent="form.post(route('save_questions'))">

                        <div class="d-flex flex-column mt-4">
                            <div class="col-12 mt-3">
                                <div class="">
                                    <InputTextInline :labelTop="true" name="first" v-model="form.first" :label="$t('form.question_first')" />
                                    <InputError class="mt-2" :message="form.errors.first" />
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="">
                                    <InputTextInline :labelTop="true" name="second" v-model="form.second" :label="$t('form.question_second')" />
                                    <InputError class="mt-2" :message="form.errors.second" />
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="">
                                    <InputTextInline :labelTop="true" name="third" v-model="form.third" :label="$t('form.question_third')" />
                                    <InputError class="mt-2" :message="form.errors.third" />
                                </div>
                            </div>
                        </div>
                        <p class="mt-3"><b>{{$t('form.question_note')}}</b></p>
                        <div class="row">
                            <div class="col col-sm-6 mt-4">
                                <InputLabel for="password" :value="$t('form.new_password')" />

                                <TextInput
                                    id="password"
                                    ref="passwordInput"
                                    v-model="form.password"
                                    type="password"
                                    class="mt-1 block w-full"
                                    autocomplete="new-password"
                                />

                                <InputError :message="form.errors.password" class="mt-2" />
                            </div>

                            <div class="col col-sm-6 mt-4">
                                <InputLabel for="password_confirmation" :value="$t('form.repeat_new_password')" />

                                <TextInput
                                    id="password_confirmation"
                                    v-model="form.password_confirmation"
                                    type="password"
                                    class="mt-1 block w-full"
                                    autocomplete="new-password"
                                />

                                <InputError :message="form.errors.password_confirmation" class="mt-2" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-end">
                                <PrimaryButton type="submit" :disabled="form.processing">Færdiggør brugeroprettelse</PrimaryButton>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </CustomerLayout>
</template>
