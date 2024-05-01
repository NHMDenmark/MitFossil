<script setup>
import { computed } from 'vue';
import SesionLayout from '@/Layouts/SesionLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputTextInline from "@/Components/InputTextInline.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    status: {type: String},
    username: {type: String},

});

const form = useForm({
    username: props.username,
    password: '',
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <SesionLayout image="/storage/images/bg-main.webp" link="/">

        <Head :title="$t('pages.verify_email.title')" />

        <h1 class="pb-2 fw-300 fs-40">
            {{ $t('pages.confirm_register.title') }}
        </h1>

        <p class="max-w-500 text-center fw-500 text-m mb-3">
            {{ $t('pages.confirm_register.text') }}
        </p>

        <form @submit.prevent="submit" class="w-100 max-w-500 mb-0">
            <div class="form-group mt-4">
                <InputTextInline v-model="form.password" name="password" :label="$t('pages.confirm_register.label')" type="password"></InputTextInline>
                <InputError class="mt-2" :message="form.errors.username" />
                <!--<InputError class="mt-2" :message="form.errors.password" />-->
            </div>
            <div class="d-flex justify-content-center mt-4">
                <button class="rounded text-uppercase btn-mit" type="submit">
                    {{ $t('pages.confirm_register.action') }}
                </button>
            </div>
        </form>

    </SesionLayout>
</template>
