<template>
    <Head :title="$t('layout.admin.welcome')" />

    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <CardHeader :title="$t('layout.admin.welcome')">

            </CardHeader>
        </div>
    </AdminLayout>

</template>

<script setup>

import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Head} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CardHeader from "@/Components/partials/CardHeader.vue";
</script>
