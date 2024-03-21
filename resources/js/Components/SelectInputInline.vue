<template>
    <div class="d-flex align-items-md-center flex-column flex-md-row">
        <label class="text-uppercase" for="username">
            <span> {{ label }}</span>
        </label>
        <Multiselect
            :value="modelValue"
            :placeholder="placeholder"
            :searchable="true"
            :groups="groups"
            :options="options"
            :classes="{ container: 'multiselect form-control rounded' }"
            @select="$emit('select', $event)"
            @deselect="$emit('select', null)"
            @clear="$emit('select', null)"
            @change="$emit('update:modelValue', $event)">

            <template v-if="withText" v-slot:option="{ option }">
                <div class="multiselect-text">
                    {{ option.label }} <i class="fa-solid fa-chevron-down"></i>
                </div>
            </template>
        </Multiselect>
    </div>
</template>

<script setup>
import Multiselect from "@vueform/multiselect";

defineProps({
    options: { type: Array },
    placeholder: { type: String },
    label: { type: String },
    groups: { type: Boolean, default: false },
    modelValue: {
        types: [String, Number, null]
    },
    withText: { type: Boolean, default: false }
});

defineEmits(['update:modelValue', 'select']);
</script>
