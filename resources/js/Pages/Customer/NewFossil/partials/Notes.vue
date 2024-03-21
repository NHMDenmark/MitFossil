<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import TextareaInput from "@/Components/TextareaInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Accordion from "@/Components/Accordion.vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();

defineProps({
    form: { type: Object }
})

defineEmits(['continue', 'previous', 'back', 'save']);

const accordeon = [
    { title: t('pages.new_fossil.accordions.notes.title_1'), text: t('pages.new_fossil.accordions.notes.desc_1')},
    { title: t('pages.new_fossil.accordions.notes.title_2'), text: t('pages.new_fossil.accordions.notes.desc_2')},
    { title: t('pages.new_fossil.accordions.notes.title_3'), text: t('pages.new_fossil.accordions.notes.desc_3')},
    { title: t('pages.new_fossil.accordions.notes.title_4'), text: t('pages.new_fossil.accordions.notes.desc_4')},
    { title: t('pages.new_fossil.accordions.notes.title_5'), text: t('pages.new_fossil.accordions.notes.desc_5')},
]
</script>

<template>
    <div class="mt-3">
        <div v-if="!form.id" class="container container-770">
            <div class="row">
                <div class="col">
                    {{ $t('pages.new_fossil.notes_text') }}
                    <Accordion :items="accordeon"/>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-8">
                <strong class="label-space"> {{ $t('pages.new_fossil.notes') }} </strong>
                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="identifier" :value="$t('form.identifier')" />
                    </div>
                    <div class="col col-input">
                        <TextInput
                            id="identifier"
                            :placeholder="$t('form.unknown')"
                            class="mt-1 block w-full"
                            v-model="form.identifier">
                        </TextInput>
                        <InputError class="mt-2" :message="form.errors.identifier" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="collector" :value="$t('form.collector')" />
                    </div>
                    <div class="col col-input">
                        <TextInput
                            id="collector"
                            :placeholder="$t('form.unknown')"
                            class="mt-1 block w-full"
                            v-model="form.collector">
                        </TextInput>
                        <InputError class="mt-2" :message="form.errors.collector" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="date_find" :value="$t('form.date_find')" />
                    </div>
                    <div class="col col-input">
                        <TextInput
                            id="date_find"
                            :placeholder="$t('form.unknown')"
                            class="mt-1 block w-full"
                            type="text"
                            v-model="form.date_find">
                        </TextInput>
                        <InputError class="mt-2" :message="form.errors.date_find" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="notes" :value="$t('form.notes')" />
                    </div>
                    <div class="col col-input">
                        <TextareaInput
                            id="notes"
                            :placeholder="$t('form.unknown')"
                            class="mt-1 block w-full"
                            v-model="form.notes">
                        </TextareaInput>
                        <InputError class="mt-2" :message="form.errors.notes" />
                    </div>
                </div>

                <div class="row row-form mt-2">
                    <div class="col col-label">
                        <InputLabel for="personal_id" :value="$t('form.personal_id')" />
                    </div>
                    <div class="col col-input">
                        <TextInput
                            id="personal_id"
                            :placeholder="$t('form.unknown')"
                            class="mt-1 block w-full"
                            v-model="form.personal_id">
                        </TextInput>
                        <InputError class="mt-2" :message="form.errors.personal_id" />
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
    </div>
</template>
