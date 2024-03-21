<template>
    <div class="form-check d-inline-flex">
        <input class="form-check-input" type="checkbox" :value="value" :id="id" :checked="checked" :disabled="disabled === true || disabled === 1"
               @input="onInput">
        <label class="form-check-label" :for="id">
            <slot></slot>
        </label>
    </div>
</template>

<script setup>
import {computed} from "vue";

const props = defineProps({
    modelValue: { types: [String, Boolean, null] },
    id: { type: String },
    value: { types: [String, Number, Boolean, null] },
    disabled: { types: [Boolean, Number] }
});

const emit = defineEmits(['update:modelValue', 'input']);

const checked = computed(() => {
    return props.modelValue === props.value;
});

function onInput(event) {
    if(typeof props.modelValue === 'boolean') {
        emit('update:modelValue', event.target.checked);
    } else {
        emit('update:modelValue', event.target.value);
    }

    emit('input', event.target.checked);
}

</script>
