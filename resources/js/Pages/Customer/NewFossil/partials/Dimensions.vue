<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputNumber from "@/Components/InputNumber.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Accordion from "@/Components/Accordion.vue";
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";

const { t } = useI18n();

defineProps({
    form: { type: Object }
})

const hasVote = computed(() => {
    const fossil = usePage().props.fossil;
    if(!fossil) {
        return false;
    }

    return fossil.vote_scientific === 1;
})

defineEmits(['continue', 'previous', 'back', 'save']);

const accordeon = [
    { title: t('pages.new_fossil.accordions.dimensions.title_1'), text: t('pages.new_fossil.accordions.dimensions.desc_1')},
]

</script>

<template>
    <div class="mt-3">
        <div v-if="!form.id" class="container container-770">
            <div class="row">
                <div class="col">
                    {{ $t('pages.new_fossil.dimensions_text') }}
                    <Accordion :items="accordeon" />
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 col-lg-8">
                <strong class="label-space">{{ $t('pages.new_fossil.dimensions') }}</strong>
                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="length" :value="$t('form.length')" />
                    </div>
                    <div class="col col-input">
                        <InputNumber
                            id="length"
                            :placeholder="$t('form.unknown')"
                            class="mt-1 block w-full input-num"
                            v-model="form.length"
                            :disabled="hasVote">
                        </InputNumber>
                        <InputError class="mt-2" :message="form.errors.length" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="width" :value="$t('form.width')" />
                    </div>
                    <div class="col col-input">
                        <InputNumber
                            id="width"
                            :placeholder="$t('form.unknown')"
                            class="mt-1 block w-full input-num"
                            v-model="form.width"
                            :disabled="hasVote">
                        </InputNumber>
                        <InputError class="mt-2" :message="form.errors.width" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="height" :value="$t('form.height')" />
                    </div>
                    <div class="col col-input">
                        <InputNumber
                            id="height"
                            :placeholder="$t('form.unknown')"
                            class="mt-1 block w-full input-num"
                            v-model="form.height"
                            :disabled="hasVote">
                        </InputNumber>
                        <InputError class="mt-2" :message="form.errors.height" />
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3">
                <div class="col-12 d-flex justify-content-end flex-wrap gap-3">
                    <primary-button v-if="form.id" @click="$emit('back')"> {{ $t('form.undo') }} </primary-button>
                    <primary-button class="d-inline-flex" @click="$emit('previous')">{{ $t('form.previous') }}</primary-button>
                    <primary-button class="d-inline-flex " @click="$emit('continue')">{{ $t('form.continue') }}</primary-button>
                    <primary-button v-if="form.id" class="d-inline-flex" @click="$emit('save')">{{ $t('form.save') }}</primary-button>
                </div>
            </div>
        </div>
    </div>
</template>
