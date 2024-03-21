<script setup>
import DisplayInput from "@/Components/DisplayInput.vue";
import DisplayTextarea from "@/Components/DisplayTextarea.vue";
import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";
import Map from "./Map.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";

const page = usePage();

const props = defineProps({
    form: { type: Object },
    actionText: { type: String, default: 'submit' },
    type: { type: String, default: 'new' }
})

defineEmits(['continue', 'previous', 'back']);

const country = computed( () => page.props.countries.find( x => x.value === props.form.country_id)?.label);
const county = computed( () => page.props.counties.find( x => x.value === props.form.county_id)?.label);

const eon = computed( () => page.props.eons.find( x => x.value === props.form.eon_id)?.label);
const era = computed( () => page.props.eras.find( x => x.value === props.form.era_id)?.label);
const period = computed( () => page.props.periods.find( x => x.value === props.form.period_id)?.label);
const epoch = computed( () => page.props.epoches.find( x => x.value === props.form.epoch_id)?.label);
const age = computed( () => page.props.ages.find( x => x.value === props.form.age_id)?.label);

function getIdentifyError(field) {
    if(props.form.error?.fossil_identifies) {
        return props.form.error.fossil_identifies[0][field];
    }

    return null;
}

</script>

<template>
    <div class="mt-3 layout-summary">
        <div class="row">
            <div class="col-12 col-lg-4 pe-lg-4">
                <div v-if="form.images && form.images.length > 0" class="row">
                    <strong class="label-space">{{ $t('pages.new_fossil.uploaded_photos') }}</strong>
                    <div class="d-grid d-grid-dashboard gap-4 mt-3">
                        <div v-for="image in form.images">
                            <img v-if="image.dato?.output" :src="image.dato.output.image" :key="image.id" alt="" class="object-fit-contain" />
                            <img v-if="image.path" :src="image.path" :key="image.id" alt="" class="object-fit-contain" />
                        </div>
                    </div>
                </div>
                <InputError class="mt-2" :message="form.errors.images" />
                <div v-if="!form.id" class="mt-45">
                    <strong class="label-space">{{ $t('pages.new_fossil.classifications') }}</strong>
                    <DisplayInput class="mt-3" :label="$t('form.fossil_common')" :value="props.form.fossil_identifies[0].fossil_common"></DisplayInput>
                    <InputError class="mt-2" :message="getIdentifyError('fossil_common_id')" />
                    <DisplayInput class="mt-3" :label="$t('form.fossil_kingdom')" :value="props.form.fossil_identifies[0].fossil_kingdom"></DisplayInput>
                    <InputError class="mt-2" :message="getIdentifyError('fossil_kingdom_id')" />
                    <DisplayInput class="mt-3" :label="$t('form.fossil_phylum')" :value="props.form.fossil_identifies[0].fossil_phylum"></DisplayInput>
                    <InputError class="mt-2" :message="getIdentifyError('fossil_phylum_id')" />
                    <DisplayInput class="mt-3" :label="$t('form.fossil_class')" :value="props.form.fossil_identifies[0].fossil_class"></DisplayInput>
                    <InputError class="mt-2" :message="getIdentifyError('fossil_class_id')" />
                    <DisplayInput class="mt-3" :label="$t('form.fossil_order')" :value="props.form.fossil_identifies[0].fossil_order"></DisplayInput>
                    <InputError class="mt-2" :message="getIdentifyError('fossil_order_id')" />
                    <DisplayInput class="mt-3" :label="$t('form.fossil_family')" :value="props.form.fossil_identifies[0].fossil_family"></DisplayInput>
                    <InputError class="mt-2" :message="getIdentifyError('fossil_family_id')" />
                    <DisplayInput class="mt-3" :label="$t('form.fossil_genre')" :value="props.form.fossil_identifies[0].fossil_genre"></DisplayInput>
                    <InputError class="mt-2" :message="getIdentifyError('fossil_genre_id')" />
                    <DisplayInput class="mt-3" :label="$t('form.specific_epithet')" :value="props.form.fossil_identifies[0].specific_epithet"></DisplayInput>
                    <InputError class="mt-2" :message="getIdentifyError('specific_epithet_id')" />
                </div>
            </div>

            <div class="col-12 col-lg-4 px-lg-4">
                <div class="mt-45 mt-lg-0">
                    <strong class="label-space"> {{ $t('pages.new_fossil.location') }} </strong>
                    <DisplayInput class="mt-3" :label="$t('form.country')" :value="country"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.country_id" />
                    <DisplayInput class="mt-3" :label="$t('form.county')" :value="county"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.county_id" />
                    <DisplayInput class="mt-3" :label="$t('form.municipality')" :value="form.municipality"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.municipality" />
                    <DisplayInput class="mt-3" :label="$t('form.city')" :value="form.city"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.city" />
                    <DisplayTextarea class="mt-3" :label="$t('form.locality')" :value="form.locality_name"></DisplayTextarea>
                    <InputError class="mt-2" :message="form.errors.locality_name" />
                    <DisplayInput class="mt-3" :label="$t('form.latitude')" :value="form.latitude"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.latitude" />
                    <DisplayInput class="mt-3" :label="$t('form.longitude')" :value="form.longitude"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.longitude" />
                </div>
                <div class="mt-45" v-if="form.latitude && form.longitude">
                    <Map class="mt-3" :lat="form.latitude" :lng="form.longitude" :can-click="false" ></Map>
                </div>
                <div class="mt-45">
                    <strong class="label-space"> {{ $t('pages.new_fossil.geological_context') }} </strong>
                    <DisplayInput class="mt-3" :label="$t('form.eon')" :value="eon"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.eon_id" />
                    <DisplayInput class="mt-3" :label="$t('form.era')" :value="era"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.era_id" />
                    <DisplayInput class="mt-3" :label="$t('form.period')" :value="period"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.period_id" />
                    <DisplayInput class="mt-3" :label="$t('form.epoch')" :value="epoch"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.epoch_id" />
                    <DisplayInput class="mt-3" :label="$t('form.age')" :value="age"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.age_id" />
                </div>
            </div>

            <div class="col-12 col-lg-4 ps-lg-4" style="position: relative">
                <div class="mt-45 mt-lg-0">
                    <strong class="label-space"> {{ $t('pages.new_fossil.lithostratigraphy') }} </strong>
                    <DisplayInput class="mt-3" :label="$t('form.group')" :value="form.group"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.group" />
                    <DisplayInput class="mt-3" :label="$t('form.formation')" :value="form.formation"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.formation" />
                    <DisplayInput class="mt-3" :label="$t('form.member')" :value="form.member"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.member" />
                </div>
                <div class="mt-45">
                    <strong class="label-space"> {{ $t('pages.new_fossil.dimensions') }} </strong>
                    <DisplayInput class="mt-3" :label="$t('form.length')" :value="form.length"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.length" />
                    <DisplayInput class="mt-3" :label="$t('form.width')" :value="form.width"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.width" />
                    <DisplayInput class="mt-3" :label="$t('form.height')" :value="form.height"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.height" />
                </div>
                <div class="mt-45">
                    <strong class="label-space"> {{ $t('pages.new_fossil.notes') }} </strong>
                    <DisplayInput class="mt-3" :label="$t('form.identifier')" :value="form.identifier"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.identifier" />
                    <DisplayInput class="mt-3" :label="$t('form.collector')" :value="form.collector"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.collector" />
                    <DisplayInput class="mt-3" :label="$t('form.date_find')" :value="form.date_find"></DisplayInput>
                    <InputError class="mt-2" :message="form.errors.date_find" />
                    <DisplayTextarea class="mt-3" :label="$t('form.notes')" :value="form.notes"></DisplayTextarea>
                    <InputError class="mt-2" :message="form.errors.notes" />
                    <DisplayTextarea class="mt-3" :label="$t('form.personal_id')" :value="form.personal_id"></DisplayTextarea>
                    <InputError class="mt-2" :message="form.errors.personal_id" />
                </div>
            </div>
            <div class="container container-770">
                <div class="row">
                    <div class="col mt-5">
                        <span v-if="type === 'new'">
                            {{ $t('pages.new_fossil.summary_text') }}
                        </span>
                        <span v-else>
                            {{ $t('pages.new_fossil.summary_text_edit') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="col-12 d-flex justify-content-end flex-wrap gap-3">
                    <primary-button v-if="form.id" class="d-inline-flex ms-3" @click="$emit('back')"> {{ $t('form.undo') }} </primary-button>
                    <primary-button class="d-inline-flex" @click="$emit('previous')">{{ $t('form.previous') }}</primary-button>
                    <primary-button class="d-inline-flex" @click="$emit('continue')">{{ $t('form.' + actionText) }}</primary-button>
                </div>
            </div>
        </div>
    </div>
</template>
