<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
    title: { type: String },
    image: { type: String },
    text: { type: String },
    url: { type: String },
    action: { type: String }
})
</script>

<template>
    <div class="card">
        <div class="card-body card-welcome">
            <h5 class="heading-l"><b>{{ title }}</b></h5>
            <img :src="image" alt="default" class="img-fluid my-3">
            <p class="mb-3">{{ text }}</p>
            <PrimaryButton :url="url" class="card-button">{{ action }}</PrimaryButton>
        </div>
    </div>
</template>
