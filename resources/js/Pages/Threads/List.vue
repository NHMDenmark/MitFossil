<script setup>
import {Head} from "@inertiajs/vue3";
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({ threads: Array, user: Object })
</script>

<template>
    <Head :title="$t('pages.threads.list_title')" />

    <CustomerLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="d-flex flex-column flex-xl-row gap-45 align-items-start">
                <div class="col bg-white border-light shadow rounded p-4 pt-5">
                    <div class="d-flex flex-column text-center">
                        <PrimaryButton v-if="user.role != 'admin'" class="me-2 align-self-end" type="link" :url="route('threads.create')">Send new message</PrimaryButton>
                        <h2 class="mb-4">Threads</h2>
                        <div v-if="threads.length > 0" class="d-flex flex-column">
                            <table class="table table-responsive-xxl">
                                <tr>
                                    <th>Created By</th>
                                    <th>Receiver</th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                <tr v-for="thread in threads">
                                    <td>{{ thread.sender.username }}</td>
                                    <td>{{ thread.receiver.username }}</td>
                                    <td>{{ thread.category }}</td>
                                    <td>{{ thread.title }}</td>
                                    <td>{{ thread.status }}</td>
                                    <td><PrimaryButton type="link" :url="route('threads.get', thread.id)">View</PrimaryButton></td>
                                </tr>
                            </table>
                        </div>
                        <span v-else>Nothing to show yet</span>
                    </div>
                </div>
            </div>
        </div>
    </CustomerLayout>
</template>