<script setup>
import { ref, computed } from 'vue';

const emit = defineEmits(['update:modelValue']);

const show = ref(false);

const props = defineProps({
    modelValue: { types: [String, Number, null], required: true },
    options: { type: Array },
    label: { type: String },
    name: { type: String },
    placeholder: { type: String },
});

const suggest = computed(() => {
    if (!props.modelValue || props.modelValue.length < 1) { return props.options }

    const s = props.options.filter(x => x.label.toLowerCase()
        .includes(props.modelValue.toLowerCase()));

    if(s.length === 0) {
        show.value = false;
    }

    return s;
});

function open(active) {
    setTimeout(() => {
        if(active !== undefined) {
            show.value = active;
            return;
        }

        if(suggest.value.length > 0) {
            show.value = !show.value;
        }
    }, 200);
}

function select(item) {
    emit('update:modelValue', item.label);
}

function onInput(value) {
    show.value = value.length > 0;

    emit('update:modelValue', value);
}
</script>

<template>
    <div class="d-flex align-items-md-center flex-column flex-md-row">
        <div class="autocomplete">
            <input :value="modelValue"
                   @click="open()"
                   @blur="open(false)"
                   @input="onInput($event.target.value)"
                   class="form-control rounded"
                   ref="input"
                   type="text"
                   :name="name"
                   :placeholder="placeholder"
                   :id="name"
                   :autocomplete="false">
            <ul v-if="show" class="autocomplete options">
                <li v-for="(item, index) in suggest" @click="select(item)" :key="index">
                    {{ item.label }}
                </li>
            </ul>
        </div>
    </div>
</template>
