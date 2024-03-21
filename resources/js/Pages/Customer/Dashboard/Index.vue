<script setup>
import CustomerLayout from '@/Layouts/CustomerLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import MiniCards from "@/Components/MiniCards.vue";
import CardCollections from "@/Pages/Customer/Dashboard/Partials/CardCollections.vue";
import CardNews from "@/Components/partials/CardNews.vue";
import CardStats from "@/Components/partials/CardStats.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ModalView from "@/Components/partials/Modal/ModalView.vue";
import emitter from 'tiny-emitter/instance'
import {onMounted} from "vue";

const user = usePage().props.auth.user;

const props = defineProps({
    myCollections: { type: Array },
    uploadsFossils: { type: Array },
    identityFossils: { type: Array },
    cantTodayUploadsFossils: { type: Number },
    cantTotalFossils: { type: Number },
    cantMembers: { type: Number },
    fossil: { type: Object }
})

onMounted(() => {
    if(props.fossil) {
        emitter.emit('show_fossil', props.fossil);
    }
});
</script>

<template>
    <Head :title="$t('pages.my_page.title')" ></Head>

    <CustomerLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="d-flex flex-column flex-xl-row gap-45 align-items-start">
                <div class="col">
                    <div class="">
                        <div class="col bg-white border-light shadow rounded p-0 col-divider">
                            <CardCollections
                                v-if="user && user.role !== 'admin'"
                                :title="$t('pages.my_page.my_collection_title')"
                                :url="route('customer.my-collection')"
                                :collections="myCollections">
                                <!--{{ $t('pages.my_page.my_collection_text') }}-->
                            </CardCollections>

                                <CardCollections
                                    :title="$t('pages.my_page.uploaded_fossils_title')"
                                    :url="route('customer.e-museum')"
                                    :collections="uploadsFossils">
                                </CardCollections>
                            <CardCollections
                                v-if="user"
                                :title="$t('pages.my_page.identify_fossils_title')"
                                :url="route('customer.identify-finds')"
                                :collections="identityFossils">
                            </CardCollections>
                        </div>
                    </div>

                    <div v-if="!user" class="row mt-3">
                        <div class="col p-0">
                            <primary-button :url="route('register')" class-name="w-100">
                                {{ $t('pages.welcome.registration_action') }}
                            </primary-button>
                        </div>
                    </div>
                </div>

                <div  class="col">
                    <div class="row" v-if="user">
                        <CardStats></CardStats>
                    </div>

                    <div class="row" :class="{'mt-45': user}" >
                        <MiniCards :label="$t('pages.my_page.total_upload_text')" :value="cantTotalFossils"></MiniCards>
                        <MiniCards :label="$t('pages.my_page.today_upload_text')" :value="cantTodayUploadsFossils"></MiniCards>
                        <MiniCards :label="$t('pages.my_page.members_text')" :value="cantMembers"></MiniCards>
                    </div>

                    <div class="row mt-45">
                        <CardNews :title="$t('pages.news.title')"></CardNews>
                    </div>
                </div>
            </div>
        </div>
        <ModalView></ModalView>
    </CustomerLayout>
</template>
