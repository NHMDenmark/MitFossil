<template>
    <form @submit.prevent="onSubmit" class="mt-4 form-group-inline">
        <SearchInput
            id="search"
            type="text"
            class-name="mt-1 block w-full"
            v-model="form.search"
            autofocus
            :placeholder="$t('form.search')"
            autocomplete="search"
            @clear="onSubmit" />
        <div class="d-flex flex-column flex-sm-row mt-3 align-items-sm-center" :class="{ 'justify-content-between':  origin === 'identify', 'justify-content-end':  origin !== 'identify'}">
            <div class="my-2" v-if="origin === 'identify'">
                <InputCheck @input="onSubmit" v-model="form.noValidated" id="noValidated" :value="true" class="d-inline-flex me-4 mb-2">{{ $t('form.not_validated') }}</InputCheck>
                <InputCheck @input="onSubmit" v-model="form.noClassified" id="noClassified" :value="true"  class="d-inline-flex mb-2">{{ $t('form.not_classified') }}</InputCheck>
            </div>
            <PrimaryButton :class-name="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                {{ $t('form.search') }}
            </PrimaryButton>
        </div>
    </form>
</template>

<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {usePage} from "@inertiajs/vue3";
import {onMounted, ref} from "vue";
import { useFilterStore } from "@/Core/stores/filterStore";
import SearchInput from "@/Components/SearchInput.vue";
import InputCheck from "@/Components/InputCheck.vue";
import emitter from 'tiny-emitter/instance';

defineProps({
    origin: { type: String, required: true }
})

const page = usePage();
const store = useFilterStore();

const form = ref({
    search: '',
    noValidated: false,
    noClassified: false
});

onMounted(() => {
  form.value.search = store.search ? store.search : '';

  setStore();
});

async function onSubmit() {
    if(form.value.search) {
        const url = form.value.search ? '?search=' + form.value.search : '?';
        window.history.pushState(null, null, url);
    }

    setStore();

    emitter.emit('filter-fossil', form.value);
}

function setStore() {
    store.search = form.value.search;
    store.noValidated = form.value.noValidated;
    store.noClassified = form.value.noClassified;
}

</script>
