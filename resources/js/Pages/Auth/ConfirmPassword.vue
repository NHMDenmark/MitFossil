<script setup>
import SesionLayout from "@/Layouts/SesionLayout.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputTextInline from "@/Components/InputTextInline.vue";

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <SesionLayout image="/storage/images/bg-main.webp" link="/">
        <Head :title="$t('pages.confirm_password.title')" />

        <div class="mb-4 text-sm text-gray-600">
            {{ $t('pages.confirm_password.text') }}
        </div>

        <form @submit.prevent="submit">
            <div class="form-group">
                <InputTextInline name="password" v-model="form.password" :label="$t('form.password')" />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex justify-end mt-4">
                <PrimaryButton class="ml-4" :class-name="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                    {{ $t('pages.confirm_password.action') }}
                </PrimaryButton>
            </div>
        </form>
    </SesionLayout>
</template>
