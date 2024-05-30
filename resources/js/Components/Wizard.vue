<template>
    <div class="wz wizzard d-flex mt-3">
        <div class="wz wizard-button d-flex d-justify-content-center flex-wrap gap-3">
            <primary-button v-if="showClear" class="wz" class-name="wz me-3" @click="onClearClick">{{ $t('form.clear') }}</primary-button>
            <template v-if="customButton">
                <button class="wz" :class="customButton" @click="onClick">{{title}}</button>
            </template>
            <template v-else>
                <primary-button class="wz" class-name="wz" @click="onClick">{{title}}</primary-button>
            </template>
        </div>
        <div v-if="showContent" class="wz wizzard-dropdown bg-white p-4 pb-0 border-light rounded shadow">
            <div class="wz row">
                <div class="wz col-12 wizzard-body">
                    <h5 class="wz heading-s fw-700 mb-3">{{ subtitle }}</h5>
                    <i @click="showContent = false" class="wz fas fa-close wizzard-close"></i>
                    <input type="text" class="wz form-control my-3" id="inputFiltro" :placeholder="$t('components.modal.filter')" v-model="filtro">

                    <ul class="wz wizzard-menu navbar-nav mb-2">
                        <li v-for="option in listOptions" :class="{'nav-title': option.value == false, 'nav-item': option.value !== false}" v-show="mostrarElementoFiltrado(option)" class="wz">
                            <label class="wz checkbox-label d-flex justify-content-between align-items-center" :class="{'group-label': option.value === false}">
                                <div class="wz d-flex flex-column py-2 w-100">
                                    <span class="wz name">{{option.label}}</span>
                                    <template v-if="subOptions">

                                        <span class="wz sub" v-for="sub in subOptions">
                                            <span v-if="option[sub]">
                                                <b>{{ $t('form.fossil_' + sub) }}</b>: {{ option[sub] }}
                                            </span>
                                        </span>
                                    </template>
                                </div>
                                <input v-if="option.value !== false" class="wz form-check-input fs-5 mr-2" type="radio" :value="option" v-model="selectedOption">
                            </label>
                        </li>
                    </ul>

                    <primary-button class="wz wizzard-button text-center pb-4 pt-2" @click="onOk">
                        {{ actionText }}
                    </primary-button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {ref, watch, computed, onMounted, onUnmounted} from 'vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from '@/Components/Modal.vue';

const props = defineProps({
    options: { type: Array },
    title: { type: String },
    subtitle: { type: String },
    group: { type: Boolean, default: false },
    actionText: { type: String, default: 'Anvend' },
    question: { type: String },
    subOptions: { type: Array },
    customButton: { type: String },
    showClear: { type: Boolean, default: true }
});

const filtro = ref('');
const selectedValue = ref(null);
const selectedOption = ref(null);
const showContent = ref(false);

const listOptions = computed(() => {
    if(!props.group) {
        return props.options;
    }

    const result = [];

    for(let i = 0; i < props.options.length; i++) {
        const option = props.options[i];

        const item = {
            label: option.label,
            value: false,
            options: []
        };

        result.push(item);

        for(let j = 0; j < option.options.length; j++) {
            const subItem = option.options[j];
            result.push(subItem);
        }
    }

    return result;
});

watch(selectedOption, (newValue, oldValue) => {
    if (newValue !== oldValue) {
        selectedValue.value = JSON.parse(JSON.stringify(newValue));
    }
});

const onClick = () => {
    showContent.value = !showContent.value;
};

const onClearClick = () => {
    emits('ok', {});
    showContent.value = false;
}

function mostrarElementoFiltrado(option) {
    if (filtro.value === '' || option.value === false) {
        return true;
    } else {
        const filtroLower = filtro.value.toLowerCase();
        let finded = false;
        let fields = [ 'label' ];
        if(props.subOptions) {
            fields = [ ...fields, ...props.subOptions ];
        }

        for(let i = 0; i < fields.length; i++) {
            const field = fields[i];
            if(!option[field])
                continue;

            const optionLabelLower = option[field].toLowerCase();

            if(optionLabelLower.includes(filtroLower)) {
                finded = true;
                break;
            }
        }

        return finded;
    }
}
function onOk() {
    emits('ok', selectedValue.value);
    showContent.value = false;
};

const emits = defineEmits(['ok', 'close']);
</script>
