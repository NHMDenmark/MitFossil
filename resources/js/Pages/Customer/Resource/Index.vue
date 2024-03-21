<script setup>
import {Head, Link} from "@inertiajs/vue3";
import CustomerLayout from "@/Layouts/CustomerLayout.vue";

defineProps({
    resources: { type: Array }
})
</script>

<template>
    <Head :title="$t('pages.resources.title')" />

    <CustomerLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="col bg-white border-light shadow rounded p-0 col-divider">
                <div class="row p-4">
                    <div class="d-flex flex-column flex-sm-row justify-content-start gap-3">
                        <img src="/storage/images/resource-thumbnail.jpg" alt="Resource" class="img-fluid object-fit-contain" width="100">
                        <div class="col">
                            <h5 class="heading-s fw-700 mb-3">{{ $t('pages.resources.map_title') }}</h5>
                            <p class="mb-4">{{ $t('pages.resources.map_subtitle') }}</p>
                            <div class="d-flex justify-content-sm-end">
                                <Link :href="route('customer.resources.map')" class="rounded text-uppercase btn-mit">
                                    {{ $t('form.explore') }}
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-for="item of resources" :key="item.id" class="d-flex flex-column flex-xl-row gap-45 align-items-start mt-4 resource-main">
                <div class="col bg-white border-light shadow rounded p-0 col-divider">
                    <div class="row p-4">
                        <div class="d-flex flex-column flex-sm-row justify-content-start gap-3">
                            <img v-if="item.image" :src="item.image" alt="Resource" class="img-fluid" width="100">
                            <div class="col">
                                <h5 class="heading-s fw-700 mb-3">{{ item.name }}</h5>
                                <p class="mb-4" v-html="item.description"></p>
                                <div class="d-flex justify-content-sm-end">
                                    <Link :href="route('customer.resources.show', item.endpoint)" class="rounded text-uppercase btn-mit">
                                        {{ $t('form.explore') }}
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </CustomerLayout>
</template>
