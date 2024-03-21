<script setup>
import CustomerLayout from '@/Layouts/CustomerLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import {Head, usePage} from '@inertiajs/vue3';
import CardStats from "@/Components/partials/CardStats.vue";
import CardCollections from "@/Pages/Customer/Dashboard/Partials/CardCollections.vue";
import ModalView from "@/Components/partials/Modal/ModalView.vue";
import {onMounted} from "vue";
import emitter from 'tiny-emitter/instance';

onMounted(() => {
    if(props.fossil) {
        emitter.emit('show_fossil', props.fossil);
    }
});

const props = defineProps({
    myCollections: { type: Array },
    mustVerifyEmail: { type: Boolean },
    status: { type: String },
    copyright_rules: { type: Array },
    fossilRegion: { type: Array },
    fossilSpecialities: { type: Array },
    fossil: { type: Object }
});

const user = usePage().props.auth.user;
</script>

<template>
    <Head :title="$t('pages.profile.title')" />

    <CustomerLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="d-flex flex-column flex-xl-row gap-45 align-items-start">
                <div class="col bg-white border-light shadow rounded p-0 col-divider">
                    <UpdateProfileInformationForm
                        :copyright_rules="copyright_rules"
                        :fossil-region="fossilRegion"
                        :fossil-specialities="fossilSpecialities"
                        :must-verify-email="mustVerifyEmail"
                        :status="status" />

                    <UpdatePasswordForm
                        class="max-w-xl" />

                    <DeleteUserForm
                        class="max-w-xl" />
                </div>
                <div class="col">
                    <CardStats></CardStats>

                    <div class="col bg-white border-light rounded shadow mt-45">
                        <CardCollections
                            :title="$t('pages.my_collection.title')"
                            :url="route('customer.my-collection')"
                            :collections="myCollections">
                        </CardCollections>
                    </div>
                </div>
            </div>
        </div>
        <ModalView></ModalView>
    </CustomerLayout>
</template>
