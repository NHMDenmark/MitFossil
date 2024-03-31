<script setup>
import IconPage from '@/Components/Icons/IconPage.vue';
import IconProfile from '@/Components/Icons/IconProfile.vue';
import IconUploadFind from "@/Components/Icons/IconUploadFind.vue";
import IconMap from "@/Components/Icons/IconMap.vue";
import IconIdentify from "@/Components/Icons/IconIdentify.vue";
import IconMuseum from "@/Components/Icons/IconMuseum.vue";
import IconResource from "@/Components/Icons/IconResource.vue";
import IconLogout from "@/Components/Icons/IconLogout.vue";
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';
import FooterLayout from "@/Layouts/partials/FooterLayout.vue";
</script>

<template>
    <div class="min-h-screen">
        <nav class="navbar navbar-top navbar-expand-lg bg-white py-2 py-lg-3 fixed-top">
            <div class="container-fluid px-4 px-md-5">
                <div class="navbar-container">
                    <Link class="navbar-brand" :href="route( $page.props.auth.user ? 'customer.dashboard' : 'welcome')">
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
                        <nav-link v-if="$page.props.auth.user?.role === 'admin'" :href="route('admin.home')" class="d-lg-none" >{{ $t('layout.customer.admin_text') }}</nav-link>
                        <nav-link :href="route('customer.dashboard')" class="d-lg-none" >{{ $t('layout.customer.my_page_text') }}</nav-link>
                        <nav-link v-if="$page.props.auth.user && $page.props.auth.user?.role !== 'admin'" :href="route('customer.profile.edit')" class="d-lg-none">{{ $t('layout.customer.my_profile_text') }}</nav-link>
                        <nav-link v-if="$page.props.auth.user && $page.props.auth.user?.role !== 'admin'" :href="route('customer.new-fossil')" class="d-lg-none">{{ $t('layout.customer.upload_find_text') }}</nav-link>
                        <nav-link :href="route('customer.e-museum.map')" class="d-lg-none">{{ $t('layout.customer.map_text') }}</nav-link>
                        <nav-link :href="route('customer.identify-finds')" class="d-lg-none">{{ $t('layout.customer.identify_find_text') }}</nav-link>
                        <nav-link :href="route('customer.e-museum')" class="d-lg-none">{{ $t('layout.customer.emuseum_text') }}</nav-link>
                        <nav-link :href="route('customer.resources')" class="d-lg-none">{{ $t('layout.customer.resources_text') }}</nav-link>
                        <nav-link v-if="$page.props.auth.user" :href="route('customer.notifications')">{{ $t('layout.customer.notifications_text') }}</nav-link>
                        <nav-link v-if="$page.props.auth.user" :href="route('threads.index')">{{ $t('layout.customer.threads') }}</nav-link>
                        <nav-link v-if="$page.props.auth.user" :href="route('logout')" class="d-lg-none" method="post" as="button">{{ $t('layout.customer.logout_text') }}</nav-link>
                    </ul>
                    <div class="navbar-text text-uppercase c-black fw-700 p-0">
                        <span class="header-text-logo">
                            <!--{{ $t('layout.customer.title') }}-->
                            <img class="img-fluid" src="/storage/images/SNM-logo.svg" alt="STATENS NATURHISTORISKE MUSEUM">
                        </span>
                    </div>
                </div>
            </div>
        </nav>

        <main class="main customer">
            <div class="d-flex">
                <div class="flex-sidebar bg-dark-green">
                    <nav class="navbar">
                        <div class="container-fluid p-0">
                            <div class="w-100" id="navbarSide">
                                <ul class="navbar-nav">
                                    <NavLink v-if="$page.props.auth.user?.role === 'admin'" :href="route('admin.home')" :active="route().current('admin.home')">
                                        <IconPage></IconPage>
                                        <span class="nav-text">{{ $t('layout.customer.admin_text') }}</span>
                                    </NavLink>

                                    <NavLink  :href="route('customer.dashboard')" :active="route().current('customer.dashboard') || route().current('customer.my-collection')">
                                        <IconPage></IconPage>
                                        <span class="nav-text">{{ $t('layout.customer.my_page_text') }}</span>
                                    </NavLink>

                                    <NavLink v-show="$page.props.auth.user && $page.props.auth.user?.role !== 'admin'" :href="route('customer.profile.edit')" :active="route().current('customer.profile.edit')">
                                        <IconProfile></IconProfile>
                                        <span class="nav-text">{{ $t('layout.customer.my_profile_text') }}</span>
                                    </NavLink>

                                    <NavLink v-show="$page.props.auth.user && $page.props.auth.user?.role !== 'admin'" :href="route('customer.new-fossil')" :active="route().current('customer.new-fossil')">
                                        <IconUploadFind></IconUploadFind>
                                        <span class="nav-text">{{ $t('layout.customer.upload_find_text') }}</span>
                                    </NavLink>
                                    <NavLink :href="route('customer.e-museum.map')" :active="route().current('customer.e-museum.map')">
                                        <IconMap></IconMap>
                                        <span class="nav-text">{{ $t('layout.customer.map_text') }}</span>
                                    </NavLink>
                                    <NavLink :href="route('customer.identify-finds')" :active="route().current('customer.identify-finds')">
                                        <IconIdentify></IconIdentify>
                                        <span class="nav-text">{{ $t('layout.customer.identify_find_text') }}</span>
                                    </NavLink>
                                    <NavLink :href="route('customer.e-museum')" :active="
                                        route().current('customer.e-museum') ||
                                        route().current('customer.e-museum.curated') ||
                                        route().current('customer.e-museum.experts') ||
                                        route().current('customer.e-museum.fossil_experts')">
                                        <IconMuseum></IconMuseum>
                                        <span class="nav-text">{{ $t('layout.customer.emuseum_text') }}</span>
                                    </NavLink>
                                    <NavLink :href="route('customer.resources')" :active="route().current('customer.resources') ||
                                        route().current('customer.resources.show') ||
                                        route().current('customer.resources.map')">
                                        <IconResource></IconResource>
                                        <span class="nav-text">{{ $t('layout.customer.resources_text') }}</span>
                                    </NavLink>
                                    <NavLink v-if="$page.props.auth.user" :href="route('customer.notifications')" :active="route().current('customer.notifications') ||
                                        route().current('customer.notifications.show')">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path fill="#9FA2B4" opacity="0.4" d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"/></svg>
                                        <span class="nav-text">{{ $t('layout.customer.notifications_text') }}</span>
                                        <span v-if="$page.props.auth.notifications > 0" class="nav-badge"><span class="nav-badge-num">{{ $page.props.auth.notifications }}</span></span>
                                    </NavLink>
                                    <NavLink v-if="$page.props.auth.user" :href="route('threads.index')" :active="route().current('threads.index') ||
                                        route().current('threads.create') || route().current('threads.get')">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 121.58 122.88"><path fill="#9FA2B4" opacity="0.4" d="M25.8,111.27,44.08,94.69a3.46,3.46,0,0,1,2.41-1h66.18a2,2,0,0,0,2-1.95V8.9a2,2,0,0,0-2-1.95H8.9A1.95,1.95,0,0,0,7,8.9V91.76a1.95,1.95,0,0,0,2,1.95H22.33a3.48,3.48,0,0,1,3.47,3.48v14.08Zm1.17-45a3.48,3.48,0,0,0,0,7H68a3.48,3.48,0,0,0,0-7Zm0-39.86a3.48,3.48,0,0,0,0,7H94.69a3.48,3.48,0,1,0,0-6.95Zm0,19.93a3.48,3.48,0,0,0,0,6.95H87.66a3.48,3.48,0,0,0,0-6.95Zm20.9,54.32-23,21.07a3.48,3.48,0,0,1-6.06-2.32V100.66H8.9A8.91,8.91,0,0,1,0,91.76V8.9A8.91,8.91,0,0,1,8.9,0H112.67a8.93,8.93,0,0,1,8.91,8.9V91.76a8.93,8.93,0,0,1-8.91,8.9Z"/></svg>
                                        <span class="nav-text">{{ $t('layout.customer.threads') }}</span>
                                    </NavLink>
                                    <NavLink v-show="$page.props.auth.user" :href="route('logout')" method="post" as="button">
                                        <IconLogout></IconLogout>
                                        <span class="nav-text">{{ $t('layout.customer.logout_text') }}</span>
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
