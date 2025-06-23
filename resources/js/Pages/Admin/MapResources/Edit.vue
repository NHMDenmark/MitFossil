<template>
    <Head title="Edit Map Resource" />

    <AdminLayout>

        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="col bg-white border-light shadow rounded p-0 col-divider">
                <div class="p-4">
                    <h5 class="heading-s fw-700 mb-3">{{ $t('form.edit') }} {{ $t('layout.admin.map_resources_title') }}</h5>

                    <form @submit.prevent="form.put(route('admin.map-resources.update', mapResource.id))">

                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="row">

                                    <div class="col-12 col-sm-12 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="title" v-model="form.title" :label="$t('layout.admin.map_resources_title')" />
                                            <InputError class="mt-2" :message="form.errors.title" />
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="name" v-model="form.longitude" :label="$t('form.longitude')" />
                                            <InputError class="mt-2" :message="form.errors.longitude" />
                                        </div>
                                    </div>

                                    <div class="col-12  col-sm-12 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="username" v-model="form.latitude" :label="$t('form.latitude')" />
                                            <InputError class="mt-2" :message="form.errors.latitude" />
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-12 col-lg-4 mt-45 mt-lg-0 my-4" style="position: relative">
                                <Map
                                    :label="$t('layout.admin.map_text')"
                                    @set-marker="onSetMark"
                                    :lat="form.latitude"
                                    :lng="form.longitude"
                                    :can-click="true">
                                </Map>
                            </div>
                            <div class="col-12 mt-3">
                                <FileSearch></FileSearch>
                            </div>
                            <div class="col-12 mt-3">
                                <vue-editor v-model="form.text" :editorToolbar="fullToolbar" useCustomImageHandler @image-added="handleImageAdded"></vue-editor>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-end">
                                <PrimaryButton class="me-2" type="link" @click="window.history.back()"> {{ $t('form.back') }} </PrimaryButton>
                                <PrimaryButton type="submit" :disabled="form.processing"> {{ $t('form.save') }} </PrimaryButton>

                                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600"> {{ $t('form.saved') }} </p>
                                </Transition>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>

import {Head, useForm} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputTextInline from "@/Components/InputTextInline.vue";
import Map from "@/Pages/Customer/NewFossil/partials/Map.vue";
import {VueEditor} from "vue3-editor";
import {saveImage} from "@/Composables/useResource";
import FileSearch from "@/Components/FileSearch.vue";

const props = defineProps({
    mapResource: { type: Object }
})

function onSetMark(latLng) {
    form.latitude = latLng.lat();
    form.longitude = latLng.lng();
}

const form = useForm({
    title: props.mapResource.title,
    latitude: props.mapResource.latitude,
    longitude: props.mapResource.longitude,
    text: props.mapResource.text,
});

var fullToolbar = [
    [{ font: [] }],

    [{ header: [false, 1, 2, 3, 4, 5, 6] }],

    [{ size: ["small", false, "large", "huge"] }],

    ["bold", "italic", "underline", "strike"],

    [
        { align: "" },
        { align: "center" },
        { align: "right" },
        { align: "justify" }
    ],

    [{ header: 1 }, { header: 2 }],

    ["blockquote", "code-block"],

    [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],

    [{ script: "sub" }, { script: "super" }],

    [{ indent: "-1" }, { indent: "+1" }],

    [{ color: [] }, { background: [] }],

    ["link", "image"],

    [{ direction: "rtl" }],
    ["clean"]
];

async function handleImageAdded(file, Editor, cursorLocation, resetUploader) {
    const formData = new FormData();
    formData.append("image", file);

    const result = await saveImage(formData);

    Editor.insertEmbed(cursorLocation, "image", result);
    resetUploader();
}
</script>

