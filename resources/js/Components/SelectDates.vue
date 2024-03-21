<script setup>
import moment from 'moment';
import {computed, onMounted, ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const show = ref(false);
const inputs = ref({ start: null, end: null });
const values = ref({});

const props = defineProps({
    nameStart: { type: String },
    nameEnd: { type: String },
    placeholder: { type: String },
    modelValue: { type: Object }
})

const emit = defineEmits(['update:modelValue']);

onMounted(() => {
    document.addEventListener('click', (event) => {
        if(show.value) {
            if(!event.target.classList.contains('sd_noclose')) {
                show.value = false;
            }
        }
    });
});

const title = computed(() => {
    if(!values.value.start || !values.value.end)
        return props.placeholder;

    const start = moment(values.value.start);
    const end = moment(values.value.end);

    return start.isValid() && end.isValid() ?
        `${start.format('DD/MM-YYYY')} - ${end.format('DD/MM-YYYY')}`
        : props.placeholder;
})
function onAccept() {
    const start = moment(inputs.value.start);
    const end = moment(inputs.value.end);

    if( start.isValid() && end.isValid() ){
        values.value = inputs.value;
    }

    show.value = false;

    emit('update:modelValue', values.value);
}

function onClear() {
    values.value = {};
    inputs.value = {};

    show.value = false;

    emit('update:modelValue', null);
}
</script>

<template>
    <div class="dropdown sd_noclose" :class="{ 'show': show }">
        <button type="button"
                class="sd_noclose form-select form-select-md text-start"
                :class="{'c-grey': title === placeholder}"
                @click="show = !show">
            {{ title }}
            <span class="multiselect-caret" :class="{ 'is-open': show }"></span>
        </button>
        <div class="dropdown-menu w-100 sd_noclose" :class="{ 'show': show }">
            <div class="px-4 py-3 sd_noclose">
                <div class="form-group sd_noclose">
                    <label>{{ $t('form.start') }}</label>
                    <input type="date" class="form-control sd_noclose" v-model="inputs.start" :max="inputs.end">
                    <input type="hidden" :name="nameStart" v-model="values.start">
                </div>
                <div class="form-group mt-2 sd_noclose">
                    <label>{{ $t('form.end') }}</label>
                    <input type="date" class="form-control sd_noclose" v-model="inputs.end" :min="inputs.start">
                    <input type="hidden" :name="nameEnd" v-model="values.end">
                </div>
                <div class="row">
                    <div class="col pe-1">
                        <button @click="onClear"
                            type="button"
                            class="btn btn-warning w-100 me-2 mt-2 sd_noclose btn-mit min-w-unset">
                            {{ $t('form.clear') }}
                        </button>
                    </div>
                    <div class="col ps-1">
                        <PrimaryButton @click="onAccept" class-name="sd_noclose w-100 ms-2 mt-2 min-w-unset">
                            {{ $t('form.accept') }}
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .form-select-md {
        background: var(--ms-bg,#fff);
        position: relative;
        width: 100%;
    }

    .multiselect-caret {
        position: absolute;
        top: 10px;
        right: 0;
    }
</style>
