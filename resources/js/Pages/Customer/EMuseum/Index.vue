<script setup>

import {Head, Link} from "@inertiajs/vue3";
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
</script>

<template>
    <Head :title="$t('pages.emuseum.title')" />

    <CustomerLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="d-flex flex-column flex-xl-row gap-45 align-items-start">
                <div class="col bg-white border-light shadow rounded p-0 col-divider">
                    <div class="row p-4">
                        <h5 class="heading-s fw-700 mb-3">{{ $t('pages.emuseum.subtitle') }}</h5>
                        <p class="mb-4">
                            {{ $t('pages.emuseum.text') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column flex-xl-row gap-45 align-items-start mt-4">
                <div class="col bg-white border-light shadow rounded p-0 col-divider">
                    <div class="row p-4">
                        <h5 class="heading-xs fw-700 mb-3 text-uppercase c-grey">{{ $t('pages.emuseum.curated_title') }}</h5>
                        <p class="mb-4">
                            {{ $t('pages.emuseum.curated_text') }}
                        </p>
                        <div class="d-flex justify-content-sm-end">
                            <Link :href="route('customer.e-museum.curated')" class="rounded text-uppercase btn-mit">
                                {{ $t('form.explore') }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column flex-xl-row gap-45 align-items-start mt-4">
                <div class="col bg-white border-light shadow rounded p-0 col-divider">
                    <div class="row p-4">
                        <h5 class="heading-xs fw-700 mb-3 text-uppercase c-grey">{{ $t('pages.emuseum.fossil_title') }}</h5>
                        <p class="mb-4">
                            {{ $t('pages.emuseum.fossil_text') }}
                        </p>
                        <div class="d-flex justify-content-sm-end">
                            <Link :href="route('customer.e-museum.experts')" class="rounded text-uppercase btn-mit">
                                {{ $t('form.explore') }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column flex-xl-row gap-45 align-items-start mt-4">
                <div class="col bg-white border-light shadow rounded p-0 col-divider">
                    <div class="row p-4">
                        <h5 class="heading-xs fw-700 mb-3 text-uppercase c-grey">{{ $t('pages.emuseum.dankrae_title') }}</h5>
                        <p class="mb-4">
                            {{ $t('pages.emuseum.dankrae_text') }}
                        </p>
                        <div class="d-flex justify-content-sm-end">
                            <Link :href="route('customer.e-museum.fossil_experts')" class="rounded text-uppercase btn-mit">
                                {{ $t('form.explore') }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </CustomerLayout>
</template>
