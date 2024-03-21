<script setup>
    defineProps({
        show: { type: Boolean, default: false }
    })
</script>

<template>
    <div class="row justify-content-center">
        <div class="col-4">
            <img v-if="show" src="/storage/images/loading.gif" alt="loading" class="img-fluid">
        </div>
    </div>
</template>
