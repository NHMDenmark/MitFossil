<template>
    <input
        class="form-control"
        type="file"
        @input="$emit('update:modelValue', $event.target.files[0])"
        ref="input"
    />
</template>

<script setup>
import { ref } from 'vue';

defineProps({
    modelValue: {
        type: String,
        required: true,
    },
});

defineEmits(['update:modelValue']);

const input = ref(null);

</script>
