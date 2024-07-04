<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage, router } from '@inertiajs/vue3';
import InputImage from "@/Components/InputImage.vue";
import SelectInput from "@/Components/SelectInput.vue";
import { ref } from 'vue';

const props = defineProps({
    mustVerifyEmail: { type: Boolean },
    status: { type: String, },
    copyright_rules: { type: Array }
});

const user = usePage().props.auth.user;
const notes = ref('');

const form = useForm({
    username: user.username,
    copyright_rule_id: user.copyright_rule_id,
    fossil_speciality: user.fossil_speciality,
    fossil_region: user.fossil_region,
});

function onDelete() {
    form.picture = "empty";
}

function onSelectCopyright(value) {
    if(value) {
        const item = props.copyright_rules.find(x => x.value === value);
        notes.value = item.notes;
    } else {
        notes.value = '';
    }
}
</script>

<template>
    <div class="p-4">
        <h5 class="heading-s fw-700 mb-3">{{ $t('pages.profile.update_information') }}</h5>

        <form @submit.prevent="form.post(route('customer.profile.update'))">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 mt-3">
                            <InputLabel for="username" :value="$t('form.username')" />

                            <TextInput
                                id="username"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.username"
                                required
                                disabled
                                autocomplete="username"
                            />
                            <p class="mt-2">Hvis du ønsker at ændre brugernavn, kontakt venligst administratoren.</p>
                            <InputError class="mt-2" :message="form.errors.username" />
                        </div>

                        <div class="col-12 mt-3">
                            <InputLabel for="licence_id" :value="$t('form.copyright')" />

                            <SelectInput
                                id="copyright_rule_id"
                                class="mt-1 block w-full"
                                v-model="form.copyright_rule_id"
                                :options="copyright_rules"
                                @select="onSelectCopyright"
                            />

                            <p class="d-block mt-2 text-s" v-html="notes"></p>
                            <InputError class="mt-2" :message="form.errors.copyright_rule_id" />
                        </div>

                        <div v-if="user.role === 'curator'" class="col-12 mt-3">
                            <InputLabel for="fossil_speciality_id" :value="$t('form.user_specialitet')" />

                            <TextInput
                                id="fossil_speciality"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.fossil_speciality"
                            />

                            <InputError class="mt-2" :message="form.errors.fossil_speciality_id" />
                        </div>

                        <div v-if="user.role === 'curator'" class="col-12 mt-3">
                            <InputLabel for="fossil_region_id" :value="$t('form.user_region')" />

                            <TextInput
                                id="fossil_region"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.fossil_region"
                            />

                            <InputError class="mt-2" :message="form.errors.fossil_region_id" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 text-end">
                    <PrimaryButton :disabled="form.processing" type="submit">{{ $t('form.save') }}</PrimaryButton>

                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">{{ $t('form.saved') }}</p>
                    </Transition>
                </div>
            </div>
        </form>
    </div>
</template>
