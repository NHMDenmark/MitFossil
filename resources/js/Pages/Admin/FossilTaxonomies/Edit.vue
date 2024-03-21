<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import SelectInput from "@/Components/SelectInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputImage from "@/Components/InputImage.vue";
import InputTextInline from "@/Components/InputTextInline.vue";

const props = defineProps({
    fossil_taxonomy: Object
});

const form = useForm({
    description: props.fossil_taxonomy.description,
    fossil_kingdom_id: props.fossil_taxonomy.fossil_kingdom_id,
    fossil_common_id: props.fossil_taxonomy.fossil_common_id,
    fossil_phylum_id: props.fossil_taxonomy.fossil_phylum_id,
    fossil_class_id: props.fossil_taxonomy.fossil_class_id,
    fossil_order_id: props.fossil_taxonomy.fossil_order_id,
    fossil_family_id: props.fossil_taxonomy.fossil_family_id,
    fossil_genre_id: props.fossil_taxonomy.fossil_genre_id,
    fossil_subgenre_id: props.fossil_taxonomy.fossil_subgenre_id,
    specific_epithet_id: props.fossil_taxonomy.specific_epithet_id,
    fossil_subspecies_id: props.fossil_taxonomy.fossil_subspecies_id,
});
</script>

<template>
    <Head title="Edit Fossil Taxonomies" />

    <AdminLayout>
        <div class="flex-content container-fluid p-3 p-md-45 bg-white-3">
            <div class="col bg-white border-light shadow rounded p-0 col-divider">
                <div class="p-4">
                    <h5 class="heading-s fw-700 mb-3">{{ $t('form.edit') }} {{ $t('layout.admin.taxon_text') }}</h5>

                    <form @submit.prevent="form.put(route('admin.fossil-taxonomies.update', fossil_taxonomy.id))">
                        <div class="row mt-4">
                            <div class="col-12 col-lg-8">
                                <div class="row row-form mt-2">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <InputTextInline name="description" v-model="form.description" :label="$t('layout.admin.taxon_text')" />
                                            <InputError class="mt-2" :message="form.errors.description" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-form mt-2">
                                    <div class="col col-label">
                                        <InputLabel for="fossil_common_id" :value="$t('form.fossil_common')" />
                                    </div>
                                    <div class="col col-input">
                                        <SelectInput
                                            id="fossil_common_id"
                                            class="mt-1 block w-full"
                                            :placeholder="$t('form.select') + ' ' + $t('form.fossil_common')"
                                            v-model="form.fossil_common_id"
                                            :options="$page.props.commons"
                                        />
                                        <InputError class="mt-2" :message="form.errors.fossil_common_id" />
                                    </div>
                                </div>

                                <div class="row row-form mt-2">
                                    <div class="col col-label">
                                        <InputLabel for="fossil_kingdom_id" :value="$t('form.fossil_kingdom')" />
                                    </div>
                                    <div class="col col-input">
                                        <SelectInput
                                            id="fossil_kingdom_id"
                                            class="mt-1 block w-full"
                                            :placeholder="$t('form.select') + ' ' + $t('form.fossil_kingdom')"
                                            v-model="form.fossil_kingdom_id"
                                            :options="$page.props.kingdoms"
                                        />
                                        <InputError class="mt-2" :message="form.errors.fossil_kingdom_id" />
                                    </div>
                                </div>

                                <div class="row row-form mt-2">
                                    <div class="col col-label">
                                        <InputLabel for="fossil_phylum_id" :value="$t('form.fossil_phylum')" />
                                    </div>
                                    <div class="col col-input">
                                        <SelectInput
                                            id="fossil_phylum_id"
                                            class="mt-1 block w-full"
                                            :placeholder="$t('form.select') + ' ' + $t('form.fossil_phylum')"
                                            v-model="form.fossil_phylum_id"
                                            :options="$page.props.phylums"
                                        />
                                        <InputError class="mt-2" :message="form.errors.fossil_phylum_id" />
                                    </div>
                                </div>

                                <div class="row row-form mt-2">
                                    <div class="col col-label">
                                        <InputLabel for="fossil_class_id" :value="$t('form.fossil_class')" />
                                    </div>
                                    <div class="col col-input">
                                        <SelectInput
                                            id="fossil_class_id"
                                            class="mt-1 block w-full"
                                            :placeholder="$t('form.select') + ' ' + $t('form.fossil_class')"
                                            v-model="form.fossil_class_id"
                                            :options="$page.props.classes"
                                        />
                                        <InputError class="mt-2" :message="form.errors.fossil_class_id" />
                                    </div>
                                </div>

                                <div class="row row-form mt-2">
                                    <div class="col col-label">
                                        <InputLabel for="fossil_order_id" :value="$t('form.fossil_order')" />
                                    </div>
                                    <div class="col col-input">
                                        <SelectInput
                                            id="fossil_class_id"
                                            class="mt-1 block w-full"
                                            :placeholder="$t('form.select') + ' ' + $t('form.fossil_order')"
                                            v-model="form.fossil_order_id"
                                            :options="$page.props.orders"
                                        />
                                        <InputError class="mt-2" :message="form.errors.fossil_order_id" />
                                    </div>
                                </div>

                                <div class="row row-form mt-2">
                                    <div class="col col-label">
                                        <InputLabel for="fossil_family_id" :value="$t('form.fossil_family')" />
                                    </div>
                                    <div class="col col-input">
                                        <SelectInput
                                            id="fossil_family_id"
                                            class="mt-1 block w-full"
                                            :placeholder="$t('form.select') + ' ' + $t('form.fossil_family')"
                                            v-model="form.fossil_family_id"
                                            :options="$page.props.families"
                                        />
                                        <InputError class="mt-2" :message="form.errors.fossil_family_id" />
                                    </div>
                                </div>

                                <div class="row row-form mt-2">
                                    <div class="col col-label">
                                        <InputLabel for="fossil_genre_id" :value="$t('form.fossil_genre')" />
                                    </div>
                                    <div class="col col-input">
                                        <SelectInput
                                            id="fossil_genre_id"
                                            class="mt-1 block w-full"
                                            :placeholder="$t('form.select') + ' ' + $t('form.fossil_genre')"
                                            v-model="form.fossil_genre_id"
                                            :options="$page.props.genres"
                                        />
                                        <InputError class="mt-2" :message="form.errors.fossil_genre_id" />
                                    </div>
                                </div>
                                <!--
                                <div class="row row-form mt-2">
                                    <div class="col col-label">
                                        <InputLabel for="fossil_subgenre_id" :value="$t('form.fossil_subgenre')" />
                                    </div>
                                    <div class="col col-input">
                                        <SelectInput
                                            id="fossil_subgenre_id"
                                            class="mt-1 block w-full"
                                            :placeholder="$t('form.select') + ' ' + $t('form.fossil_subgenre')"
                                            v-model="form.fossil_subgenre_id"
                                            :options="$page.props.subgenres"
                                        />
                                        <InputError class="mt-2" :message="form.errors.fossil_subgenre_id" />
                                    </div>
                                </div>
                                -->
                                <div class="row row-form mt-2">
                                    <div class="col col-label">
                                        <InputLabel for="specific_epithet_id" :value="$t('form.specific_epithet')" />
                                    </div>
                                    <div class="col col-input">
                                        <SelectInput
                                            id="specific_epithet_id"
                                            class="mt-1 block w-full"
                                            :placeholder="$t('form.select') + ' ' + $t('form.specific_epithet')"
                                            v-model="form.specific_epithet_id"
                                            :options="$page.props.specific_epithets"
                                        />
                                        <InputError class="mt-2" :message="form.errors.specific_epithet_id" />
                                    </div>
                                </div>
                                <!--
                                <div class="row row-form mt-2">
                                    <div class="col col-label">
                                        <InputLabel for="fossil_subspecies_id" :value="$t('form.fossil_subspecies')" />
                                    </div>
                                    <div class="col col-input">
                                        <SelectInput
                                            id="fossil_subspecies_id"
                                            class="mt-1 block w-full"
                                            :placeholder="$t('form.select') + ' ' + $t('form.fossil_subspecies')"
                                            v-model="form.fossil_subspecies_id"
                                            :options="$page.props.subspecies"
                                        />
                                        <InputError class="mt-2" :message="form.errors.fossil_subspecies_id" />
                                    </div>
                                </div>
                                -->
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-end">
                                <PrimaryButton class="me-2" type="link" :url="route('admin.fossil-taxonomies.index')">{{ $t('form.back') }}</PrimaryButton>
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
