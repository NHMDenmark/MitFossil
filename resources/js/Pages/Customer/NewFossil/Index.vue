<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
import {ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Images from './partials/Images.vue';
import Classification from "./partials/Classification.vue";
import Location from "./partials/Location.vue";
import GeologicalContext from "./partials/GeologicalContext.vue";
import Dimensions from "./partials/Dimensions.vue";
import Notes from "@/Pages/Customer/NewFossil/partials/Notes.vue";
import Summary from "@/Pages/Customer/NewFossil/partials/Summary.vue";
import ModalGuide from '@/Components/partials/Modal/ModalGuide.vue';
import { v4 as uuidv4 } from 'uuid';
import InputError from "@/Components/InputError.vue";

const state = ref(0);
const modalGuide = ref();
const form_sent = ref(false)
const form = useForm({
    images: [{
        id: uuidv4(),
        dato: {}
    }],
    fossil_identifies: [{
        fossil_kingdom: null,
        fossil_common: null,
        fossil_phylum: null,
        fossil_class: null,
        fossil_order: null,
        fossil_family: null,
        fossil_genre: null,
        fossil_subgenre: null,
        specific_epithet: null,
        fossil_subspecies: null,
        fossil_taxonomy: null,
    }],
    author: null,
    country_id: 1,
    county_id: null,
    city: null,
    municipality: null,
    locality_name: null,
    latitude: null,
    longitude: null,
    hide_location: false,
    eon_id: null,
    era_id: null,
    period_id: null,
    epoch_id: null,
    age_id: null,
    group: null,
    formation: null,
    member: null,
    geochronology_id: null,
    length: null,
    width: null,
    height: null,
    identifier: null,
    collector: null,
    date_find: null,
    notes: null,
    personal_id: null,
    fossil_common: null,
    form_sent: false
});

function save() {
    if(!form_sent.value) {
        form_sent.value = true
        form.post(route('customer.new-fossil.store'), {
            onFinish: () => {form_sent.value = false},
            onError: () => {form_sent.value = false},
        });
    }

}
</script>

<template>
    <Head :title="$t('pages.new_fossil.title')" />

    <CustomerLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="d-flex flex-column flex-xl-row gap-45 align-items-start">
                <div class="col bg-white border-light shadow rounded p-4 pt-5">
                    <div class="row d-flex flex-nowrap justify-content-between justify-content-sm-center gap-3">
                        <div class="col col-auto max-w-100-100 text-center">
                            <div class="d-flex flex-wrap justify-content-sm-center gap-3">
                                <primary-button className="btn-h-lg" @click="state = 0" :variant="state === 0 ? 'light' : 'normal'" >{{ $t('pages.new_fossil.images') }}</primary-button>
                                <primary-button className="btn-h-lg" @click="state = 1" :variant="state === 1 ? 'light' : 'normal'" >{{ $t('pages.new_fossil.classifications') }}</primary-button>
                                <primary-button className="btn-h-lg" @click="state = 2" :variant="state === 2 ? 'light' : 'normal'" >{{ $t('pages.new_fossil.location') }}</primary-button>
                                <primary-button className="btn-h-lg" @click="state = 3" :variant="state === 3 ? 'light' : 'normal'" >{{ $t('pages.new_fossil.geological_context_button') }}</primary-button>
                                <primary-button className="btn-h-lg" @click="state = 4" :variant="state === 4 ? 'light' : 'normal'" >{{ $t('pages.new_fossil.dimensions') }}</primary-button>
                                <primary-button className="btn-h-lg" @click="state = 5" :variant="state === 5 ? 'light' : 'normal'" >{{ $t('pages.new_fossil.notes') }}</primary-button>
                                <primary-button className="btn-h-lg" @click="state = 6" :variant="state === 6 ? 'light' : 'normal'" >{{ $t('pages.new_fossil.summary') }}</primary-button>
                            </div>
                        </div>
                        <div class="col col-auto max-w-100 text-center">
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a @click.prevent="modalGuide.show()" href="#" class="icon-guide">
                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="20" cy="20" r="20" fill="#264A42" />
                                        <path
                                            d="M18.6 24C18.6 22.65 18.721 21.679 18.963 21.087C19.205 20.495 19.7174 19.8493 20.5 19.15C21.1834 18.55 21.7044 18.029 22.063 17.587C22.4217 17.145 22.6007 16.641 22.6 16.075C22.6 15.3917 22.371 14.825 21.913 14.375C21.455 13.925 20.8174 13.7 20 13.7C19.15 13.7 18.504 13.9583 18.062 14.475C17.62 14.9917 17.308 15.5167 17.126 16.05L14.55 14.95C14.9 13.8833 15.5417 12.9583 16.475 12.175C17.4084 11.3917 18.5834 11 20 11C21.75 11 23.096 11.4877 24.038 12.463C24.98 13.4383 25.4507 14.609 25.45 15.975C25.45 16.8083 25.271 17.521 24.913 18.113C24.555 18.705 23.9924 19.3757 23.225 20.125C22.4084 20.9083 21.9127 21.5043 21.738 21.913C21.5634 22.3217 21.4757 23.0173 21.475 24H18.6ZM20 30C19.45 30 18.9794 29.804 18.588 29.412C18.1967 29.02 18.0007 28.5493 18 28C18 27.45 18.196 26.979 18.588 26.587C18.98 26.195 19.4507 25.9993 20 26C20.55 26 21.021 26.196 21.413 26.588C21.805 26.98 22.0007 27.4507 22 28C22 28.55 21.804 29.021 21.412 29.413C21.02 29.805 20.5494 30.0007 20 30Z"
                                            fill="white" />
                                    </svg>{{ $t('pages.new_fossil.guide') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="py-4 p-sm-4">
                        <InputError class="mt-2" :message="form.errors.coordinates" />
                        <Images v-if="state === 0" :form="form" @continue="state = 1"></Images>
                        <Classification v-if="state === 1" :form="form" @continue="state = 2" @previous="state = 0"></Classification>
                        <Location v-if="state === 2" :form="form" @continue="state = 3" @previous="state = 1"></Location>
                        <GeologicalContext v-if="state === 3" :form="form" @continue="state = 4" @previous="state = 2"></GeologicalContext>
                        <Dimensions v-if="state === 4" :form="form" @continue="state = 5" @previous="state = 3"></Dimensions>
                        <Notes v-if="state === 5" :form="form" @continue="state = 6" @previous="state = 4"></Notes>
                        <Summary v-if="state === 6" :form="form" @continue="save" @previous="state = 5"></Summary>
                    </div>
                </div>
            </div>
        </div>

        <ModalGuide ref="modalGuide"></ModalGuide>
    </CustomerLayout>
</template>
