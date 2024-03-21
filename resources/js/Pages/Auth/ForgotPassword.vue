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
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <SesionLayout image="/storage/images/bg-main.webp" link="/">
        <Head :title="$t('pages.forgot_password.title')" />

        <h1 class="pb-2 fw-300 fs-40">
            {{ $t('pages.forgot_password.subtitle') }}
        </h1>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <p class="max-w-500 text-center fw-500 mb-0 mt-4">
            {{ $t('pages.forgot_password.text') }}
        </p>

        <form @submit.prevent="submit" class="mt-5 w-100 max-w-500 mb-0">
            <div class="form-group mt-4">
                <InputTextInline name="email" v-model="form.email" :label="$t('form.email_2')" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="d-flex justify-content-center mt-6">
                <PrimaryButton :class-name="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                    {{ $t('pages.forgot_password.action') }}
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
