<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import SesionLayout from "@/Layouts/SesionLayout.vue";
import InputTextInline from "@/Components/InputTextInline.vue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    username: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <SesionLayout image="/storage/images/bg-main.webp" link="/">
        <Head :title="$t('pages.login.title')" />

        <h1 class="pb-2 fw-300 fs-40">
            {{ $t('pages.login.title') }}
        </h1>
        <p class="max-w-500 text-center fw-500 text-m mb-0">
            {{ $t('pages.login.text') }}
        </p>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="mt-6 w-100 max-w-500 mb-0">

            <div class="form-group">
                <InputTextInline v-model="form.username" name="username" :label="$t('form.username')"></InputTextInline>
                
            </div>

            <div class="form-group mt-4">
                <InputTextInline v-model="form.password" name="password" :label="$t('form.password')" type="password"></InputTextInline>
                <InputError class="mt-2" :message="form.errors.username" />
                <!--<InputError class="mt-2" :message="form.errors.password" />-->
            </div>

            <div class="label-only-space">
                <div class="block mt-4">
                    <Checkbox name="remember" v-model:checked="form.remember" :label="$t('form.remember_me')" />
                </div>
                <div class="mt-3">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-decoration-underline">
                        {{ $t('pages.login.forgot_text') }}
                    </Link>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-6">
                <button class="rounded text-uppercase btn-mit" type="submit">
                    {{ $t('pages.login.title') }}
                </button>
            </div>
            <div class="mt-3 text-center">
                <p class="mb-0">
                    {{ $t('pages.login.profile_text') }}
                    <Link
                        v-if="canResetPassword"
                        :href="route('register')"
                        class="text-decoration-underline">
                        {{ $t('pages.login.register_text') }}
                    </Link>
                </p>
            </div>
        </form>
    </SesionLayout>
</template>
