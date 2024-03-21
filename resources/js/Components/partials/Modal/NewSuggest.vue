<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputAutocomplete from "@/Components/InputAutocomplete.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {useForm} from "@inertiajs/vue3";
import { saveIdentify } from "@/Composables/useFossil";
import {useI18n} from "vue-i18n";
import { ref } from 'vue';
import Wizard from "@/Components/Wizard.vue";

const emit = defineEmits(['close']);
const { t } = useI18n({});
const show_error = ref(false);

const props = defineProps({
    fossil: { type: Object },
    data: { type: Object }
})

const form = useForm({
    fossil_id: props.fossil.id,
    fossil_kingdom: null,
    fossil_common: null,
    fossil_phylum: null,
    fossil_class: null,
    fossil_order: null,
    fossil_family: null,
    fossil_genre: null,
    specific_epithet: null,
});
async function onSaveIdentify() {
    const data = form.data();
    show_error.value = false;

    data.fossil_kingdom = data.fossil_kingdom == null || data.fossil_kingdom === '' ? t('form.unknown') : data.fossil_kingdom;
    data.fossil_common = data.fossil_common == null || data.fossil_common === '' ? t('form.unknown') : data.fossil_common;
    data.fossil_phylum = data.fossil_phylum == null || data.fossil_phylum === '' ? t('form.unknown') : data.fossil_phylum;
    data.fossil_class = data.fossil_class == null || data.fossil_class === '' ? t('form.unknown') : data.fossil_class;
    data.fossil_order = data.fossil_order == null || data.fossil_order === '' ? t('form.unknown') : data.fossil_order;
    data.fossil_family = data.fossil_family == null || data.fossil_family === '' ? t('form.unknown') : data.fossil_family;
    data.fossil_genre = data.fossil_genre == null || data.fossil_genre === '' ? t('form.unknown') : data.fossil_genre;
    data.specific_epithet = data.specific_epithet == null || data.specific_epithet === '' ? t('form.unknown') : data.specific_epithet;

    if(data.fossil_kingdom === t('form.unknown') &&
        data.fossil_common === t('form.unknown') &&
        data.fossil_phylum === t('form.unknown') &&
        data.fossil_class === t('form.unknown') &&
        data.fossil_order === t('form.unknown') &&
        data.fossil_family === t('form.unknown') &&
        data.fossil_genre === t('form.unknown') &&
        data.specific_epithet === t('form.unknown')) {
        show_error.value = true;
    } else {
        const identify = await saveIdentify( data );
        props.fossil.fossil_identifies.push( identify );

        if(identify.principal) {
            props.fossil.principal_identify = identify;
        }

        emit('close');
    }
}

function onCancel() {
    show_error.value = false;
    emit('close');
}

function onOk(selectedValue) {
    form.fossil_common = selectedValue.fossil_common?.description ?? null;
    form.fossil_kingdom = selectedValue.fossil_kingdom?.description ?? null;
    form.fossil_phylum = selectedValue.fossil_phylum?.description ?? null;
    form.fossil_class = selectedValue.fossil_class?.description ?? null;
    form.fossil_order = selectedValue.fossil_order?.description ?? null;
    form.fossil_family = selectedValue.fossil_family?.description ?? null;
    form.fossil_genre = selectedValue.fossil_genre?.description ?? null;
    form.specific_epithet = selectedValue.specific_epithet?.description ?? null;
}
</script>

<template>
    <div class="row mt-5">
        <div class="col-12 col-lg-8 mb-3">
            <Wizard
                @ok="onOk"
                :options="$page.props.taxonomies_wizzard"
                :question="$t('components.wizzard.question')"
                :title="$t('form.taxon') + '-' + $t('form.wizzard')" :subtitle="$t('form.taxon')">
            </Wizard>
        </div>
        <div class="col-12 col-lg-8">
            <div class="row row-form">
                <div class="col col-label">
                    <InputLabel for="fossil_common_id" :value="$t('form.fossil_common')" />
                </div>
                <div class="col col-input">
                    <InputAutocomplete v-model="form.fossil_common"
                                       :options="data.commons"
                                       :placeholder="$t('form.select') + ' ' + $t('form.fossil_common')">
                    </InputAutocomplete>
                </div>
            </div>

            <div class="row row-form mt-2">
                <div class="col col-label">
                    <InputLabel for="fossil_kingdom_id" :value="$t('form.fossil_kingdom')" />
                </div>
                <div class="col col-input">
                    <InputAutocomplete v-model="form.fossil_kingdom"
                                       :options="data.kingdoms"
                                       :placeholder="$t('form.select') + ' ' + $t('form.fossil_kingdom')">
                    </InputAutocomplete>
                </div>
            </div>

            <div class="row row-form mt-2">
                <div class="col col-label">
                    <InputLabel for="fossil_phylum_id" :value="$t('form.fossil_phylum')" />
                </div>
                <div class="col col-input">
                    <InputAutocomplete v-model="form.fossil_phylum"
                                       :options="data.phylums"
                                       :placeholder="$t('form.select') + ' ' + $t('form.fossil_phylum')">
                    </InputAutocomplete>
                </div>
            </div>

            <div class="row row-form mt-2">
                <div class="col col-label">
                    <InputLabel for="fossil_class_id" :value="$t('form.fossil_class')" />
                </div>
                <div class="col col-input">
                    <InputAutocomplete v-model="form.fossil_class"
                                       :options="data.classes"
                                       :placeholder="$t('form.select') + ' ' + $t('form.fossil_class')">
                    </InputAutocomplete>
                </div>
            </div>

            <div class="row row-form mt-2">
                <div class="col col-label">
                    <InputLabel for="fossil_order_id" :value="$t('form.fossil_order')" />
                </div>
                <div class="col col-input">
                    <InputAutocomplete v-model="form.fossil_order"
                                       :options="data.orders"
                                       :placeholder="$t('form.select') + ' ' + $t('form.fossil_order')">
                    </InputAutocomplete>
                </div>
            </div>

            <div class="row row-form mt-2">
                <div class="col col-label">
                    <InputLabel for="fossil_family_id" :value="$t('form.fossil_family')" />
                </div>
                <div class="col col-input">
                    <InputAutocomplete v-model="form.fossil_family"
                                       :options="data.families"
                                       :placeholder="$t('form.select') + ' ' + $t('form.fossil_family')">
                    </InputAutocomplete>
                </div>
            </div>

            <div class="row row-form mt-2">
                <div class="col col-label">
                    <InputLabel for="fossil_genre_id" :value="$t('form.fossil_genre')" />
                </div>
                <div class="col col-input">
                    <InputAutocomplete v-model="form.fossil_genre"
                                       :options="data.genres"
                                       :placeholder="$t('form.select') + ' ' + $t('form.fossil_genre')">
                    </InputAutocomplete>
                </div>
            </div>
            <div class="row row-form mt-2">
                <div class="col col-label">
                    <InputLabel for="specific_epithet_id" :value="$t('form.specific_epithet')" />
                </div>
                <div class="col col-input">
                    <InputAutocomplete v-model="form.specific_epithet"
                                       :options="data.specific_epithets"
                                       :placeholder="$t('form.select') + ' ' + $t('form.specific_epithet')">
                    </InputAutocomplete>
                </div>
            </div>
            <div v-if="show_error" class="row row-form mt-2">
                <div class="col">
                    {{ $t('validate.need_value') }}
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8 mt-3">
            <div class="d-flex buttons justify-content-center text-end w-100 flex-wrap gap-3">
                <primary-button @click="onCancel" class="d-inline-flex">{{ $t('form.cancel') }}</primary-button>
                <primary-button @click="onSaveIdentify" class="d-inline-flex">{{ $t('components.identifies.suggest_identification') }}</primary-button>
            </div>
        </div>
    </div>
</template>
