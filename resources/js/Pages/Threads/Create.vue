<script setup>
import {Head} from "@inertiajs/vue3";
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from "@/Components/SelectInput.vue";
import { Link, useForm, usePage, router } from '@inertiajs/vue3';
import Editor from 'primevue/editor';

defineProps({ receivers: Array, categories: Array, user: Object })

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
<style>
.button_container{
    display: flex;
    align-items: flex-end;
}
</style>

<template>
    <Head :title="$t('pages.threads.create_title')" />

    <CustomerLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="d-flex flex-column flex-xl-row gap-45 align-items-start">
                <form @submit.prevent="form.post(route('threads.store'))" class="col bg-white border-light shadow rounded p-4 pt-5">
                    <h3 class="mb-4">Opret en ny samtale med MitFossils {{user.role == 'admin' ? 'brugere' : 'administratorer'}}</h3>
                    <div class="col-12 mt-3" v-if="user.role === 'admin'">
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
                        <InputLabel for="title" :value="'Overskrift'" />

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
                        <InputLabel for="category" :value="'Emne'" />

                        <SelectInput
                            id="receiver_id"
                            class="mt-1 block w-full"
                            v-model="form.category"
                            :options="categories"
                        />
                        <InputError class="mt-2" :message="form.errors.category" />
                    </div>
                    <div class="col-12 mt-3">
                        <InputLabel class="mb-2" :value="'Besked'"></InputLabel>

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
                        <InputError class="mt-2" :message="form.errors.text" />
                    </div>
                    <div class="col-12 mt-3 d-flex flex-column">
                        <InputLabel class="mb-2" :value="'Vedhæftede filer'"></InputLabel>

                        <input type="file" name="attachments" id="attachments" multiple @change="manageAttachments"/>
                    </div>
                    <div class="button_container">
                        <PrimaryButton class="mt-6" style="margin-right: 10px" type="submit">Send</PrimaryButton>
                        <PrimaryButton type="link" :url="route('threads.index')">Fortryd</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </CustomerLayout>
</template>
