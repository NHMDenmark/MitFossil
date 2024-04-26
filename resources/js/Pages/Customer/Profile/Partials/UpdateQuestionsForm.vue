<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from "@/Components/SelectInput.vue";
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputTextInline from "@/Components/InputTextInline.vue";

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const props = defineProps({
    questions: { type: Object }
})

const form = useForm({
    first: props.questions ? props.questions[1] : null,
    second: props.questions ? props.questions[2] : null,
    third: props.questions ? props.questions[3] : null
});

</script>

<template>
    <div class="p-4">
        <h5 class="heading-s fw-700 mb-3">{{ $t('pages.profile.update_questions') }}</h5>
        <form @submit.prevent="form.post(route('customer.questions.update'))" class="mt-4 w-100 mb-4">
            <div class="row space-y-4">
                <div class="mb-4">
                    <InputTextInline :labelTop="true" name="first" v-model="form.first" :label="$t('form.question_first')" />
                    <InputError class="mt-2" :message="form.errors.first" />
                </div>
                <div class="mb-4">
                    <InputTextInline :labelTop="true" name="second" v-model="form.second" :label="$t('form.question_second')" />
                    <InputError class="mt-2" :message="form.errors.second" />
                </div>
                <div class="">
                    <InputTextInline :labelTop="true" name="third" v-model="form.third" :label="$t('form.question_third')" />
                    <InputError class="mt-2" :message="form.errors.third" />
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
