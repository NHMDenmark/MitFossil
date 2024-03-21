<script setup>
import {computed} from 'vue';
import InputImage from "@/Components/InputImage.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import Accordion from "@/Components/Accordion.vue";
import {usePage} from "@inertiajs/vue3";
import { v4 as uuidv4 } from 'uuid';
import InputLabel from "@/Components/InputLabel.vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();

const props = defineProps({
    form: { type: Object }
})
const maxImages = 5; // Máximo número de imágenes permitidas

const accordeon = [
    { title: t('pages.new_fossil.accordions.images.title_1'), text: t('pages.new_fossil.accordions.images.desc_1')},
    { title: t('pages.new_fossil.accordions.images.title_2'), text: t('pages.new_fossil.accordions.images.desc_2')},
    { title: t('pages.new_fossil.accordions.images.title_3'), text: t('pages.new_fossil.accordions.images.desc_3')},
    { title: t('pages.new_fossil.accordions.images.title_4'), text: t('pages.new_fossil.accordions.images.desc_4')},
]

function addImage() {
    if (props.form.images.length < maxImages) {
        props.form.images.push({ id: uuidv4(), dato: {} }); // Añade un nuevo objeto al array de imágenes
    }
}

function onDelete(index) {
    if(props.form.id) {
        const image = props.form.images[index];
        props.form.images_delete.push( image );
    }

    if(props.form.images.length > 1) {
        props.form.images.splice( index, 1 );
    } else {
        props.form.images[0] = {
            id: uuidv4(),
            dato: {}
        }
    }
}

const hasVote = computed(() => {
    const fossil = usePage().props.fossil;
    if(!fossil) {
        return false;
    }
    return fossil.vote_scientific === 1;
})

defineEmits(['continue', 'back', 'save']);
</script>

<template>
    <div class="mt-3 container container-770">
        <div v-if="!form.id" class="row">
            <div class="col">
                {{ $t('pages.new_fossil.image_text') }}
                <Accordion :items="accordeon" />
            </div>
        </div>

        <div v-if="!hasVote" class="row mt-3">
            <div class="col">
                <InputImage
                    v-for="(item, index) in form.images" :key="item.id"
                    @delete="onDelete"
                    :id="`picture-${ item.id }`"
                    :options="{  }"
                    :index="index"
                    :height="form.images.length === 0 ? '200px' : undefined"
                    class="mt-2 border-2 border-light"
                    v-model="form.images[index].dato"
                    :old-value="form.images[index] ? form.images[index].path : undefined"
                />

            </div>
        </div>

        <div v-else class="row mt-3">
            <div  v-for="(item, index)  in form.images" :key="item.uuid" class="col">
                <img :src="item.path" :alt="'fossil-picture-' + item.id" class="img-fluid">
            </div>
        </div>

        <InputError class="mt-2" :message="form.errors.images" />

        <div v-if="form.images_delete?.length > 0" class="row mt-3">
            <div class="col-12">
                <InputLabel for="motive_delete" :value="$t('form.motive_delete')" />
                <textarea v-model="form.motive_delete" id="motive_delete" class="form-control mt-2" rows="5"></textarea>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 d-flex justify-content-center flex-wrap gap-3">
                <primary-button v-if="form.id" @click="$emit('back')"> {{ $t('form.undo') }} </primary-button>
                <primary-button v-if="!hasVote" class="" @click="addImage">+ {{ $t('form.add_image') }} </primary-button>
                <primary-button class="" @click="$emit('continue')">
                    {{ $t('form.continue') }}
                </primary-button>
                <primary-button v-if="form.id" class="d-inline-flex" @click="$emit('save')">{{ $t('form.save') }}</primary-button>
            </div>
        </div>
    </div>
</template>
