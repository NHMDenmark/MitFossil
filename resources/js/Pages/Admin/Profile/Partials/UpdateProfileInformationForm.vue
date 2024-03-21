<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage, router } from '@inertiajs/vue3';
import InputImage from "@/Components/InputImage.vue";
import SelectInput from "@/Components/SelectInput.vue";

defineProps({
    mustVerifyEmail: { type: Boolean },
    status: { type: String },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    username: user.username,
    email: user.email,
    picture: user.picture,
});

function onDelete() {
    form.picture = "empty";
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

        <form @submit.prevent="form.post(route('admin.profile.update'))">
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
                                autofocus
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
                                autocomplete="username"
                            />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 text-end">
                    <PrimaryButton type="submit" :disabled="form.processing">{{ $t('form.save') }}</PrimaryButton>

                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">{{ $t('form.saved') }}</p>
                    </Transition>
                </div>
            </div>
        </form>
    </div>
</template>
