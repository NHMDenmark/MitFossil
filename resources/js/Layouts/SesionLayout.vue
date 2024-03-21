<template>
    <div class="container-fluid g-0">
        <div class="row g-0">
            <div class="col-12 col-md-5 image-gradient">
                <img class="min-h-100 img-fluid object-fit-cover w-100 max-h-xs-300 max-h-xs-300 max-vh-xxl-100" :src="image">
            </div>
            <div class="col-12 col-md-7 min-h-screen-md d-flex flex-column justify-content-center align-items-center p-4 p-md-5">
                <a :href="link"><img class="img-fluid pb-4" src="/storage/images/mit-fossil-logo.svg"></a>
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    image: { type: String },
    link: { type: String }
})
</script>
