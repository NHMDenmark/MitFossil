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

defineProps({ messages: Array, sender: Object, receiver: Object, user: Object })

const form = useForm({
    receiver_id: null,
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
    <Head :title="$t('pages.threads.thread_title')" />

    <CustomerLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="flex-column flex-xl-row gap-45 align-items-start">
                <form @submit.prevent="form.post(route('threads.storeMessage', {thread: messages[0].thread.id}));" class="col bg-white border-light shadow rounded p-4 pt-5">
                    <div class="d-flex w-100 justify-content-between">
                        <h2>{{ messages[0].thread.status == 'open' ? 'Reply to the thread' : 'View thread' }}</h2>
                        <div class="d-flex">
                            <PrimaryButton v-if="user.role == 'admin'" class="align-self-end" style="margin-right: 10px;" type="link" :url="route('threads.delete', {thread: messages[0].thread.id})">Delete</PrimaryButton>
                            <PrimaryButton v-if="user.role == 'admin'" class="align-self-end" type="link" :url="route('threads.change_status', {thread: messages[0].thread.id, status: messages[0].thread.status == 'closed' ? 'open' : 'closed'})">{{ messages[0].thread.status == 'closed' ? 'Open' : 'Close' }}</PrimaryButton>
                        </div>
                    </div>
                    <div class="col-12 mt-3" v-if="messages[0].thread.status == 'open'">
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
                        <InputError class="mt-2" :message="form.errors.text" />
                    </div>
                    <div class="col-12 mt-3 d-flex flex-column" v-if="messages[0].thread.status == 'open'">
                        <InputLabel class="mb-2" :value="$t('form.thread_message_attachments')"></InputLabel>

                        <input type="file" name="attachments" id="attachments" multiple @change="manageAttachments"/>
                    </div>
                    <PrimaryButton v-if="messages[0].thread.status == 'open'" class="mt-6 align-self-end" type="submit">Send</PrimaryButton>
                </form>
                <div class="mt-4 flex-column flex-xl-row gap-45 align-items-start col bg-white border-light shadow rounded p-0 col-divider">
                    <div class="d-flex flex-column p-4" v-for="message in messages">
                        <span class="mb-2">{{ message.sender.username }}</span>
                        <span style="color: gray" class="mb-4">{{ message.created_at }}</span>
                        <div v-html="message.body"></div>
                        <span v-if="message.attachments.length > 0" class="mt-6">Attachments:</span>
                        <a v-for="attachment in message.attachments" :href="'attachment/' + attachment.name" :download="attachment.name">{{ attachment.name }}</a>
                        <PrimaryButton v-if="user.role == 'admin'" class="mt-3" type="link" :url="route('threads.delete_message', {message: message.id, thread: messages[0].thread.id})">Delete message</PrimaryButton>
                    </div>
                </div>
            </div>
        </div>
    </CustomerLayout>
</template>
