<script setup>
import NavLink from "@/Components/NavLink.vue";
import { Link } from '@inertiajs/vue3';
import FooterLayout from "@/Layouts/partials/FooterLayout.vue";
</script>

<template>
    <div class="min-h-screen">
        <nav class="navbar navbar-top navbar-expand-lg bg-white py-2 py-lg-3 fixed-top">
            <div class="container-fluid px-4 px-md-5">
                <div class="navbar-container">
                    <Link class="navbar-brand" :href="route('welcome')">
                        <img class="img-fluid logo" src="/storage/images/mitfossil-logo.png" alt="MitFossil">
                        <img class="img-fluid logo-text" src="/storage/images/mit-fossil-logo.svg" alt="MitFossil">
                    </Link>
                    <div class="navbar-mobile-right">
                        <div class="navbar-text text-uppercase c-black fw-700 p-0">
                            <span class="header-text-logo">
                                <!--{{ $t('layout.customer.title') }}-->
                                <img class="img-fluid" src="/storage/images/SNM-logo.svg" alt="STATENS NATURHISTORISKE MUSEUM">
                            </span>
                        </div>
                        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTop" aria-controls="navbarTop" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar top-bar"></span>
                            <span class="icon-bar middle-bar"></span>
                            <span class="icon-bar bottom-bar"></span>
                        </button>
                    </div>
                </div>
                <div class="collapse navbar-collapse gap-5" id="navbarTop">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-3 gap-lg-4">
                        <template v-if="!$page.props.auth.user">
                            <nav-link :href="route('login')">{{ $t('layout.guest.login_text') }}</nav-link>
                            <nav-link :href="route('register')"> {{ $t('layout.guest.register_text') }} </nav-link>
                        </template>
                        <template v-if="$page.props.auth.user">
                            <nav-link v-if="$page.props.auth.user.role !== 'admin'" :href="route('customer.dashboard')">{{ $t('layout.guest.dashboard_text') }}</nav-link>
                            <nav-link v-if="$page.props.auth.user.role === 'admin'" :href="route('admin.home')">{{ $t('layout.admin.admin_text') }}</nav-link>
                            <nav-link :href="route('logout')" method="post" as="button"> {{ $t('layout.guest.logout_text') }} </nav-link>
                        </template>
                    </ul>
                    <div class="navbar-text text-uppercase c-black fw-700 p-0">
                        <span class="header-text-logo">
                            <!--{{ $t('layout.guest.title') }}-->
                            <img class="img-fluid" src="/storage/images/SNM-logo.svg" alt="STATENS NATURHISTORISKE MUSEUM">
                        </span>
                    </div>
                </div>
            </div>
        </nav>

        <main class="main guest">
            <slot></slot>

            <FooterLayout></FooterLayout>
        </main>
    </div>
</template>
