<script setup>
import {Head} from "@inertiajs/vue3";
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from "@/Components/SelectInput.vue";
import { Link, useForm, usePage, router } from '@inertiajs/vue3';
import Editor from 'primevue/editor';

defineProps({ receivers: Array, categories: Array })

const form = useForm({
    receiver_id: null,
    title: '',
    status: 'open',
    category: '',
    text: '',
    attachments: [],
});

function manageAttachments(event) {
    const files = event.target.files
    const fileReader = new FileReader()
    for (let i = 0; i < files.length; i++) {
        form.attachments.push(files[i]);
    }
}
</script>

<template>
    <Head :title="$t('pages.threads.create_title')" />

    <CustomerLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="d-flex flex-column flex-xl-row gap-45 align-items-start">
                <form @submit.prevent="form.post(route('threads.store'))" class="col bg-white border-light shadow rounded p-4 pt-5">
                    <div class="col-12 mt-3">
                        <h3 class="mb-4">Send a new message</h3>
                        <InputLabel for="receiver_id" :value="$t('form.thread_receiver')" />

                        <SelectInput
                            id="receiver_id"
                            class="mt-1 block w-full"
                            v-model="form.receiver_id"
                            :options="receivers"
                        />
                        <InputError class="mt-2" :message="form.errors.receivers" />
                    </div>
                    <div class="col-12 mt-3">
                        <InputLabel for="title" :value="$t('form.thread_title')" />

                        <TextInput
                            id="title"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.title"
                            required
                            autocomplete="title"
                        />

                        <InputError class="mt-2" :message="form.errors.title" />
                    </div>
                    <div class="col-12 mt-3">
                        <InputLabel for="category" :value="$t('form.thread_category')" />

                        <SelectInput
                            id="receiver_id"
                            class="mt-1 block w-full"
                            v-model="form.category"
                            :options="categories"
                        />
                        <InputError class="mt-2" :message="form.errors.category" />
                    </div>
                    <div class="col-12 mt-3">
                        <InputLabel class="mb-2" :value="$t('form.thread_message_text')"></InputLabel>

                        <Editor v-model="form.text" editorStyle="height: 320px">
                            <template v-slot:toolbar>
                                <span class="ql-formats">
                                    <button v-tooltip.bottom="'Bold'" class="ql-bold"></button>
                                    <button v-tooltip.bottom="'Italic'" class="ql-italic"></button>
                                    <button v-tooltip.bottom="'Underline'" class="ql-underline"></button>
                                    <button class="ql-list" value="ordered"></button>
                                    <button class="ql-list" value="bullet"></button>
                                </span>
                            </template>
                        </Editor>
                    </div>
                    <div class="col-12 mt-3 d-flex flex-column">
                        <InputLabel class="mb-2" :value="$t('form.thread_message_attachments')"></InputLabel>

                        <input type="file" name="attachments" id="attachments" multiple @change="manageAttachments"/>
                    </div>
                    <PrimaryButton class="mt-6 align-self-end" type="submit">Send</PrimaryButton>
                </form>
            </div>
        </div>
    </CustomerLayout>
</template>