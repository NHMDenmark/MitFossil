<script setup>
import {Head, Link} from "@inertiajs/vue3";
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
import CardResource from "@/Components/partials/CardResource.vue";

defineProps({
    resource: { type: Object }
})
</script>

<template>
    <Head :title="resource.name" />

    <CustomerLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="d-flex flex-column flex-xl-row gap-45 align-items-start mt-4">
                <div class="col bg-white border-light shadow rounded p-0 col-divider">
                    <div class="row p-4">
                        <h5 class="heading-s fw-700 mb-3">{{ resource.name }}</h5>

                        <div class="p-3 mit-resource" v-html="resource.html">
                        </div>
                        <div v-if="resource.childs" class="col">
                            <div class="row mt-3">
                                <CardResource v-for="item in resource.childs"
                                            :key="item.id"
                                            :resource="item"
                                            :redirect="true"
                                            class="my-2 col-sm-12 col-md-12 col-xl-6"
                                            @click="">
                                </CardResource>
                            </div>
                        </div>
                        <div class="d-flex justify-content-sm-end mt-3">
                            <Link v-if="resource.parent" :href="route('customer.resources.show', resource.parent.endpoint)" class="rounded text-uppercase btn-mit">
                                {{ $t('form.back') }}
                            </Link>
                            <Link v-else :href="route('customer.resources')" class="rounded text-uppercase btn-mit">
                                {{ $t('form.back') }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </CustomerLayout>
</template>
