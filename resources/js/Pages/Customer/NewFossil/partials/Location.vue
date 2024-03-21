<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import SelectInput from "@/Components/SelectInput.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import Map from './Map.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Checkbox from "@/Components/Checkbox.vue";
import Accordion from "@/Components/Accordion.vue";
import {computed, ref} from "vue";
import {usePage} from "@inertiajs/vue3";
import InputCheck from "@/Components/InputCheck.vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();

const props = defineProps({
    form: { type: Object }
});

defineEmits(['continue', 'previous', 'back', 'save']);

const accordeon = [
    { title: t('pages.new_fossil.accordions.location.title_1'), text: t('pages.new_fossil.accordions.location.desc_1')},
    { title: t('pages.new_fossil.accordions.location.title_2'), text: t('pages.new_fossil.accordions.location.desc_2')},
    { title: t('pages.new_fossil.accordions.location.title_3'), text: t('pages.new_fossil.accordions.location.desc_3')},
    { title: t('pages.new_fossil.accordions.location.title_4'), text: t('pages.new_fossil.accordions.location.desc_4')},
]

function onSetMark(latLng) {
    console.log(latLng, hasVote.value);
    if(!hasVote.value) {
        props.form.latitude = latLng.lat();
        props.form.longitude = latLng.lng();
    }
}

const hasVote = computed(() => {
    const fossil = usePage().props.fossil;
    if(!fossil) {
        return false;
    }
    return fossil.vote_scientific === 1;
})
</script>

<template>
    <div class="mt-3">
        <div v-if="!form.id" class="container container-770">
            <div class="row">
                <div class="col">
                    {{ $t('pages.new_fossil.location_text') }}
                    <Accordion :items="accordeon" />
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 col-lg-6">
                <div class="row row-form">
                    <div class="col col-label">
                        <InputLabel for="country_id" :value="$t('form.country')" />
                    </div>
                    <div class="col col-input">
                        <SelectInput
                            id="country_id"
                            class="mt-1 block w-full"
                            :placeholder="$t('form.unknown')"
                            v-model="form.country_id"
                            :options="$page.props.countries"
                            disabled
                        />
                        <InputError class="mt-2" :message="form.errors.country_id" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="county_id" :value="$t('form.county')" />
                    </div>
                    <div class="col col-input">
                        <SelectInput
                            id="county_id"
                            class="mt-1 block w-full"
                            :placeholder="$t('form.unknown')"
                            v-model="form.county_id"
                            :options="$page.props.counties"
                            :disabled="hasVote"
                        />
                        <InputError class="mt-2" :message="form.errors.county_id" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="municipality" :value="$t('form.municipality')" />
                    </div>
                    <div class="col col-input">
                        <TextInput
                            id="municipality"
                            :placeholder="$t('form.unknown')"
                            class="mt-1 block w-full"
                            v-model="form.municipality"
                            :disabled="hasVote">
                        </TextInput>

                        <InputError class="mt-2" :message="form.errors.municipality" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="city" :value="$t('form.city')" />
                    </div>
                    <div class="col col-input">
                        <TextInput
                            id="city"
                            :placeholder="$t('form.unknown')"
                            class="mt-1 block w-full"
                            v-model="form.city"
                            :disabled="hasVote">
                        </TextInput>

                        <InputError class="mt-2" :message="form.errors.city" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="locality_name" :value="$t('form.locality')" />
                    </div>
                    <div class="col col-input">
                        <TextInput
                            id="locality_name"
                            :placeholder="$t('form.unknown')"
                            class="mt-1 block w-full"
                            v-model="form.locality_name"
                            :disabled="hasVote">
                        </TextInput>

                        <InputError class="mt-2" :message="form.errors.locality_name" />
                    </div>
                </div>
                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="latitude" :value="$t('form.latitude')" />
                    </div>
                    <div class="col col-input">
                        <TextInput
                            id="latitude"
                            :placeholder="$t('form.unknown')"
                            class="mt-1 block w-full"
                            v-model="form.latitude"
                            :disabled="hasVote">
                        </TextInput>

                        <InputError class="mt-2" :message="form.errors.latitude" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="longitude" :value="$t('form.longitude')" />
                    </div>
                    <div class="col col-input">
                        <TextInput
                            id="longitude"
                            :placeholder="$t('form.unknown')"
                            class="mt-1 block w-full"
                            v-model="form.longitude"
                            :disabled="hasVote">
                        </TextInput>

                        <InputError class="mt-2" :message="form.errors.longitude" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-input mx-2">
                        <InputCheck @input="form.hide_location = $event" :value="form.hide_location ? undefined : null" id="hide-location" :disabled="hasVote">
                            Skjul Fundsted
                        </InputCheck>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 mt-45 mt-lg-0" style="position: relative">
                <Map
                    :label="$t('pages.new_fossil.map_text')"
                    @set-marker="onSetMark"
                    :lat="form.latitude"
                    :lng="form.longitude"
                    :can-click="true">
                </Map>
            </div>
            <div class="col-12 mt-3">
                <div class="col-12 d-flex justify-content-end flex-wrap gap-3">
                    <primary-button v-if="form.id" @click="$emit('back')"> {{ $t('form.undo') }} </primary-button>
                    <primary-button class="d-inline-flex" @click="$emit('previous')">{{ $t('form.previous') }}</primary-button>
                    <primary-button class="d-inline-flex" @click="$emit('continue')">{{ $t('form.continue') }}</primary-button>
                    <primary-button v-if="form.id" class="d-inline-flex" @click="$emit('save')">{{ $t('form.save') }}</primary-button>
                </div>
            </div>
        </div>
    </div>
</template>
