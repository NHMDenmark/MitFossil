<script setup>
import { ref } from 'vue';

defineProps({
    modelValue: { types: [String, Number, null] },
});

const emit = defineEmits(['update:modelValue']);

const input = ref(null);

function onInput(event) {
    const cleanedValue = input.value.value.replace(/[^0-9,]/g, '');
    const coma = cleanedValue.slice(-1) === ',' && (cleanedValue.match(/,/g) || []).length < 2;

    let result = null;

    if(cleanedValue.length > 0) {
        const parts = cleanedValue.split(',');

        const integerPart = parts[0];
        const decimalPart = parts[1] || '';

        result = integerPart + (decimalPart ? ',' + decimalPart : '');
    }

    emit('update:modelValue', result);
    input.value.value = coma ? result + ',' : result;
}

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="form-control"
        :value="modelValue"
        @input="onInput"
        ref="input"
    />
</template>
