<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextareaInput from "@/Components/TextareaInput.vue";
import {ref} from "vue";

const props = defineProps({
    label: { type: String },
    value: { types: [String, Number, null] },
    type: { type: String }
});

</script>

<template>
    <div class="row row-form">
        <div class="col col-label">
            <input-label> {{ label }} </input-label>
        </div>
        <div class="col col-input">
            <textarea-input :value="value ?? $t('form.unknown')" disabled :type="type"/>
        </div>
    </div>
</template>
