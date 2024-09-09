<script setup>
import {Head} from "@inertiajs/vue3";
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from "@/Components/SelectInput.vue";
import { Link, useForm, usePage, router } from '@inertiajs/vue3';
import Editor from 'primevue/editor';
import Modal from "@/Components/Modal.vue";
import {ref} from "vue";

const { messages, sender, receiver, thread, user } = defineProps({ messages: Array, sender: Object, receiver: Object, thread: Object, user: Object })

const form = useForm({
    receiver_id: null,
    text: '',
    attachments: [],
});
const modal = ref({})
const type = ref(null)
const delete_id = ref(null)
const parent_id = ref(null)
const scope = ref({
    title: null,
    description: null
})

function manageAttachments(event) {
    const files = event.target.files
    const fileReader = new FileReader()
    for (let i = 0; i < files.length; i++) {
        form.attachments.push(files[i]);
    }
}

const onDeleteClick = (id, typeVal, parentID = null) => {
    scope.value.title = 'Slet ' + (typeVal === 'message' ? 'beskeden' : 'samtalen');
    type.value = typeVal
    parent_id.value = parentID
    delete_id.value = id
    modal.value.show();
};

const confirmAction = () => {
    if(type.value === 'message') {
        window.location.href = '/threads/' + parent_id.value + '/' + delete_id.value + '/delete'
    } else {
        window.location.href = '/threads/delete/' + delete_id.value
    }

    modal.value.hide();
}

</script>

<template>
    <Head :title="$t('pages.threads.thread_title')" />

    <CustomerLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="flex-column flex-xl-row gap-45 align-items-start">
                <form @submit.prevent="form.post(route('threads.storeMessage', {thread: thread.id}));" class="col bg-white border-light shadow rounded p-4 pt-5">
                    <div class="d-flex w-100 justify-content-between">
                        <h2>{{ thread.status == 'open' ? 'Send en besked i samtalen' : 'Læs samtalen' }}</h2>
                        <div class="d-flex">
                            <PrimaryButton class="align-self-end" style="margin-right: 10px;" type="link" :url="route('threads.index')">Tilbage</PrimaryButton>
                            <PrimaryButton v-if="user.role == 'admin'" class="align-self-end" style="margin-right: 10px;" type="button" @click="onDeleteClick(thread.id, 'thread')">Slet samtalen</PrimaryButton>
                            <PrimaryButton v-if="user.role == 'admin'" class="align-self-end" type="link" :url="route('threads.change_status', {thread: thread.id, status: thread.status == 'closed' ? 'open' : 'closed'})">{{ thread.status == 'closed' ? 'Åbn samtalen' : 'Luk samtalen' }}</PrimaryButton>
                        </div>
                    </div>
                    <div class="col-12 mt-3" v-if="thread.status == 'open'">
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
                    <div class="col-12 mt-3 d-flex flex-column" v-if="thread.status == 'open'">
                        <InputLabel class="mb-2" :value="'Vedhæftede filer'"></InputLabel>

                        <input type="file" name="attachments" id="attachments" multiple @change="manageAttachments"/>
                    </div>
                    <PrimaryButton v-if="thread.status == 'open'" class="mt-6 align-self-end" type="submit">Send</PrimaryButton>
                </form>
                <div class="mt-4 flex-column flex-xl-row gap-45 align-items-start col bg-white border-light shadow rounded p-0 col-divider">
                    <div class="d-flex flex-column p-4" v-for="message in messages">
                        <span class="mb-2">{{ message.sender ? message.sender.username : 'Slettet bruger' }}</span>
                        <span style="color: gray" class="mb-4">{{ message.created_at }}</span>
                        <div v-html="message.body"></div>
                        <span v-if="message.attachments.length > 0" class="mt-6">Attachments:</span>
                        <a v-for="attachment in message.attachments" :href="'attachment/' + attachment.name" :download="attachment.name">{{ attachment.name }}</a>
                        <PrimaryButton v-if="user.role == 'admin'" class="mt-3" type="button" @click="onDeleteClick(message.id, 'message', message.thread.id)" >Slet beskeden</PrimaryButton>
                    </div>
                </div>
            </div>
        </div>
        <Modal
            ref="modal"
            :show-cancel-button="true"
            :title="scope.title"
            :text-cancel-button="$t('components.modal.cancel')"
            :textOkButton="$t('components.modal.accept')"
            @ok="confirmAction">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <p class="text-m">Er du sikker?</p>
                    </div>
                </div>
            </div>
        </Modal>
    </CustomerLayout>
</template>
