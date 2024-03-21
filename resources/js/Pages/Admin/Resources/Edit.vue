<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputTextInline from "@/Components/InputTextInline.vue";
import ClipboardJS from 'clipboard';
import { VueEditor } from "vue3-editor";
import { saveImage } from "@/Composables/useResource";
import CardResource from "@/Components/partials/CardResource.vue";
import {ref} from "vue";
import Modal from "@/Components/Modal.vue";
import InputImage from "@/Components/InputImage.vue";
import FileSearch from "@/Components/FileSearch.vue";
import DeleteForm from "@/Components/DeleteForm.vue";

const props = defineProps({
    resource: Object
});

const modalConfirm = ref();
const formDelete = useForm({
    id: null
});

const form = useForm({
    id: props.resource.id,
    resource_id: props.resource.resource_id,
    description: props.resource.description,
    name: props.resource.name,
    endpoint: props.resource.parent ?
        props.resource.endpoint.replace(props.resource.parent.endpoint + '/', '') :
        props.resource.endpoint,
    resource_order: props.resource.resource_order,
    image: props.resource.image,
    html: props.resource.html
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

async function copyLink(resource) {
    resource.copied = true;

    const clipboard = new ClipboardJS('.btn', {
        text: () => route('customer.resources.show', resource.endpoint),
    });

    // Simular un clic en el botón para copiar el texto
    clipboard.on('success', (e) => {
        e.clearSelection(); // Limpiar la selección después de copiar
    });

    clipboard.on('error', (e) => {
        console.error('Error al copiar al portapapeles:', e.action);
    });

    // Simular un clic en el botón
    clipboard.onClick({ currentTarget: document.querySelector('.btn') });

    setTimeout(() => {
        resource.copied = false;
    }, 1000);
}

async function handleImageAdded(file, Editor, cursorLocation, resetUploader) {
    const formData = new FormData();
    formData.append("image", file);

    const result = await saveImage(formData);

    Editor.insertEmbed(cursorLocation, "image", result);
    resetUploader();
}

function onDelete(id) {
    formDelete.id = id;
    modalConfirm.value.show();
}

function onOkConfirm() {
    formDelete.delete(route('admin.resources.destroy', formDelete.id ));
}

function onSubmit() {
    //form.html = form.html.replaceAll('target="_blank"', '');
    form.put(route('admin.resources.update', props.resource.id))
}
</script>

<template>
    <Head title="Edit Resource" />

    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="col bg-white border-light shadow rounded p-0 col-divider">
                <div class="p-4">
                    <h5 v-if="resource.parent" class="heading-s fw-700 mb-3">{{ $t('form.edit') }} {{ $t('layout.admin.resources_text_3') }}</h5>
                    <h5 v-else class="heading-s fw-700 mb-3">{{ $t('form.edit') }} {{ $t('layout.admin.resources_text_2') }}</h5>

                    <CardResource v-if="resource.parent" :resource="resource.parent">
                        <PrimaryButton class="me-2" type="link" :url="route('admin.resources.edit', resource.resource_id)"> {{ $t('form.back') }} </PrimaryButton>
                    </CardResource>

                    <form @submit.prevent="onSubmit">
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
                                        <div class="form-group line-break">
                                            <InputTextInline name="endpoint" v-model="form.endpoint" :label="$t('layout.admin.endpoint') + (resource.parent ? ` (${resource.parent.endpoint}/)` : '')" />
                                            <InputError class="mt-2" :message="form.errors.endpoint" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="description" v-model="form.description" :label="$t('layout.admin.resource_description')"  />
                                            <InputError class="mt-2" :message="form.errors.description" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="resource_order" v-model="form.resource_order" :label="$t('layout.admin.resource_order')" type="number" />
                                            <InputError class="mt-2" :message="form.errors.resource_order" />
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <FileSearch></FileSearch>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <vue-editor v-model="form.html" :editorToolbar="fullToolbar" useCustomImageHandler @image-added="handleImageAdded"></vue-editor>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 col-md-6 col-lg-3">
                                <h5 class="heading-s fw-700 mb-3">{{ $t('form.featured') }}</h5>
                                <InputImage
                                    id="image"
                                    class="m-auto"
                                    :options="{ ratio: '1:1', size: '1000, 1000' }"
                                    :old-value="form.image"
                                    v-model="form.image" />
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <CardResource v-for="(item, child) in resource.childs" :key="item.id" :resource="item" class="mt-3">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <PrimaryButton :disabled="item.copied === true" @click="copyLink(item)" >
                                                <span v-if="item.copied"> {{ $t('form.copied') }} </span>
                                                <span v-else> {{ $t('form.copy_link') }} </span>
                                            </PrimaryButton>
                                            <PrimaryButton :url="route('admin.resources.edit', item.id)" > {{ $t('form.edit') }}  </PrimaryButton>
                                            <DeleteForm :id="item.id" route_="admin.resources.destroy" :title="'Slet ' + $t('layout.admin.resources_text_3')"></DeleteForm>
                                        </div>
                                    </CardResource>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-end flex-wrap gap-2">
                                <PrimaryButton v-if="resource.id" type="link" :url="route('admin.resources.create') + `?resource_id=${ resource.id }`"> {{ $t('form.addchild') }}</PrimaryButton>
                                <PrimaryButton v-if="resource.resource_id" type="link" :url="route('admin.resources.edit', resource.resource_id)"> {{ $t('form.back') }} </PrimaryButton>
                                <PrimaryButton v-else type="link" :url="route('admin.resources.index')">{{ $t('form.back') }} </PrimaryButton>
                                <PrimaryButton type="submit" :disabled="form.processing">{{ $t('form.save') }}</PrimaryButton>

                                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">{{ $t('form.saved') }}.</p>
                                </Transition>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <Modal
        ref="modalConfirm"
        :show-cancel-button="true"
        :title="'Slet underside'"
        :text-cancel-button="$t('components.modal.cancel')"
        :textOkButton="$t('components.modal.accept')"
        @ok="onOkConfirm">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <p class="text-m">{{ $t('components.modal.userModalDesactive.question_delete') }}</p>
                </div>
            </div>
        </div>
        </Modal>

    </AdminLayout>
</template>
