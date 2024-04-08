<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: { types: [String, Number, null], required: true },
    label: { type: String },
    name: { type: String },
    type: { type: String, default: 'text' },
    labelTop: { type: Boolean, default: false }
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <div class="d-flex flex-column" :class="{'flex-md-row': !labelTop, 'align-items-md-center': !labelTop}">
        <label class="text-uppercase" :for="name" :class="{'mb-2': labelTop}">
            <span> {{ label }}</span>
        </label>
        <template v-if="type !== 'textarea'">
            <input :value="modelValue"
                   @change="$emit('update:modelValue', $event.target.value)"
                   class="form-control rounded"
                   ref="input"
                   :type="type"
                   :name="name"
                   :placeholder="label"
                   :id="name"
                   :autocomplete="name">
        </template>
        <template v-else>
            <textarea :value="modelValue"
                   @change="$emit('update:modelValue', $event.target.value)"
                   class="form-control rounded"
                   ref="input"
                   :name="name"
                   :placeholder="label"
                   :id="name">
            </textarea>
        </template>
    </div>
</template>
