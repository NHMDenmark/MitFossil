<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import SelectInput from "@/Components/SelectInput.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {computed, onMounted, ref, watch} from "vue";
import {usePage} from "@inertiajs/vue3";
import Wizard from "@/Components/Wizard.vue";
import Accordion from "@/Components/Accordion.vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();

const page = usePage();

const props = defineProps({
    form: { type: Object }
})

const selectedValue = ref(null)

const accordeon = [
    { title: t('pages.new_fossil.accordions.geological_context.title_1'), text: t('pages.new_fossil.accordions.geological_context.desc_1')},
    { title: t('pages.new_fossil.accordions.geological_context.title_2'), text: t('pages.new_fossil.accordions.geological_context.desc_2')},
    { title: t('pages.new_fossil.accordions.geological_context.title_3'), text: t('pages.new_fossil.accordions.geological_context.desc_3')},
    { title: t('pages.new_fossil.accordions.geological_context.title_4'), text: t('pages.new_fossil.accordions.geological_context.desc_4')},
    { title: t('pages.new_fossil.accordions.geological_context.title_5'), text: t('pages.new_fossil.accordions.geological_context.desc_5')},
    { title: t('pages.new_fossil.accordions.geological_context.title_6'), text: t('pages.new_fossil.accordions.geological_context.desc_6')},
]

const onOk = (selected) => {
    let [ model, value ] = selected?.value?.split('_') ?? [ null, null ];
    value = parseInt(value);

    props.form.eon_id = null;
    props.form.era_id = null;
    props.form.period_id = null;
    props.form.epoch_id = null;
    props.form.age_id = null;

    selectedValue.value = {};

    if(model === 'age') {
        selectedValue.value.age_id = value;
        model = 'epoch';
        value = page.props.ages.find(x => x.value === value)?.epoch_id;
    }

    if(model === 'epoch') {
        selectedValue.value.epoch_id = value;
        model = 'period';
        value = page.props.epoches.find(x => x.value === value)?.period_id;
        changeEpoch(selectedValue.value.epoch_id, false)
    }

    if(model === 'period') {
        selectedValue.value.period_id = value;
        model = 'era';
        value = page.props.periods.find(x => x.value === value)?.era_id;
        changePeriod(selectedValue.value.period_id, false)
    }

    if(model === 'era') {
        selectedValue.value.era_id = value;
        model = 'eon';
        value = page.props.eras.find(x => x.value === value)?.eon_id;
        changeEra(selectedValue.value.era_id, false)
    }

    if(model === 'eon') {
        selectedValue.value.eon_id = value;
        changeEon(selectedValue.value.eon_id, false)
    }

    props.form.eon_id = selectedValue.value?.eon_id ?? null;
    props.form.era_id = selectedValue.value?.era_id ?? null;
    props.form.period_id = selectedValue.value?.period_id ?? null;
    props.form.epoch_id = selectedValue.value?.epoch_id ?? null;
    props.form.age_id = selectedValue.value?.age_id ?? null;
};

const eons = ref(page.props.eons);
const eras = ref([]);
const periods = ref([]);
const epoches = ref([]);
const ages = ref([]);

defineEmits(['continue', 'previous','modal-ok', 'back', 'save']);

onMounted(() => {
    if(props.form.eon_id) {
        changeEon(props.form.eon_id, false)
    }

    if(props.form.era_id) {
        changeEra(props.form.era_id, false)
    }

    if(props.form.period_id) {
        changePeriod(props.form.period_id, false)
    }

    if(props.form.epoch_id) {
        changeEpoch(props.form.epoch_id, false)
    }
});

function onSelectEon(eon) {
    selectedValue.value = null
    changeEon(eon)
}

function onSelectEra(era) {
    selectedValue.value = null
    changeEra(era)
}

function onSelectPeriod(period) {
    selectedValue.value = null
    changePeriod(period)
}

function onSelectEpoch(epoch) {
    selectedValue.value = null
    changeEpoch(epoch)
}

function onSelectAge(age) {
    selectedValue.value = null
}

function changeEon(v, setValue = true) {
    eras.value = page.props.eras.filter(x => x.eon_id === v);

    if(setValue) {
        periods.value = [];
        epoches.value = [];
        ages.value = [];

        props.form.era_id = null;
        props.form.period_id = null;
        props.form.epoch_id = null;
        props.form.age_id = null;
    }
}

function changeEra(v, setValue = true) {
    periods.value = page.props.periods.filter(x => x.era_id === v);

    if(setValue) {
        epoches.value = [];
        ages.value = [];

        props.form.period_id = null;
        props.form.epoch_id = null;
        props.form.age_id = null;
    }
}

function changePeriod(v, setValue = true) {
    epoches.value = page.props.epoches.filter(x => x.period_id === v);

    if(setValue) {
        ages.value = [];

        props.form.epoch_id = null;
        props.form.age_id = null;
    }
}

function changeEpoch(v, setValue = true) {
    ages.value = page.props.ages.filter(x => x.epoch_id === v);

    if(setValue) {
        props.form.age_id = null;
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
    <div class="mt-3 geological-context">
        <div class="container container-770">
            <div v-if="!form.id" class="row">
                <div class="col">
                    {{ $t('pages.new_fossil.geological_context_text') }}
                    <Accordion :items="accordeon" />
                </div>
            </div>
            <Wizard
                @ok="onOk"
                :options="$page.props.geochronologies"
                group
                :title="$t('form.geo') + '-' + $t('form.wizzard')"
                :question="$t('components.wizzard.question')"
                :subtitle="$t('form.geo')">
            </Wizard>
        </div>
        <div class="row mt-5">
            <div class="col-12 col-lg-8">
                <strong class="d-block label-space">{{ $t('pages.new_fossil.geological_context') }}</strong>
                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="eon_id" :value="$t('form.eon')" />
                    </div>
                    <div class="col col-input">
                        <SelectInput
                            @select="onSelectEon"
                            id="eon_id"
                            class="mt-1 block w-full"
                            :placeholder="$t('form.unknown')"
                            v-model="form.eon_id"
                            :options="eons"
                            :disabled="hasVote"
                        />
                        <InputError class="mt-2" :message="form.errors.eon_id" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="era_id" :value="$t('form.era')" />
                    </div>
                    <div class="col col-input">
                        <SelectInput
                            @select="onSelectEra"
                            id="era_id"
                            class="mt-1 block w-full"
                            :placeholder="$t('form.unknown')"
                            v-model="form.era_id"
                            :options="eras"
                            :disabled="hasVote"
                        />
                        <InputError class="mt-2" :message="form.errors.era_id" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="period_id" :value="$t('form.period')" />
                    </div>
                    <div class="col col-input">
                        <SelectInput
                            @select="onSelectPeriod"
                            id="period_id"
                            class="mt-1 block w-full"
                            :placeholder="$t('form.unknown')"
                            v-model="form.period_id"
                            :options="periods"
                            :disabled="hasVote"
                        />
                        <InputError class="mt-2" :message="form.errors.period_id" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="period_id" :value="$t('form.epoch')" />
                    </div>
                    <div class="col col-input">
                        <SelectInput
                            @select="onSelectEpoch"
                            id="epoch_id"
                            class="mt-1 block w-full"
                            :placeholder="$t('form.unknown')"
                            v-model="form.epoch_id"
                            :options="epoches"
                            :disabled="hasVote"
                        />
                        <InputError class="mt-2" :message="form.errors.epoch_id" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="age_id" :value="$t('form.age')" />
                    </div>
                    <div class="col col-input">
                        <SelectInput
                            @select="onSelectAge"
                            id="age_id"
                            class="mt-1 block w-full"
                            :placeholder="$t('form.unknown')"
                            v-model="form.age_id"
                            :options="ages"
                            :disabled="hasVote"
                        />
                        <InputError class="mt-2" :message="form.errors.age_id" />
                    </div>
                </div>
            </div>
        </div>

        <div v-if="!form.id" class="container container-770">
            <div class="row mt-5">
                <div class="col">
                    <!--{{ $t('pages.new_fossil.lithostratigraphy_text') }}-->
                    <Accordion />
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 col-lg-8">
                <strong class="d-block label-space"> {{ $t('pages.new_fossil.lithostratigraphy') }} </strong>
                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="group" :value="$t('form.group')" />
                    </div>
                    <div class="col col-input">
                        <TextInput
                            id="group"
                            :placeholder="$t('form.unknown')"
                            class="mt-1 block w-full"
                            v-model="form.group"
                            :disabled="hasVote">                            
                        </TextInput>

                        <InputError class="mt-2" :message="form.errors.group" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="formation" :value="$t('form.formation')" />
                    </div>
                    <div class="col col-input">
                        <TextInput
                            id="formation"
                            :placeholder="$t('form.unknown')"
                            class="mt-1 block w-full"
                            v-model="form.formation"
                            :disabled="hasVote">
                        </TextInput>

                        <InputError class="mt-2" :message="form.errors.formation" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="member" :value="$t('form.member')" />
                    </div>
                    <div class="col col-input">
                        <TextInput
                            id="member"
                            :placeholder="$t('form.unknown')"
                            class="mt-1 block w-full"
                            v-model="form.member"
                            :disabled="hasVote">
                        </TextInput>

                        <InputError class="mt-2" :message="form.errors.member" />
                    </div>
                </div>
            </div>
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
</template>
