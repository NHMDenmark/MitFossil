<script setup>
defineProps({
   title: { type: String }
});
</script>

<template>
    <div class="d-flex flex-column flex-xl-row gap-45 align-items-start">
        <div class="col bg-white border-light shadow rounded p-3">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3 class="heading-xl mt-1 mb-1">{{ title }}</h3>
                </div>
                <div class="col-12 col-sm-6 text-end">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>
