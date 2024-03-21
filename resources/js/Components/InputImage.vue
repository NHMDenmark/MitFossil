<template>
    <div ref="slim" :style=" { height: height } ">
        <img v-if="image" :src="image" alt="">
        <input
            :id="id"
            :name="name"
            class="form-control"
            type="file"
        />
    </div>
</template>

<script setup>
import {computed, onMounted, ref, watch} from "vue";
import SlimLib from '@/Core/slim/slim.commonjs';
import { useI18n } from "vue-i18n";

const { t } = useI18n();

const slim = ref();

const props = defineProps({
    id: { type: String },
    name: { type: String },
    options: { type: Object },
    height: { type: String },
    oldValue: { types: [String, null] },
    index: { type: Number },
    modelValue: {
        types: [ String, null ],
        required: true,
    },
});

const emit = defineEmits(['update:modelValue', 'delete']);

const image = computed(() => {
   if(props.oldValue) return props.oldValue;

   if( props.modelValue?.output ) {
       return props.modelValue.output.image;
   }

   return undefined;
});

watch(() => props.id, (newValue) => {
    const o = getOptions();
    console.log('create change');
    SlimLib.create( slim.value, o );
});

onMounted(() => {
    const o = getOptions();

    SlimLib.create( slim.value, o );
});

const getOptions = () => {
    const o = props.options ?? {};

    o.edit = true;
    o.upload = false;
    o.instantEdit = true;
    o.label = t('popup_image.label');
    o.buttonRemoveTitle = t('popup_image.buttonRemoveTitle');
    o.buttonEditTitle = t('popup_image.buttonEditTitle');
    o.buttonRotateTitle = t('popup_image.buttonRotateTitle');
    o.buttonCancelLabel = t('popup_image.buttonCancelLabel');
    o.buttonCancelTitle = t('popup_image.buttonCancelTitle');
    o.buttonConfirmLabel = t('popup_image.buttonConfirmLabel');
    o.buttonConfirmTitle = t('popup_image.buttonConfirmTitle');
    o.didConfirm = onConfirm.bind(this);
    o.didRemove = onDelete.bind(this);

    return o;
}

const onConfirm = (formaData, slim) => {
    emit('update:modelValue', slim.dataBase64);
}

const onDelete = (formData, slim) => {
    emit('delete', props.index);
}
</script>

<style>
@import "/public/plugins/slim/slim.min.css";
</style>
