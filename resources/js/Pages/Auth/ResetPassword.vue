<script setup>
import SesionLayout from "@/Layouts/SesionLayout.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputTextInline from "@/Components/InputTextInline.vue";

const props = defineProps({
    username: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    username: props.username,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <SesionLayout image="/storage/images/bg-main.webp" link="/">
        <Head :title="$t('pages.reset_password.title')" />

        <form @submit.prevent="submit">
            <div class="form-group mt-4">
                <InputTextInline name="username" v-model="form.username" :label="$t('form.username')" />
                <InputError class="mt-2" :message="form.errors.username" />
            </div>

            <div class="form-group mt-4">
                <InputTextInline name="password" v-model="form.password" :label="$t('form.new_password')" type="password" />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="form-group mt-4">
                <InputTextInline name="password_confirmation" v-model="form.password_confirmation" :label="$t('form.repeat_new_password')" type="password" />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="d-flex justify-content-center mt-5">
                <PrimaryButton :class-name="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                    {{ $t('pages.reset_password.action_reset') }}
                </PrimaryButton>
            </div>
        </form>
    </SesionLayout>
</template>
