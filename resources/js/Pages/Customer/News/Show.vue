<script setup>
import {Head, Link} from "@inertiajs/vue3";
import CustomerLayout from "@/Layouts/CustomerLayout.vue";

defineProps({
    news: { type: Object }
})
</script>

<template>
    <Head :title="news.name" />

    <CustomerLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="d-flex flex-column flex-xl-row gap-45 align-items-start mt-4">
                <div class="col bg-white border-light shadow rounded p-0 col-divider">
                    <div class="row p-4">
                        <h5 class="heading-s fw-700 mb-3">{{ news.name }}</h5>

                        <div class="p-3 mit-resource" v-html="news.html">
                        </div>

                        <div class="d-flex justify-content-sm-end mt-3">
                            <Link :href="route('customer.dashboard')" class="rounded text-uppercase btn-mit">
                                {{ $t('form.back') }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </CustomerLayout>
</template>
