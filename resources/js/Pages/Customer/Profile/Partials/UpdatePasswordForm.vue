<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from "@/Components/SelectInput.vue";
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: ''
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <div class="p-4">
        <h5 class="heading-s fw-700 mb-3">{{ $t('pages.profile.update_password') }}</h5>
        <form @submit.prevent="updatePassword" class="mt-4 w-100 mb-4">
            <div class="row">
                <div class="col">
                    <InputLabel for="current_password" :value="$t('form.current_password')" />

                    <TextInput
                        id="current_password"
                        ref="currentPasswordInput"
                        v-model="form.current_password"
                        type="password"
                        class="mt-1 block w-full"
                        autocomplete="current-password"
                    />

                    <InputError :message="form.errors.current_password" class="mt-2" />
                </div>
            </div>

            <div class="row">
                <div class="col col-sm-6 mt-4">
                    <InputLabel for="password" :value="$t('form.new_password')" />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full"
                        autocomplete="new-password"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="col col-sm-6 mt-4">
                    <InputLabel for="password_confirmation" :value="$t('form.repeat_new_password')" />

                    <TextInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        autocomplete="new-password"
                    />

                    <InputError :message="form.errors.password_confirmation" class="mt-2" />
                </div>
            </div>

            <div class="row">
                <div class="col mt-4 text-end" >
                    <PrimaryButton :disabled="form.processing" type="submit">{{ $t('form.save')}}</PrimaryButton>

                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">{{ $t('form.saved') }}</p>
                    </Transition>
                </div>
            </div>
        </form>
    </div>
</template>
