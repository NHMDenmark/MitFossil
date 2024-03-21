<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Wizard from "@/Components/Wizard.vue";
import { ref } from 'vue';
import InputAutocomplete from "@/Components/InputAutocomplete.vue";
import Accordion from "@/Components/Accordion.vue";
import { useI18n } from "vue-i18n";

const props = defineProps({
    form: { type: Object }
});
const { t } = useI18n();
const test = ref('');

const onOk = (selectedValue) => {
    // Haz algo con el valor seleccionado
    props.form.fossil_identifies[0].fossil_common = selectedValue.fossil_common?.description ?? null;
    props.form.fossil_identifies[0].fossil_kingdom = selectedValue.fossil_kingdom?.description ?? null;
    props.form.fossil_identifies[0].fossil_phylum = selectedValue.fossil_phylum?.description ?? null;
    props.form.fossil_identifies[0].fossil_class = selectedValue.fossil_class?.description ?? null;
    props.form.fossil_identifies[0].fossil_order = selectedValue.fossil_order?.description ?? null;
    props.form.fossil_identifies[0].fossil_family = selectedValue.fossil_family?.description ?? null;
    props.form.fossil_identifies[0].fossil_genre = selectedValue.fossil_genre?.description ?? null;
    props.form.fossil_identifies[0].specific_epithet = selectedValue.specific_epithet?.description ?? null;
};

function getIdentifyError(field) {
    if(props.form.error?.fossil_identifies) {
        return props.form.error.fossil_identifies[0][field];
    }

    return null;
}

function onContinue() {
    const data = props.form.fossil_identifies[0];

    data.fossil_kingdom = data.fossil_kingdom == null || data.fossil_kingdom === '' ? t('form.unknown') : data.fossil_kingdom;
    data.fossil_common = data.fossil_common == null || data.fossil_common === '' ? t('form.unknown') : data.fossil_common;
    data.fossil_phylum = data.fossil_phylum == null || data.fossil_phylum === '' ? t('form.unknown') : data.fossil_phylum;
    data.fossil_class = data.fossil_class == null || data.fossil_class === '' ? t('form.unknown') : data.fossil_class;
    data.fossil_order = data.fossil_order == null || data.fossil_order === '' ? t('form.unknown') : data.fossil_order;
    data.fossil_family = data.fossil_family == null || data.fossil_family === '' ? t('form.unknown') : data.fossil_family;
    data.fossil_genre = data.fossil_genre == null || data.fossil_genre === '' ? t('form.unknown') : data.fossil_genre;
    data.specific_epithet = data.specific_epithet == null || data.specific_epithet === '' ? t('form.unknown') : data.specific_epithet;

    props.form.fossil_identifies[0] = data;

    emit('continue')
}

const emit = defineEmits(['continue','close', 'previous','modal-ok']);

const accordeon = [
    { title: t('pages.new_fossil.accordions.classifications.title_1'), text: t('pages.new_fossil.accordions.classifications.desc_1')},
    { title: t('pages.new_fossil.accordions.classifications.title_2'), text: t('pages.new_fossil.accordions.classifications.desc_2')},
    { title: t('pages.new_fossil.accordions.classifications.title_3'), text: t('pages.new_fossil.accordions.classifications.desc_3')},
    { title: t('pages.new_fossil.accordions.classifications.title_4'), text: t('pages.new_fossil.accordions.classifications.desc_4')},
]
</script>

<template>
    <div class="mt-3">
        <div class="container container-770">
            <div class="row">
                <div class="col">
                    {{ $t('pages.new_fossil.classification_text') }}
                    <Accordion :items="accordeon" />
                </div>
            </div>
            <Wizard
                @ok="onOk"
                :options="$page.props.taxonomies"
                :question="$t('components.wizzard.question')"
                :title="$t('form.taxon') + '-' + $t('form.wizzard')" :subtitle="$t('form.taxon')">
            </Wizard>
        </div>
        <div class="row mt-5">
            <div class="col-12 col-lg-8">
                <div class="row row-form">
                    <div class="col col-label">
                        <InputLabel for="fossil_common_id" :value="$t('form.fossil_common')" />
                    </div>
                    <div class="col col-input">
                        <InputAutocomplete v-model="form.fossil_identifies[0].fossil_common"
                                           :options="$page.props.commons"
                                           :placeholder="$t('form.unknown')">
                        </InputAutocomplete>
                        <InputError class="mt-2" :message="getIdentifyError('fossil_common_id')" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="fossil_kingdom_id" :value="$t('form.fossil_kingdom')" />
                    </div>
                    <div class="col col-input">
                        <InputAutocomplete v-model="form.fossil_identifies[0].fossil_kingdom"
                                           :options="$page.props.kingdoms"
                                           :placeholder="$t('form.unknown')">
                        </InputAutocomplete>
                        <InputError class="mt-2" :message="getIdentifyError('fossil_kingdom_id')" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="fossil_phylum_id" :value="$t('form.fossil_phylum')" />
                    </div>
                    <div class="col col-input">
                        <InputAutocomplete v-model="form.fossil_identifies[0].fossil_phylum"
                                           :options="$page.props.phylums"
                                           :placeholder="$t('form.unknown')">
                        </InputAutocomplete>
                        <InputError class="mt-2" :message="getIdentifyError('fossil_phylum_id')" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="fossil_class_id" :value="$t('form.fossil_class')" />
                    </div>
                    <div class="col col-input">
                        <InputAutocomplete v-model="form.fossil_identifies[0].fossil_class"
                                           :options="$page.props.classes"
                                           :placeholder="$t('form.unknown')">
                        </InputAutocomplete>
                        <InputError class="mt-2" :message="getIdentifyError('fossil_class_id')" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="fossil_order_id" :value="$t('form.fossil_order')" />
                    </div>
                    <div class="col col-input">
                        <InputAutocomplete v-model="form.fossil_identifies[0].fossil_order"
                                           :options="$page.props.orders"
                                           :placeholder="$t('form.unknown')">
                        </InputAutocomplete>
                        <InputError class="mt-2" :message="getIdentifyError('fossil_order_id')" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="fossil_family_id" :value="$t('form.fossil_family')" />
                    </div>
                    <div class="col col-input">
                        <InputAutocomplete v-model="form.fossil_identifies[0].fossil_family"
                                           :options="$page.props.families"
                                           :placeholder="$t('form.unknown')">
                        </InputAutocomplete>
                        <InputError class="mt-2" :message="getIdentifyError('fossil_family_id')" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="fossil_genre_id" :value="$t('form.fossil_genre')" />
                    </div>
                    <div class="col col-input">
                        <InputAutocomplete v-model="form.fossil_identifies[0].fossil_genre"
                                           :options="$page.props.genres"
                                           :placeholder="$t('form.unknown')">
                        </InputAutocomplete>
                        <InputError class="mt-2" :message="getIdentifyError('fossil_genre_id')" />
                    </div>
                </div>
                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="specific_epithet_id" :value="$t('form.specific_epithet')" />
                    </div>
                    <div class="col col-input">
                        <InputAutocomplete v-model="form.fossil_identifies[0].specific_epithet"
                                           :options="$page.props.specific_epithets"
                                           :placeholder="$t('form.unknown')">
                        </InputAutocomplete>
                        <InputError class="mt-2" :message="getIdentifyError('specific_epithet_id')" />
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="col-12 d-flex justify-content-end flex-wrap gap-3">
                    <primary-button class="d-inline-flex" @click="$emit('previous')">{{ $t('form.previous') }}</primary-button>
                    <primary-button class="d-inline-flex" @click="onContinue">{{ $t('form.continue') }}</primary-button>
                </div>
            </div>
        </div>
    </div>
</template>
