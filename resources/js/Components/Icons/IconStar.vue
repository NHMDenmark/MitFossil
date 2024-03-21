<script setup>
defineProps({
    type: { type: String, default: 'empty' }
})
</script>

<template>
    <div>
        <i class="fa-regular fa-star" v-if="type === 'empty'"></i>
        <i class="fa-solid fa-star-half-stroke" v-if="type === 'half'"></i>
        <i class="fa-solid fa-star" v-if="type === 'full'"></i>
    </div>
</template>
