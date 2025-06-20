<script setup>
import { computed, ref } from 'vue';
import SesionLayout from '@/Layouts/SesionLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputTextInline from "@/Components/InputTextInline.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    status: {type: String},
    username: {type: String},

});

const form = useForm({
    username: props.username,
    password: '',
});

const firstDigit = ref('');
const secondDigit = ref('');
const thirdDigit = ref('');
const fourthDigit = ref('');

const firstDigitInput = ref(null);
const secondDigitInput = ref(null);
const thirdDigitInput = ref(null);
const fourthDigitInput = ref(null);

const submit = () => {
    form.password = firstDigit.value.toString() + secondDigit.value.toString() + thirdDigit.value.toString() + fourthDigit.value.toString()
    form.password = parseInt(form.password)
    form.post(route('login'), {
        onFinish: () => {
            firstDigit.value = null
            secondDigit.value = null
            thirdDigit.value = null
            fourthDigit.value = null
        },
    });
};

const goToNextInput = (index) => {
    console.log(index, firstDigit.value)
    if (index === 'first' && firstDigit.value) {
        secondDigitInput.value.focus();
    } else if (index === 'second' && firstDigit.value) {
        thirdDigitInput.value.focus();
    } else if (index === 'third' && firstDigit.value) {
        fourthDigitInput.value.focus();
    } else if (index === 'fourth' && firstDigit.value) {
        fourthDigitInput.value.blur();
        submit();
    }
}

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <SesionLayout image="/storage/images/bg-main.webp" link="/">

        <Head :title="$t('pages.verify_email.title')" />

        <h1 class="pb-2 fw-300 fs-40">
            {{ $t('pages.confirm_register.title') }}
        </h1>

        <p class="max-w-500 text-center fw-500 text-m mb-3">
            {{ $t('pages.confirm_register.text') }}
        </p>

        <form @submit.prevent="submit" class="w-100 max-w-500 mb-0">
            <div class="d-flex justify-content-center mb-2">
                <label class="text-uppercase">
                    <span> Engangskode</span>
                </label>
            </div>
            <div class="d-flex justify-content-center gap-4">
                <input v-model="firstDigit"
                       ref="firstDigitInput"
                       @input="goToNextInput('first')"
                       class="form-control rounded one-digit"
                       type="number"
                       maxlength="1"
                       id="first_digit"
                       name="first_digit"
                       autocomplete="off">
                <input v-model="secondDigit"
                       ref="secondDigitInput"
                       @input="goToNextInput('second')"
                       class="form-control rounded one-digit"
                       type="number"
                       maxlength="1"
                       id="second_digit"
                       name="second_digit"
                       autocomplete="off">
                <input v-model="thirdDigit"
                       ref="thirdDigitInput"
                       @input="goToNextInput('third')"
                       class="form-control rounded one-digit"
                       type="number"
                       maxlength="1"
                       id="third_digit"
                       name="third_digit"
                       autocomplete="off">
                <input v-model="fourthDigit"
                       ref="fourthDigitInput"
                       @input="goToNextInput('fourth')"
                       class="form-control rounded one-digit"
                       type="number"
                       maxlength="1"
                       id="fourth_digit"
                       name="fourth_digit"
                       autocomplete="off">
            </div>
            <div class="d-flex justify-content-center">
                <InputError class="mt-2" :message="form.errors.password" />
            </div>
            <div class="d-flex justify-content-center mt-4">
                <button class="rounded text-uppercase btn-mit" type="submit">
                    {{ $t('pages.confirm_register.action') }}
                </button>
            </div>
        </form>

    </SesionLayout>
</template>
<style scoped>
.one-digit {
    width: 60px;
    height: 60px;
    background-color: #eeeeee;
    font-size: 24px;
    text-align: center;
}

.one-digit::-webkit-outer-spin-button, .one-digit::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
