<script setup>
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import {Head, usePage} from '@inertiajs/vue3';
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineProps({
    mustVerifyEmail: { type: Boolean },
    status: { type: String },
});

const user = usePage().props.auth.user;
</script>

<template>
    <Head :title="$t('layout.admin.profile_text')" />

    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="d-flex flex-column flex-xl-row gap-45 align-items-start">
                <div class="col bg-white border-light shadow rounded p-0 col-divider">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status" />

                    <UpdatePasswordForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
