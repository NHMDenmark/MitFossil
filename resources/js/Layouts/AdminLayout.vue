<script setup>
import IconPage from '@/Components/Icons/IconPage.vue';
import IconLogout from "@/Components/Icons/IconLogout.vue";
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';
import FooterLayout from "@/Layouts/partials/FooterLayout.vue";
import IconProfile from "@/Components/Icons/IconProfile.vue";
import IconMap from "@/Components/Icons/IconMap.vue";
import IconResource from "@/Components/Icons/IconResource.vue";
</script>

<template>
    <div class="min-h-screen">
        <nav class="navbar navbar-top navbar-expand-lg bg-white py-2 py-lg-3 fixed-top">
            <div class="container-fluid px-4 px-md-5">
                <div class="navbar-container">
                    <Link class="navbar-brand" :href="route('admin.home')">
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
                        <nav-link :href="route('admin.home')" class="d-lg-none" >{{ $t('layout.admin.dashboard_text') }}</nav-link>
                        <nav-link :href="route('logout')" method="post" as="button" class="d-lg-none">{{ $t('layout.admin.logout_text') }}</nav-link>
                    </ul>
                    <div class="navbar-text text-uppercase c-black fw-700 p-0">
                        <span class="header-text-logo">
                            <!--{{ $t('layout.admin.title') }}-->
                            <img class="img-fluid" src="/storage/images/SNM-logo.svg" alt="STATENS NATURHISTORISKE MUSEUM">
                        </span>
                    </div>
                </div>
            </div>
        </nav>

        <main class="main admin">
            <div class="d-flex">
                <div class="flex-sidebar bg-grey-5">
                    <nav class="navbar">
                        <div class="container-fluid p-0">
                            <div class="w-100" id="navbarSide">
                                <ul class="navbar-nav">
                                    <NavLink :href="route('customer.dashboard')" :active="route().current('customer.dashboard')">
                                        <IconPage></IconPage>
                                        <span class="nav-text">{{ $t('layout.admin.dashboard_text') }}</span>
                                    </NavLink>
                                    <NavLink :href="route('admin.home')" :active="route().current('admin.home')">
                                        <IconPage></IconPage>
                                        <span class="nav-text">{{ $t('layout.admin.home_text') }}</span>
                                    </NavLink>
                                    <NavLink :href="route('admin.profile.edit')" :active="route().current('admin.profile.edit')">
                                        <IconProfile></IconProfile>
                                        <span class="nav-text">{{ $t('layout.admin.profile_text') }}</span>
                                    </NavLink>
                                    <NavLink :href="route('admin.users.index')" :active="
                                        route().current('admin.users.index') ||
                                        route().current('admin.users.create') ||
                                        route().current('admin.users.edit')">
                                        <IconProfile></IconProfile>
                                        <span class="nav-text">{{ $t('layout.admin.user_text_up') }}</span>
                                    </NavLink>
                                    <NavLink :href="route('admin.customer.index')" :active="
                                        route().current('admin.customer.index') ||
                                        route().current('admin.customer.edit')">
                                        <IconProfile></IconProfile>
                                        <span class="nav-text">{{ $t('layout.admin.customer_text') }}</span>
                                    </NavLink>
                                    <NavLink href="#" :active="route().current('admin.fossil-classes.index') ||
                                        route().current('admin.fossil-commons.index') ||
                                        route().current('admin.fossil-kingdoms.index') ||
                                        route().current('admin.fossil-phylums.index') ||
                                        route().current('admin.fossil-families.index') ||
                                        route().current('admin.fossil-genres.index') ||
                                        route().current('admin.fossil-subgenres.index') ||
                                        route().current('admin.fossil-orders.index') ||
                                        route().current('admin.specific-epithets.index') ||
                                        route().current('admin.fossil-subspecies.index') ||
                                        route().current('admin.fossil-taxonomies.index')">
                                        <IconPage></IconPage>
                                        <span class="nav-text">{{ $t('layout.admin.identify_text') }}</span>
                                        <template #submenu>
                                            <NavLink :href="route('admin.fossil-commons.index')" :active="route().current('admin.fossil-commons.index')">
                                                <span class="nav-text">{{ $t('layout.admin.commons_text') }}</span>
                                            </NavLink>
                                            <NavLink :href="route('admin.fossil-kingdoms.index')" :active="route().current('admin.fossil-kingdoms.index')">
                                                <span class="nav-text">{{ $t('layout.admin.kingdoms_text') }}</span>
                                            </NavLink>
                                            <NavLink :href="route('admin.fossil-phylums.index')" :active="route().current('admin.fossil-phylums.index')">
                                                <span class="nav-text">{{ $t('layout.admin.phylums_text') }}</span>
                                            </NavLink>
                                            <NavLink :href="route('admin.fossil-classes.index')" :active="route().current('admin.fossil-classes.index')">
                                                <span class="nav-text">{{ $t('layout.admin.classes_text') }}</span>
                                            </NavLink>
                                            <NavLink :href="route('admin.fossil-orders.index')" :active="route().current('admin.fossil-orders.index')">
                                                <span class="nav-text">{{ $t('layout.admin.orders_text') }}</span>
                                            </NavLink>
                                            <NavLink :href="route('admin.fossil-families.index')" :active="route().current('admin.fossil-families.index')">
                                                <span class="nav-text">{{ $t('layout.admin.families_text') }}</span>
                                            </NavLink>
                                            <NavLink :href="route('admin.fossil-genres.index')" :active="route().current('admin.fossil-genres.index')">
                                                <span class="nav-text">{{ $t('layout.admin.genres_text') }}</span>
                                            </NavLink>
                                            <NavLink :href="route('admin.specific-epithets.index')" :active="route().current('admin.specific-epithets.index')">
                                                <span class="nav-text">{{ $t('layout.admin.specific_epithets_text') }}</span>
                                            </NavLink>
                                            <NavLink :href="route('admin.fossil-taxonomies.index')" :active="route().current('admin.fossil-taxonomies.index')">
                                                <span class="nav-text">{{ $t('layout.admin.taxonomies_text') }}</span>
                                            </NavLink>
                                        </template>
                                    </NavLink>
                                    <NavLink href="#" :active="route().current('admin.eons.index') ||
                                         route().current('admin.eras.index') ||
                                         route().current('admin.periods.index') ||
                                         route().current('admin.epochs.index') ||
                                         route().current('admin.ages.index')">
                                        <IconPage></IconPage>
                                        <span class="nav-text">{{ $t('layout.admin.geological_context_text') }}</span>
                                        <template #submenu>
                                            <NavLink :href="route('admin.eons.index')" :active="route().current('admin.eons.index')">
                                                <span class="nav-text">{{ $t('layout.admin.eons_text') }}</span>
                                            </NavLink>
                                            <NavLink :href="route('admin.eras.index')" :active="route().current('admin.eras.index')">
                                                <span class="nav-text">{{ $t('layout.admin.eras_text') }}</span>
                                            </NavLink>
                                            <NavLink :href="route('admin.periods.index')" :active="route().current('admin.periods.index')">
                                                <span class="nav-text">{{ $t('layout.admin.periods_text') }}</span>
                                            </NavLink>
                                            <NavLink :href="route('admin.epochs.index')" :active="route().current('admin.epochs.index')">
                                                <span class="nav-text">{{ $t('layout.admin.epochs_text') }}</span>
                                            </NavLink>
                                            <NavLink :href="route('admin.ages.index')" :active="route().current('admin.ages.index')">
                                                <span class="nav-text">{{ $t('layout.admin.ages_text') }}</span>
                                            </NavLink>
                                        </template>
                                    </NavLink>
                                    <NavLink :href="route('admin.resources.index')" :active="
                                        route().current('admin.resources.index') ||
                                        route().current('admin.resources.create') ||
                                        route().current('admin.resources.edit')">
                                        <IconResource></IconResource>
                                        <span class="nav-text">{{ $t('layout.admin.resources_text') }}</span>
                                    </NavLink>
                                    <NavLink :href="route('admin.map-resources.index')" :active="
                                        route().current('admin.map-resources.index') ||
                                        route().current('admin.map-resources.create') ||
                                        route().current('admin.map-resources.edit')">
                                        <IconMap></IconMap>
                                        <span class="nav-text">{{ $t('layout.admin.map_resources_text') }}</span>
                                    </NavLink>
                                    <NavLink :href="route('admin.news.index')" :active="
                                        route().current('admin.news.index') ||
                                        route().current('admin.news.create') ||
                                        route().current('admin.news.edit')">
                                        <IconResource></IconResource>
                                        <span class="nav-text">{{ $t('layout.admin.news_text') }}</span>
                                    </NavLink>
                                    <NavLink :href="route('admin.files.index')" :active="
                                        route().current('admin.files.index') ||
                                        route().current('admin.files.create') ||
                                        route().current('admin.files.edit')">
                                        <IconResource></IconResource>
                                        <span class="nav-text">{{ $t('layout.admin.files_text') }}</span>
                                    </NavLink>
                                    <NavLink :href="route('admin.copyright-rules.index')" :active="
                                        route().current('admin.copyright-rules.index') ||
                                        route().current('admin.copyright-rules.create') ||
                                        route().current('admin.copyright-rules.edit')">
                                        <IconResource></IconResource>
                                        <span class="nav-text">{{ $t('layout.admin.copyright_rules_text') }}</span>
                                    </NavLink>
                                    <NavLink v-if="$page.props.auth.user" :href="route('admin.notifications')" :active="route().current('admin.notifications') ||
                                        route().current('admin.notifications.show')">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path fill="#9FA2B4" opacity="0.4" d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"/></svg>
                                        <span class="nav-text">{{ $t('layout.customer.notifications_text') }}</span>
                                        <span v-if="$page.props.auth.notifications > 0" class="nav-badge"><span class="nav-badge-num">{{ $page.props.auth.notifications }}</span></span>
                                    </NavLink>
                                    <NavLink :href="route('logout')" method="post" as="button">
                                        <IconLogout></IconLogout>
                                        <span class="nav-text">{{ $t('layout.admin.logout_text') }}</span>
                                    </NavLink>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>

                <slot></slot>
            </div>

            <FooterLayout></FooterLayout>
        </main>
    </div>
</template>
