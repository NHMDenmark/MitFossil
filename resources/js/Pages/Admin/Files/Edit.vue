<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import InputTextInline from "@/Components/InputTextInline.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
    file: { type: Object }
});

const form = useForm({
    _method: 'put',
    id: props.file.id,
    name: props.file.name,
    file: null
});

function onSubmit() {
    console.log(form);

    form.post(route('admin.files.update', form.id));
}
</script>

<template>
    <Head title="Tilføj Arkiv"/>

    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="col bg-white border-light shadow rounded p-0 col-divider">
                <div class="p-4">
                    <h5 class="heading-s fw-700 mb-3">{{ $t('form.edit') }} {{ $t('layout.admin.files_text_2') }}</h5>
                    <form @submit.prevent="onSubmit">
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="name" v-model="form.name" :label="$t('layout.admin.files_name')" />
                                            <InputError class="mt-2" :message="form.errors.name" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="form-group">
                                            <input class="form-control" type="file" @input="form.file = $event.target.files[0]">
                                            <InputError class="mt-2" :message="form.errors.file" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-end">
                                <PrimaryButton class="me-2" type="link" @click="window.history.back()">{{ $t('form.back') }}</PrimaryButton>
                                <PrimaryButton type="submit" :disabled="form.processing">{{ $t('form.save') }}</PrimaryButton>

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
