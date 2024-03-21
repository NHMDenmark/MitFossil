<script setup>
import {Head, Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineProps({ notifications: { type: Array } })
</script>

<template>
    <Head :title="$t('layout.customer.notifications_text')" />

    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div v-for="item of notifications" :key="item.id" class="d-flex flex-column flex-xl-row gap-45 align-items-start mt-4">
                <div class="col bg-white border-light shadow rounded p-0" :class="{'border-left': !item.viewed}">
                    <div class="row p-4 pb-0">
                        <div class="col">
                            <h5 class="heading-s fw-700 mb-3">{{ item.title }}</h5>
                            <p class="mb-4" v-html="item.text"></p>
                        </div>
                        <div class="col text-end">
                            <!--<p v-if="item.user_notificator">{{ $t('notifications.notified_by') }} {{ item.user_notificator.name }} <span class="text-uppercase">({{ item.user_notificator?.role }})</span> </p>-->
                            <p class="mb-0" v-if="item.user_notificator?.role === 'curator' || item.user_notificator?.role === 'customer'">
                                {{ $t('notifications.notified_by') }} {{ item.user_notificator.username }}
                            </p>
                            <p class="mb-0" v-else>
                                {{ $t('notifications.notified_by') }} Administrator
                            </p>
                            <p>{{ item.created_at }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-sm-end p-4 pt-0">
                        <Link :href="route('admin.notifications.update', item.id)" method="put" as="button" class="rounded text-uppercase btn-mit">
                            {{ $t('form.explore') }}
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
