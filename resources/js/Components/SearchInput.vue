<template>
    <div class="form-group search">
        <label for="" class="text-uppercase label-width-auto">{{ placeholder }}</label>
        <input
            class="form-control rounded "
            :class="className"
            :type="type"
            :value="modelValue"
            :placeholder="placeholder"
            :autofocus="autofocus"
            :autocomplete="autocomplete"
            @input="$emit('update:modelValue', $event.target.value)"
            ref="input"
        />

        <i v-if="modelValue?.length > 0" @click="onClear" class="fa-solid fa-xmark icon-close" ></i>
    </div>
</template>

<script setup>
import {computed, onMounted, ref} from 'vue';
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";

const props = defineProps({
    modelValue: {
        types: [String, null, undefined],
        required: true,
    },
    className: { type: String },
    type: { type: String },
    placeholder: { type: String },
    autofocus: { type: Boolean },
    autocomplete: { type: String }
});

const emit = defineEmits(['update:modelValue', 'clear']);

const input = ref(null);
const icon = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });

function onClear() {
    emit('update:modelValue', undefined);
    emit('clear');
}
</script>

<style scoped>
.search {
    position: relative;
}
.icon-close {
    position: absolute;
    padding: 3px;
    top: 10px;
    right: 18px;
    cursor: pointer;
}

.icon-close:hover {
    border: 1px solid #86b7fe;
    border-radius: 3px;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25);
}
</style>
