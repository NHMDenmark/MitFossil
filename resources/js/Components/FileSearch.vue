<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {computed, onMounted, ref} from "vue";
import { getFiles } from "@/Composables/useFile";
import ClipboardJS from "clipboard";

const scope = ref({
    files: [],
    showContent: false,
    filter: '',
    selected: null
});

onMounted( async () => {
    scope.value.files = await getFiles();
});

const filtered = computed(() => {
    if(scope.value.filter === '') {
        return scope.value.files;
    }

   return scope.value.files.filter( (x) => x.name.toLowerCase().includes( scope.value.filter.toLowerCase()));
});

function onOk() {
    if(scope.value.selected === null || scope.value.selected === '') {
        scope.value.showContent = false;
        return;
    }

    const clipboard = new ClipboardJS('.btn', {
        text: () => '/storage' + scope.value.selected,
    });

    clipboard.on('success', (e) => {
        e.clearSelection();
    });

    clipboard.on('error', (e) => {
        console.error('Error al copiar al portapapeles:', e.action);
    });

    // Simular un clic en el botón
    clipboard.onClick({ currentTarget: document.querySelector('#copy_file') });

    scope.value.showContent = false;
    scope.value.filter = '';
    scope.value.selected = null;
}
</script>

<template>
    <div class="wz wizzard d-flex mt-3">
        <div class="wz wizard-button d-flex d-justify-content-center">
            <primary-button class="wz" class-name="wz" @click="scope.showContent = true">{{ $t('layout.admin.files_text') }}</primary-button>
        </div>
        <div v-if="scope.showContent" class="wz wizzard-dropdown bg-white p-4 pb-0 border-light rounded shadow">
            <div class="wz row">
                <div class="wz col-12 wizzard-body">
                    <h5 class="wz heading-s fw-700 mb-3">{{ $t('layout.admin.files_text') }}</h5>
                    <i @click="scope.showContent = false" class="wz fas fa-close wizzard-close"></i>
                    <input type="text" class="wz form-control my-3" :placeholder="$t('components.modal.filter')" v-model="scope.filter">

                    <ul class="wz wizzard-menu navbar-nav mb-2">
                        <li v-for="file in filtered" class="nav-item wz">
                            <label class="wz checkbox-label d-flex justify-content-between align-items-center">
                                <div class="wz d-flex flex-column py-2 w-100">
                                    <span class="wz name">{{file.name}}</span>
                                </div>
                                <input class="wz form-check-input fs-5 mr-2" type="radio" :value="file.path" v-model="scope.selected">
                            </label>
                        </li>
                    </ul>

                    <primary-button class="wz wizzard-button text-center pb-4 pt-2" id="copy_file" @click="onOk">
                        {{ $t('form.copy_link') }}
                    </primary-button>
                </div>
            </div>
        </div>
    </div>
</template>
