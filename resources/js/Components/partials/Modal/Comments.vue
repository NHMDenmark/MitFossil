<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from "vue";
import { usePage } from "@inertiajs/vue3";
import { addComment, deleteComment } from "@/Composables/useFossil";

const props = defineProps({
    fossil: { type: Object },
    comments: { type: Array }
})

const page = usePage();
const user = page.props.auth.user;
const comment = ref('');
const showMore = ref(false);

const getImage = (user) => {
    return user?.picture ? user.picture : '/storage/images/default.jpg';
};

const saveCommet = async () => {
    if(!comment.value || comment.value === '') return;

    const data = {
        fossil_id: props.fossil.id,
        comment: comment.value,
        _token: page.props.csrf_token,
    };

    const result = await addComment(data);

    props.comments.unshift(result);
    comment.value = '';
}

const onDeleteComment = async (data, index) => {
    const result = await deleteComment(data);

    props.comments.splice(index, 1);
}

</script>

<template>
    <div v-if="user || comments.length > 0" class="comments bg-grey-5 py-5 mt-5">
        <div class="col-12 col-lg-8">
            <h3 class="my-3 text-primary heading-s mb-3 upper-xs fw-700"> {{ $t('components.comments.title') }}</h3>
            <div v-if="user" class="comment-new mb-3">
                <div class="bg-white border-light rounded p-0 col-divider">
                    <form @submit.prevent="saveCommet" action="">
                        <div class="p-4">
                            <div class="row">
                                <div class="col">
                                    <strong class="comment-author fw-600 c-dark-green">
                                        {{ user?.username ?? $t('general.anonymous') }}
                                    </strong>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <textarea v-model="comment" class="form-control" rows="3" maxlength="500"></textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col text-end">
                                    <PrimaryButton type="submit"> {{ $t('components.comments.send') }} </PrimaryButton>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="comment-list" v-for="(item, index) in comments" :key="item">
                <div v-if="index === 0 || (index > 0 && showMore)" class="row py-3">
                    <div class="row">
                        <div class="col d-flex align-items-center">
                            <strong class="comment-author fw-600">{{ item.user.username ?? $t('general.anonymous') }}</strong>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-10">
                            <p>{{ item.comment }}</p>
                            <div class="mt-1">
                                <span class="text-s fw-600">{{ item.created_at }}</span>
                            </div>
                        </div>
                        <div v-if="user?.role === 'admin'" class="col-2 text-end">
                            <i @click="onDeleteComment(item, index)" class="fs-3 fas fa-trash cursor-pointer"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row px-4">
                <div class="text-end">
                    <PrimaryButton v-if="!showMore && comments.length > 1" @click="showMore = true"> {{ $t('components.comments.load_more') }} </PrimaryButton>
                </div>
            </div>
        </div>
    </div>
</template>
