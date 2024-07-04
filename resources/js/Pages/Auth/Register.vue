<script setup>
import InputError from '@/Components/InputError.vue';
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import SesionLayout from "@/Layouts/SesionLayout.vue";
import InputTextInline from "@/Components/InputTextInline.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputImage from "@/Components/InputImage.vue";

const submited = ref(false);

const form = useForm({
    username: '',
    email: '',
    copyright_rule_id: 3,
    terms: false,
    usage: false,
});

const submit = () => {
    submited.value = true;

    if(form.terms && form.usage) {
        form.post(route('register'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    }
};
</script>

<template>
    <SesionLayout image="/storage/images/bg-registration.webp" link="/">
        <Head :title="$t('pages.register.title')" />

        <h1 class="pb-2 fw-300 fs-40">
            {{ $t('pages.register.title') }}
        </h1>
        <p class="max-w-500 text-center fw-500 text-m mb-0">
            {{ $t('pages.register.text') }}
        </p>

        <form @submit.prevent="submit" class="mt-5 w-100 max-w-500 mb-0">

            <div class="form-group mt-4">
                <InputTextInline name="username" v-model="form.username" :label-top="true" :label="'Brugernavn, må ikke være din e-mail'" />
                <InputError class="mt-2" :message="form.errors.username" />
            </div>

            <div class="form-group mt-4">
                <InputTextInline name="email" v-model="form.email" :label-top="true" :label="$t('form.email_2')" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="accordion accordion-flush register-accordion" id="accordionUpload">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed text-sm" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false"
                            aria-controls="flush-collapseOne">
                            {{ $t('pages.register.accordion_title') }}
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionUpload">
                        <div class="accordion-body">
                            <p class="text-xs"><b>Brugernavn og e-mailadresse</b><br>Du vælger selv dit brugernavn, så længe det overholder MitFossils regler for god adfærd og ikke er af upassende eller krænkende karakter. Det må gerne være dit eget navn, men bemærk, at dit brugernavn vises offentligt på MitFossil i tilknytning til dine fossiler, billeder og kommentarer. Undgå derfor at bruge din e-mailadresse som brugernavn. Din e-mailadresse vil blive brugt til at sende dig en engangskode for at bekræfte dine bruger. Derudover vil den udelukkende blive brugt til at sende dig meddelelser relateret til MitFossil og projektet ’Danmark Udforsker Fossiler’, som MitFossil er en del af. Din e-mailadresse bliver gemt i en database, som udelukkende administreres af Statens Naturhistoriske Museum, indtil du trækker dit samtykke tilbage og sletter din bruger fra MitFossil, hvormed din e-mailadresse også slettes.</p>
                            <p class="text-xs"><b>Brugsret</b><br>Når du lægger et fossil ind på MitFossil, bør du være opmærksom på, at dine billeder af fossiler som udgangspunkt er offentligt tilgængelige for ikke-kommercielle formål, <b>så længe der tydeligt er angivet en kilde i form af brugernavn og MitFossil</b>. Og så længe materialet benyttes i den sammenhæng, det indgår i på MitFossils platforme og i henhold til MitFossils formål. <b>Du kan selv ændre brugsrettighederne (licenserne) for dine billeder under ”Min profil”</b>. Alle funddata for fossilet, såsom fundsted og noter, er tilgængelige for ikke-kommercielle formål. <a target="_blank" href="https://mitfossil.dk/resources/om-mitfossil/regler-og-vilk%C3%A5r">Læs mere om brugsret her</a></p>
                            <p class="text-xs"><b>Persondata</b><br>Når du opretter dig som bruger af MitFossil, samtykker du til, at Statens Naturhistoriske Museum behandler visse persondata om dig. MitFossil følger EU’s regler for behandling af personoplysninger. Du kan læse mere i vores <a target="_blank" href="https://mitfossil.dk/resources/om-mitfossil/regler-og-vilk%C3%A5r">regler og vilkår for MitFossil</a>. Du kan trække dit samtykke tilbage ved at slette din bruger eller kontakte MitFossils administratorer og meddele dem dette. <a target="_blank" href="https://mitfossil.dk/resources/om-mitfossil/kontakt">Læs mere om kontakt her</a>.</p>
                            <p class="text-xs"><b>Adfærd og henvendelse fra Statens Naturhistoriske Museum</b><br>Endvidere accepterer du MitFossils <a href="https://mitfossil.dk/resources/om-mitfossil/regler-og-vilk%C3%A5r" target="_blank">regler for god adfærd.</a></p>
                            <p class="text-xs">Du accepterer, at du som bruger af MitFossil har ansvaret for, at de informationer, du leverer – efter bedste evne – er korrekte og fyldestgørende.</p>
                            <p class="text-xs">Du accepterer også, at Statens Naturhistoriske Museum, et andet museum eller en forskningsinstitution kontakter dig, hvis du har gjort et interessant fund. Dette kan f.eks. være et fossil, der kunne blive erklæret for Danekræ, eller et fossil med forskningsmæssig interesse.</p>
                            <p class="text-xs">Endelig accepterer du, at Statens Naturhistoriske Museum må henvende sig til dig i en række andre forbindelser. Det kan f.eks. være omkring emner relateret til MitFossil og projektet ’Danmark Udforsker Fossiler’ (f.eks. nyheder, ændringer i regler og vilkår, brugerundersøgelser, tilbud etc.), en forespørgsel om at få lov til at bruge et billede kommercielt, eller hvis en brugerkonto benyttes til gentagne eller grove tilfælde af uacceptabel adfærd som beskrevet i MitFossils <a target="_blank" href="https://mitfossil.dk/resources/om-mitfossil/regler-og-vilk%C3%A5r">regler for god adfærd</a>.</p>
                            <p class="text-xs">Accepter og fortsæt med brugeroprettelsen.</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="align-items-md-center mt-0 flex-column flex-md-row">
                <Checkbox name="terms"
                          v-model:checked="form.terms"
                          :label="$t('form.agree_terms')" />
                <InputError v-if="submited && !form.terms" class="d-block mt-2" :message="$t('form.agree_terms_error')" />
            </div>

            <div class="align-items-md-center flex-column flex-md-row mt-3">
                <Checkbox name="usage"
                          v-model:checked="form.usage"
                          :label="$t('form.agree_data')" />
                <InputError v-if="submited && !form.usage" class="mt-2" :message="$t('form.agree_data_error')" />
            </div>

            <div class="d-flex justify-content-center mt-5">
                <button :disabled="form.processing"
                        :class="{ 'opacity-25': form.processing }"
                        type="submit"
                        class="rounded text-uppercase btn-mit">
                    {{ $t('pages.register.action') }}
                </button>
            </div>

            <div class="mt-3 text-center">
                <p class="mb-0">{{ $t('pages.register.profile_text') }}
                    <Link :href="route('login')" class="text-decoration-underline">
                        {{ $t('pages.register.login_text') }}
                    </Link>
                </p>
            </div>
        </form>
    </SesionLayout>
</template>
