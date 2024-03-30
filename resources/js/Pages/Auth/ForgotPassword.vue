<script setup>
import SesionLayout from '@/Layouts/SesionLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputTextInline from "@/Components/InputTextInline.vue";

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    username: '',
    first: '',
    second: '',
    third: '',
    step: false
});

const submit = () => {
    if (!form.step) {
        form.step = true;
        return;
    }

    form.post(route('password.email'));
};
</script>

<template>
    <SesionLayout image="/storage/images/bg-main.webp" link="/">
        <Head :title="$t('pages.forgot_password.title')" />

        <h1 class="pb-2 fw-300 fs-40">
            {{ $t('pages.forgot_password.subtitle') }}
        </h1>

        <p class="max-w-500 text-center fw-500 mb-0 mt-4">
            {{ $t('pages.forgot_password.text') }}
        </p>

        <form @submit.prevent="submit" class="mt-5 w-100 max-w-500 mb-0">
            <div class="form-group mt-4">
                <InputTextInline name="username" v-model="form.username" :label="$t('form.username')" />
                <InputError class="mt-2" :message="form.errors.username" />
            </div>
            <div v-if="form.step">
                <div class="form-group mt-4">
                    <InputTextInline name="first" v-model="form.first" :label="$t('form.question_first')" />
                    <InputError class="mt-2" :message="form.errors.first" />
                    <InputTextInline class="mt-2" name="first" v-model="form.second" :label="$t('form.question_second')" />
                    <InputError class="mt-2" :message="form.errors.second" />
                    <InputTextInline class="mt-2" name="first" v-model="form.third" :label="$t('form.question_third')" />
                    <InputError class="mt-2" :message="form.errors.third" />
                </div>
            </div>

            <div class="d-flex justify-content-center mt-6">
                <PrimaryButton :class-name="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                    Next
                </PrimaryButton>
            </div>
        </form>

        <div class="mt-3 text-center">
            <p class="mb-0">{{ $t('pages.register.profile_text') }}
                <Link :href="route('login')" class="text-decoration-underline">
                    {{ $t('pages.register.login_text') }}
                </Link>
            </p>
        </div>
    </SesionLayout>
</template>
