<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button
        :type="type"
        class="btn btn-secondary rounded"
    >
        <slot />
    </button>
</template>
