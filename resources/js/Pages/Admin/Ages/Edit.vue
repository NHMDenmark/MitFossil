<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import SelectInput from "@/Components/SelectInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputImage from "@/Components/InputImage.vue";
import InputTextInline from "@/Components/InputTextInline.vue";
import SelectInputInline from "@/Components/SelectInputInline.vue";

const props = defineProps({
    age: Object
});

const form = useForm({
    description: props.age.description,
    epoch_id: props.age.epoch_id,
});
</script>

<template>
    <Head title="Edit Age" />

    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="col bg-white border-light shadow rounded p-0 col-divider">
                <div class="p-4">
                    <h5 class="heading-s fw-700 mb-3">{{ $t('form.edit') }} {{ $t('layout.admin.ages_text_2') }}</h5>

                    <form @submit.prevent="form.put(route('admin.ages.update', age.id))">
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="form-group">
                                            <InputTextInline name="description" v-model="form.description" :label="$t('layout.admin.ages_text_2')" />
                                            <InputError class="mt-2" :message="form.errors.description" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="form-group">
                                            <SelectInputInline
                                                id="epoch_id"
                                                class="mt-1 block w-full"
                                                :label="$t('form.current') + ' ' + $t('form.epoch')"
                                                :placeholder="$t('form.select') + ' ' + $t('form.epoch')"
                                                v-model="form.epoch_id"
                                                :options="$page.props.epochs"
                                            />
                                            <InputError class="mt-2" :message="form.errors.epoch_id" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-end">
                                <PrimaryButton class="me-2" type="link" :url="route('admin.ages.index')">{{ $t('form.back') }}</PrimaryButton>
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
