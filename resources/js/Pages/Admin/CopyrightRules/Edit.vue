<template>
    <Head title="Add Copyright" />

    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="col bg-white border-light shadow rounded p-0 col-divider">
                <div class="p-4">
                    <h5 class="heading-s fw-700 mb-3">{{ $t('form.edit')}} {{ $t('layout.admin.copyright_rules_text_2') }}</h5>

                    <form @submit.prevent="form.put(route('admin.copyright-rules.update', copyright_rule.id))">
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="description" v-model="form.description" :label="$t('form.license')" />
                                            <InputError class="mt-2" :message="form.errors.description" />
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="notes" v-model="form.notes" :label="$t('form.notes_2')" type="textarea" />
                                            <InputError class="mt-2" :message="form.errors.notes" />
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

<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputTextInline from "@/Components/InputTextInline.vue";

const props = defineProps({
    copyright_rule: Object
});

const form = useForm({
    description: props.copyright_rule.description,
    notes: props.copyright_rule.notes,
});
</script>

