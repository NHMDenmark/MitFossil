<template>
    <div class="row">
        <div class="col">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                <h5> My Collection </h5>

                <slot></slot>

                <div class="row">
                    <div v-for="item in collections" :key="item.id" class="col-4">
                        <img :src="item.path" :alt="item.class">
                    </div>
                </div>

                <div class="text-end">
                    <PrimaryButton>SEE MORE</PrimaryButton>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
    collections: { type: Array }
})
</script>
