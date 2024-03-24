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
});

function onDelete() {
    form.picture = "empty";
}


</script>

<template>
    <div class="p-4">
        <h5 class="heading-s fw-700 mb-3">{{ $t('pages.profile.update_information') }}</h5>

        <form @submit.prevent="form.post(route('admin.profile.update'))">
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
                                autofocus
                                autocomplete="username"
                            />

                            <InputError class="mt-2" :message="form.errors.username" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

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
