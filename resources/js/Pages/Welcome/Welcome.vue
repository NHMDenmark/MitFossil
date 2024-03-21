<script setup>
import {Head} from '@inertiajs/vue3';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import MiniCards from "@/Components/MiniCards.vue";
import CardNews from "@/Components/partials/CardNews.vue";
import CardLink from "@/Pages/Welcome/Partials/CardLink.vue";

defineProps({
    cantTodayUploadsFossils: { type: Number },
    cantTotalFossils: { type: Number },
    cantMembers: { type: Number },
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <Head :title="$t('pages.welcome.title')"/>

    <GuestLayout>
        <div class="welcome jumbotron w-100">

            <div class="degrade py-3">
                <div class="container p-4 py-md-5 text-center">
                    <div class="row justify-content-center">
                        <h1 class="fs-60 fw-300 text-light">{{ $t('pages.welcome.about_title') }}</h1>
                        <div class="col-10">
                            <p class="text-light text-m">
                                {{ $t('pages.welcome.about_text') }}
                            </p>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-5 grid-card">
                        <CardLink
                            :title="$t('pages.welcome.registration_title')"
                            :text="$t('pages.welcome.registration_text')"
                            :action="$t('pages.welcome.registration_action')"
                            url="/register/"
                            image="/storage/images/welcome-bruger.webp"
                         />

                        <CardLink
                            :title="$t('pages.welcome.resources_title')"
                            :text="$t('pages.welcome.resources_text')"
                            :action="$t('pages.welcome.resources_action')"
                            url="/resources/"
                            image="/storage/images/welcome-ressourcer.webp" />

                        <CardLink
                            :title="$t('pages.welcome.emuseum_title')"
                            :text="$t('pages.welcome.emuseum_text')"
                            :action="$t('pages.welcome.emuseum_action')"
                            url="/e-museum/"
                            image="/storage/images/welcome-emuseum.webp" />
                    </div>
                </div>
            </div>
        </div>

        <div class="container p-3 pb-4 py-md-5">
            <div class="row justify-content-center grid-mini-card pt-3">
                <MiniCards :label="$t('pages.my_page.total_upload_text')" :value="cantTotalFossils"></MiniCards>
                <MiniCards :label="$t('pages.my_page.today_upload_text')" :value="cantTodayUploadsFossils"></MiniCards>
                <MiniCards :label="$t('pages.my_page.members_text')" :value="cantMembers"></MiniCards>
            </div>
        </div>

        <div class="container p-4 pt-3 pb-5">
            <h1 class="fs-60 fw-300 text-center">
                {{ $t('pages.welcome.news_title') }}
            </h1>
            <div class="row justify-content-center mt-5">
                <CardNews variant="home" class="col-12 col-lg-9 "></CardNews>
            </div>
        </div>
    </GuestLayout>
</template>

