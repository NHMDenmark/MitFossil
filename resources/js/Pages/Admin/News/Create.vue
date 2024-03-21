<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputTextInline from "@/Components/InputTextInline.vue";
import { VueEditor } from "vue3-editor";
import { saveImage } from "@/Composables/useResource";
import InputImage from "@/Components/InputImage.vue";
import FileSearch from "@/Components/FileSearch.vue";

const form = useForm({
    description: null,
    name: null,
    endpoint: null,
    new_order: null,
    html: '',
    image: null
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

<template>
    <Head title="Add News" />

    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="col bg-white border-light shadow rounded p-0 col-divider">
                <div class="p-4">
                    <h5 class="heading-s fw-700 mb-3">{{ $t('form.add') }} {{ $t('layout.admin.news_text_2') }}</h5>

                    <form @submit.prevent="form.post(route('admin.news.store'))">
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="name" v-model="form.name" :label="$t('layout.admin.resource_name')" />
                                            <InputError class="mt-2" :message="form.errors.name" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="endpoint" v-model="form.endpoint" :label="$t('layout.admin.endpoint')" />
                                            <InputError class="mt-2" :message="form.errors.endpoint" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="description" v-model="form.description" :label="$t('layout.admin.resource_description')" />
                                            <InputError class="mt-2" :message="form.errors.description" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="new_order" v-model="form.new_order" :label="$t('layout.admin.resource_order')" type="number" />
                                            <InputError class="mt-2" :message="form.errors.new_order" />
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <FileSearch></FileSearch>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <vue-editor v-model="form.html" :editorToolbar="fullToolbar" useCustomImageHandler @image-added="handleImageAdded"></vue-editor>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <InputImage
                                            id="image"
                                            class="mt-2 border-2 border-light"
                                            height="300px"
                                            :options="{ ratio: '1:1', size: '1000, 1000' }"
                                            v-model="form.image"
                                            :old-value="form.image?.output.image"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-end">
                                <PrimaryButton class="me-2" type="link" :url="route('admin.news.index')">{{ $t('form.back') }}</PrimaryButton>
                                <PrimaryButton type="submit" :disabled="form.processing">{{ $t('form.add') }}</PrimaryButton>

                                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">{{ $t('form.saved') }}</p>
                                </Transition>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
