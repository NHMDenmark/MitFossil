<script setup>
import { computed } from 'vue';
import SesionLayout from '@/Layouts/SesionLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <SesionLayout image="/storage/images/bg-main.webp" link="/">
        
            <Head :title="$t('pages.verify_email.title')" />

            <h1 class="pb-2 fw-300 fs-40">
                {{ $t('pages.verify_email.title') }}
            </h1>

            <p class="max-w-500 text-center fw-500 text-m mb-3">
                {{ $t('pages.verify_email.text') }}
            </p>

            <p class="max-w-500 text-center fw-500 text-m mb-0" v-if="verificationLinkSent">
                {{ $t('pages.verify_email.subtext') }}
            </p>

            <form @submit.prevent="submit">
                <div class="mt-4 flex items-center justify-between">
                    <PrimaryButton :class-name="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                        {{ $t('pages.verify_email.action') }}
                    </PrimaryButton>
                </div>
            </form>
        
    </SesionLayout>
</template>
