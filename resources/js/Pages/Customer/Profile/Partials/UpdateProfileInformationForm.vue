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
    name: user.name,
    username: user.username,
    email: user.email,
    zip_code: user.zip_code,
    year_birth: user.year_birth,
    picture: user.picture,
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
        <div class="col-12 text-center">
            <div class="edit-picture">
                <InputImage
                    id="picture"
                    @delete="onDelete"
                    class="m-auto"
                    :options="{ ratio: '1:1', size: '1000, 1000' }"
                    :old-value="user.picture"
                    v-model="form.picture"
                    required />
                <InputLabel for="picture" :value="$t('form.edit_picture')" />
            </div>

            <InputError class="mt-2" :message="form.errors.picture" />
        </div>

        <form @submit.prevent="form.post(route('customer.profile.update'))">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <InputLabel for="name" :value="$t('form.name')" />

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                            />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="col-12 mt-3">
                            <InputLabel for="username" :value="$t('form.username')" />

                            <TextInput
                                id="username"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.username"
                                required
                                autocomplete="username"
                            />

                            <InputError class="mt-2" :message="form.errors.username" />
                        </div>

                        <div class="col-12 mt-3">
                            <InputLabel for="email" :value="$t('form.email')" />

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                            />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="col-12 mt-3">
                            <InputLabel for="email" :value="$t('form.zip_code')" />

                            <TextInput
                                id="zip_code"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.zip_code"
                                required
                            />

                            <InputError class="mt-2" :message="form.errors.zip_code" />
                        </div>

                        <div class="col-12 mt-3">
                            <InputLabel for="email" :value="$t('form.year_birth')" />

                            <TextInput
                                id="year_birth"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.year_birth"
                                required
                            />

                            <InputError class="mt-2" :message="form.errors.year_birth" />
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

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    {{ $t('pages.profile.verify_email') }}
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        {{ $t('pages.profile.verify_action') }}
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    {{ $t('pages.profile.verify_text') }}
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
