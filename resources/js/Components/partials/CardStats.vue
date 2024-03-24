<template v-if="$page.props.auth">
    <div class="col">
        <div class="bg-white p-4 border-light rounded shadow">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h5 class="heading-s fw-700 mb-3">{{ $t('pages.my_stats.title') }}</h5>

                    <p>{{ $t('pages.my_stats.username_text') }}: {{ $page.props.auth.user?.username ?? $t('general.anonymous') }}</p>
                    <template v-if="stats">
                        <p class="c-grey">{{ $t('pages.my_stats.total_upload_text') }}: {{ stats?.myTotalUploads }} </p>
                        <p class="c-grey">{{ $t('pages.my_stats.validated_fossil_text') }}: {{ stats?.myValidatedUploads }}</p>
                        <p class="c-grey">{{ $t('pages.my_stats.curator_graded_fossils_text') }}: {{ stats?.myCuratedUploads }}</p>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import {usePage} from "@inertiajs/vue3";

const stats = ref(null);
const page = usePage();

onMounted(async () => {
    if(page.props.auth.user?.role !== 'admin') {
        const { data } = await axios.get(route('api.customer.user.state'));
        stats.value = data;
    }
});
</script>
