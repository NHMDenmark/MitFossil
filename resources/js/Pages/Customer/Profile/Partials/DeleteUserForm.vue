<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

defineProps({
    fossilSpecialities:{type:Array}
})
const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);
const modal = ref();

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    modal.value.show();

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('customer.profile.destroy'), {
        preserveScroll: true,
        onError: () => passwordInput.value.focus(),
        onFinish: () => {
            closeModal()
        }
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
    modal.value.hide();
    form.reset();
};
</script>

<template>
    <div class="p-4">
        <h5 class="heading-s fw-700 mb-3">{{ $t('pages.profile.delete_account') }}</h5>
        <template v-if="!$page.props.auth.user.send_delete">
            <p>{{ $t('pages.profile.delete_text') }}</p>
            <InputError :message="form.errors.password" class="mt-2" />
            <div class="row">
                <div class="col-12 text-end">
                    <DangerButton
                        class="btn-mit"
                        @click="confirmUserDeletion">{{ $t('pages.profile.delete_action') }}</DangerButton>
                </div>
            </div>
        </template>

        <template v-if="$page.props.auth.user.send_delete">
            <p>{{ $t('pages.profile.delete_sent_text') }}</p>
        </template>

        <Modal ref="modal" @cancel="closeModal">
            <div class="p-6">
                <h2 class="heading-xl">
                    {{ $t('pages.profile.delete_confirm') }}
                </h2>

                <p class="mt-3 text">
                    {{ $t('pages.profile.delete_confirm_text') }}
                </p>

                <div class="mt-4">
                    <InputLabel for="password" :value="$t('form.password')" class="sr-only" />

                    <TextInput
                        id="password-confirm"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        :placeholder="$t('form.password')"
                        @keyup.enter="deleteUser"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="row mt-3">
                    <div class="col-12 text-end">
                        <SecondaryButton class="btn-mit" @click="closeModal">
                            {{ $t('form.cancel') }}
                        </SecondaryButton>

                        <DangerButton
                            class="ms-3 btn-mit"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            @click="deleteUser">
                            {{ $t('pages.profile.delete_action') }}
                        </DangerButton>
                    </div>
                </div>
            </div>
        </Modal>
    </div>
</template>
