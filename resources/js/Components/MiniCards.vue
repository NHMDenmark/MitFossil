<template>
    <div :class="'col-' + col" class="px-3 mini-card">
        <div class="mini-card-content bg-white text-center p-3 border-light rounded shadow">
            <h5 :class="textSize" class="heading-s fw-700 c-grey">{{ label }}</h5>
            <span :class="titleSize" class="heading-xl fw-700">{{ value }}</span>
        </div>
    </div>
</template>

<script setup>

defineProps({
    textSize: { type: String },
    titleSize: { type: String },
    label: { type: String },
    value: { types: [String ,Number, null] },
    col: { types: [String, Number], default: 4 }
});
</script>
