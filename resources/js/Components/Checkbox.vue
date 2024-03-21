<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: { type: [Array, Boolean], required: true},
    value: { default: null },
    label: {type: String},
    name: {type: String},
    disabled: { type: Boolean, default: false }
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>

<template>
    <div class="form-check d-flex">
        <input class="form-check-input" type="checkbox" :name="name" :id="name" :value="value" v-model="proxyChecked" :disabled="disabled">
        <label class="form-check-label fw-500 text-uppercase" :for="name" v-html="label"></label>
    </div>
</template>
