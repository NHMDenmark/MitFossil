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
                        <PrimaryButton class="me-2 align-self-end" type="link" :url="route('threads.create')">Opret en ny samtale</PrimaryButton>
                        <h2 class="mb-4">Kontakt MitFossils {{user.role == 'admin' ? 'brugere' : 'administratorer'}}</h2>
                        <div v-if="threads.length > 0" class="d-flex flex-column">
                            <table class="table table-responsive-xxl">
                                <tr>
                                    <th>Oprettet af</th>
                                    <th>Sendt til</th>
                                    <th>Emne</th>
                                    <th>Overskrift</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                <tr v-for="thread in threads">
                                    <td>{{ thread.sender.username }}</td>
                                    <td>{{ thread.receiver.username }}</td>
                                    <td>{{ thread.category }}</td>
                                    <td>{{ thread.title }}</td>
                                    <td>{{ thread.status === 'open' ? 'Åben' : 'Lukket' }}</td>
                                    <td><PrimaryButton type="link" :url="route('threads.get', thread.id)">Åbn samtalen</PrimaryButton></td>
                                </tr>
                            </table>
                        </div>
                        <span v-else>Ingen oprettede samtaler</span>
                    </div>
                </div>
            </div>
        </div>
    </CustomerLayout>
</template>
