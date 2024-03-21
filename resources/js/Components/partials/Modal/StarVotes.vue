<script setup>
import IconStar from "@/Components/Icons/IconStar.vue";
import {computed} from "vue";

const props = defineProps({
    identify: { type: Object },
    fossil: { type: Object },
    showBig: { type: Boolean, default: false }
});

const hasStar = computed(() => {
    if(!props.showBig) return false;

    return (props.fossil.validated_fossil) ||
        (props.identify.vote_curator) ||
        (props.fossil.vote_scientific && props.identify.id === props.fossil.fossil_identify_id) ||
        (props.fossil.vote_danekrae);
});

const numerStar = computed(() => {
    let result = 0; 

    if((props.fossil.validated_fossil && props.identify.vote_user >= 5)) {
        result++;
    }

    if(props.identify.vote_curator) {
        result++;
    }

    if(props.fossil.vote_scientific && props.identify.id === props.fossil.fossil_identify_id){
        result++;
    }

    if(!((props.fossil.validated_fossil && props.identify.vote_user >= 5)) && ((props.identify.vote_curator))){
        result++;
    }

    return result;
});

</script>

<template>
    <div v-if="identify" class="d-inline" :class="{ 'divider-left-dash': hasStar }">
        <IconStar v-if="!showBig || numerStar >= 1" class="d-inline-flex me-1 c-green" :type="numerStar >= 1 ? 'full' : 'empty'"></IconStar>
        <IconStar v-if="!showBig || numerStar >= 2" class="d-inline-flex me-1 c-green" :type="numerStar >= 2 ? 'full' : 'empty'"></IconStar>
        <IconStar v-if="!showBig || numerStar >= 3" class="d-inline-flex me-1 c-green" :type="numerStar >= 3 ? 'full' : 'empty'"></IconStar>
        <IconStar v-if="showBig && fossil.vote_danekrae" class="d-inline-flex me-1 c-light-green" :type="fossil.vote_danekrae ? 'full' : 'empty'"></IconStar>
    </div>
</template>
