<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputTextInline from "@/Components/InputTextInline.vue";
import { VueEditor } from "vue3-editor";
import { saveImage } from "@/Composables/useResource";
import CardResource from "@/Components/partials/CardResource.vue";
import InputImage from "@/Components/InputImage.vue";
import FileSearch from "@/Components/FileSearch.vue";

const props = defineProps({
    parent: { type: Object }
})

const form = useForm({
    resource_id: props.parent ? props.parent.id : null,
    description: null,
    name: null,
    endpoint: null,
    resource_order: null,
    image: null,
    html: ''
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

function onSubmit() {
    //form.html = form.html.replace('target="_blank"', '');
    form.post(route('admin.resources.store'))
}

</script>

<template>
    <Head title="Add Resource" />

    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="col bg-white border-light shadow rounded p-0 col-divider">
                <div class="p-4">
                    <h5 v-if="parent" class="heading-s fw-700 mb-3">{{ $t('form.add') }} {{
                        $t('layout.admin.resources_text_3') }}</h5>
                    <h5 v-else class="heading-s fw-700 mb-3">{{ $t('form.add') }} {{ $t('layout.admin.resources_text_2') }}
                    </h5>

                    <CardResource v-if="parent" :resource="parent">
                        <PrimaryButton class="me-2" type="link" :url="route('admin.resources.edit', parent.id)">{{
                            $t('form.back') }}</PrimaryButton>
                    </CardResource>

                    <form @submit.prevent="onSubmit">
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="name" v-model="form.name"
                                                :label="$t('layout.admin.resource_name')" />
                                            <InputError class="mt-2" :message="form.errors.name" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="form-group line-break">
                                            <InputTextInline name="endpoint" v-model="form.endpoint"
                                                :label="$t('layout.admin.endpoint') + (parent ? ` (${parent.endpoint}/)` : '')" />
                                            <InputError class="mt-2" :message="form.errors.endpoint" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="description" v-model="form.description"
                                                :label="$t('layout.admin.resource_description')" />
                                            <InputError class="mt-2" :message="form.errors.description" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="resource_order" v-model="form.resource_order"
                                                :label="$t('layout.admin.resource_order')" type="number" />
                                            <InputError class="mt-2" :message="form.errors.resource_order" />
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <FileSearch></FileSearch>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <vue-editor v-model="form.html" :editorToolbar="fullToolbar" useCustomImageHandler
                                            @image-added="handleImageAdded"></vue-editor>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <InputImage id="image" class="mt-2 border-2 border-light" height="300px"
                                            :options="{ ratio: '1:1', size: '1000, 1000' }" v-model="form.image" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-end">
                                <PrimaryButton class="me-2" type="link" :url="route('admin.resources.index')">{{
                                    $t('form.back') }}</PrimaryButton>
                                <PrimaryButton type="submit" :disabled="form.processing">{{ $t('form.add') }}
                                </PrimaryButton>

                                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0"
                                    class="transition ease-in-out">
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">{{ $t('form.saved') }}
                                    </p>
                                </Transition>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</AdminLayout></template>
