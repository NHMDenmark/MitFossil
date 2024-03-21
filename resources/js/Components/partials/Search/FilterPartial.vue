<template>
    <form class="mt-3" @submit.prevent="onSubmit">
        <div class="row">
            <div class="col-12 form-group-inline">
                <SearchInput id="search" type="text" class-name="mt-1 block w-full" v-model="form.search" autofocus
                    :placeholder="$t('form.search')" autocomplete="search" @clear="onSubmit" />
            </div>
            <div class="col-12">
                <div class="d-flex flex-column flex-sm-row mt-3 align-items-sm-center"
                    :class="{ 'justify-content-between': origin === 'identify', 'justify-content-end': origin !== 'identify' }">
                    <div class="my-2" v-if="origin === 'identify'">
                        <InputCheck @input="onSubmit" v-model="form.noValidated" id="noValidated" :value="true"
                            class="d-inline-flex me-4 mb-2">{{ $t('form.not_validated') }}</InputCheck>
                        <InputCheck @input="onSubmit" v-model="form.noClassified" id="noClassified" :value="true"
                            class="d-inline-flex mb-2">{{ $t('form.not_classified') }}</InputCheck>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 mt-3" :class="{ 'col-xl-3': origin !== 'my-collection' }">
                <SelectInput id="newest" class="mt-1 block w-full" hide-default :searchable="false" :canClear="false"
                    :options="scope.orders" v-model="form.filter.newest" />
            </div>
            <div class="col-xs-12 col-sm-6 mt-3" :class="{ 'col-xl-3': origin !== 'my-collection' }">
                <SelectInput id="taxonomy" :placeholder="$t('form.select_taxonomy')" groups class="mt-1 block w-full"
                    :options="scope.taxonomies" v-model="form.filter.taxonomy" />
            </div>
            <div class="col-xs-12 col-sm-6 mt-3" :class="{ 'col-xl-3': origin !== 'my-collection' }">
                <SelectInput id="age" :placeholder="$t('form.select_age')" groups :options="scope.ages"
                    v-model="form.filter.age" />
            </div>
            <div class="col-xs-12 col-sm-6 mt-3" :class="{ 'col-xl-3': origin !== 'my-collection' }">
                <SelectDates v-model="form.filter.date" :placeholder="$t('form.dates')" name-start="startDate"
                    name-end="endDate" />
            </div>
        </div>
        <div class="d-flex justify-content-sm-end mt-3">
            <PrimaryButton :class-name="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                {{ $t('form.filter') }}
            </PrimaryButton>
        </div>
    </form>
</template>

<script setup>
import SelectInput from "@/Components/SelectInput.vue";
import { usePage } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref } from "vue";
import SelectDates from "@/Components/SelectDates.vue";
import { useFilterStore } from "@/Core/stores/filterStore";
import { useI18n } from "vue-i18n";

import emitter from 'tiny-emitter/instance';
import SearchInput from "@/Components/SearchInput.vue";
import InputCheck from "@/Components/InputCheck.vue";
const { t } = useI18n({})
const page = usePage();
const filterStore = useFilterStore();

defineProps({
    origin: { type: String, required: true }
});

const form = ref({
    search: '',
    noValidated: false,
    noClassified: false,
    filter: {
        newest: 'newest',
        taxonomy: null,
        age: null,
        date: null,
    }
});

const scope = ref({
    orders: [{ value: 'newest', label: t('form.newest') }, { value: 'oldest', label: t('form.oldest') }],
    taxonomies: page.props.taxonomies,
    ages: page.props.ages,
    dates: []
});

async function onSubmit() {
    filterStore.setFilter(form.value);

    emitter.emit('filter-fossil', form.value);
}

</script>
