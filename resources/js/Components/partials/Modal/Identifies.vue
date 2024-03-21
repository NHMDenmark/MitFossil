<script setup>
import { ref } from 'vue';
import InputCheck from "@/Components/InputCheck.vue";
import { voteUserIdentify, voteCuratorIdentify, voteScientific, voteDanekrea, getLowesTaxonomy } from '@/Composables/useFossil';
import {usePage} from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import StarVotes from "@/Components/partials/Modal/StarVotes.vue";

const props = defineProps({
    fossil: { type: Object }
});

const page = usePage();
const user = page.props.auth.user;
const { t } = useI18n();

const scope = ref({
    showVotes: -1
});

async function onInputCustomer(checked, item, index) {
    const data = {
        user_id: user.id,
        id: item.id,
        vote: checked,
        _token: page.props.csrf_token,
    };

    const result = await voteUserIdentify(data);

    props.fossil.validated_fossil = result.validated_fossil;
    props.fossil.fossil_identifies[index].vote_user = result.vote_user;
    props.fossil.fossil_identifies[index].vote_users_json = result.vote_users_json;
    //props.fossil.vote_scientific = result.vote_scientific;

    if(result.principal) {
        props.fossil.fossil_identify = result;
        props.fossil.fossil_identify_id = result.id;

        for(let i = 0; i < props.fossil.fossil_identifies.length; i++) {
            if(props.fossil.fossil_identifies[i].id !== result.id) {
                props.fossil.fossil_identifies[i].vote_curator = false;
            }
        }
    }

    if(checked) {
        const data = props.fossil.fossil_identifies[index].vote_data;
        if(data?.users) {
            data.users.push({ name: user.name, username: user.username, email: user.email })
        } else {
            props.fossil.fossil_identifies[index].vote_data = {
                id: item.id,
                users: [ { name: user.name, username: user.username, email: user.email } ]
            }
        }
    } else {
        const u_index = props.fossil.fossil_identifies[index].vote_data.users.indexOf( (x) => x.id === user.id );

        props.fossil.fossil_identifies[index].vote_data.users.splice( u_index, 1 );
    }

    if(result.unvoted_id) {
        for(let i = 0; i < props.fossil.fossil_identifies.length; i++) {
            if(props.fossil.fossil_identifies[i].id === result.unvoted_id) {
                props.fossil.fossil_identifies[i].vote_user = result.unvoted_count;
                props.fossil.fossil_identifies[i].vote_users_json = result.unvoted_json;

                const u_index = props.fossil.fossil_identifies[i].vote_data.users.indexOf( (x) => x.id === result.unvoted_id );

                props.fossil.fossil_identifies[i].vote_data.users.splice( u_index, 1 );
            }
        }
    }
}
async function onInputCurator(checked, item, index) {
    const data = {
        user_id: user.id,
        id: item.id,
        vote: checked,
        _token: page.props.csrf_token,
    };
    
    const result = await voteCuratorIdentify(data);
    
    props.fossil.fossil_identifies[index].vote_curator = result.vote_curator;
    props.fossil.fossil_identifies[index].vote_curator_id = result.vote_curator_id;
    props.fossil.fossil_identifies[index].vote_curator_user = result.vote_curator_user;

    props.fossil.vote_curator = result.fossil_vote_curator ?? false;
    //props.fossil.vote_scientific = result.vote_scientific;

    if(result.principal) {
        props.fossil.fossil_identify = result;
        props.fossil.fossil_identify_id = result.id;

        for(let i = 0; i < props.fossil.fossil_identifies.length; i++) {
            if(props.fossil.fossil_identifies[i].id !== result.id) {
                props.fossil.fossil_identifies[i].vote_curator = false;
            }
        }
    } else if(result.principal_item) {
        props.fossil.fossil_identify = result.principal_item;
        props.fossil.fossil_identify_id = result.principal_item.id;
    }
}

async function onInputScientific(checked) {
    const data = {
        user_id: user.id,
        id: props.fossil.id,
        vote: checked,
        _token: page.props.csrf_token,
    };

    const result = await voteScientific(data);
    props.fossil.vote_scientific = result.vote_scientific;
    props.fossil.vote_curator = result.vote_curator;
    props.fossil.vote_scientific_user = result.vote_scientific_user;
    props.fossil.vote_scientific_date = result.vote_scientific_date;
    
}

async function onInputDanekrae(checked, item, index) {
    const data = {
        user_id: user.id,
        id: props.fossil.id,
        vote: checked,
        _token: page.props.csrf_token,
    };

    const result = await voteDanekrea(data);
    props.fossil.vote_danekrae = result.vote_danekrae;
}

function getVoteUser( item ) {
    
    if(item.vote_users_json) {
        let votes = item.vote_users_json;

        if(typeof votes === 'string') {
            votes = JSON.parse(item.vote_users_json);
        }

        if(votes && votes.includes( page.props.auth.user.id )) {
            return undefined;
        }
    }

    return null;
}
function getVoteCurator( item ) {
    return item.vote_curator ? undefined : null;
}
function getVoteScientific() {
    return props.fossil.vote_scientific ? undefined : null;
}
function getVoteDanekrae() {
    return props.fossil.vote_danekrae ? undefined : null;
}

function hasIdentify(item) {
    if(item === null || item === undefined) return false;

    return (item.fossil_kingdom !== null && item.fossil_kingdom !== t('form.unknown')) ||
    (item.fossil_phylum !== null && item.fossil_phylum !== t('form.unknown')) ||
    (item.fossil_common !== null && item.fossil_common !== t('form.unknown')) ||
    (item.fossil_class !== null && item.fossil_class !== t('form.unknown')) ||
    (item.fossil_order !== null && item.fossil_order !== t('form.unknown')) ||
    (item.fossil_family !== null && item.fossil_family !== t('form.unknown')) ||
    (item.fossil_genre !== null && item.fossil_genre !== t('form.unknown')) ||
    (item.specific_epithet !== null && item.specific_epithet !== t('form.unknown'));
}
</script>

<template>
    <div v-if="user && (user.role === 'curator' || user.role === 'admin')" class="py-3 mt-3">
        
        <div class="d-flex">
            <!--<div v-if="user.role === 'curator' && (fossil.validated_fossil || fossil.vote_curator)" class="me-3">-->
            <div v-if="user.role === 'curator'" class="me-3">
                <span class="d-block text-uppercase pb-2">{{ $t('components.identifies.vote_scientific') }}</span>
                <InputCheck @input="onInputScientific($event)" id="voteScientific" :value="getVoteScientific()">
                    {{ $t('components.identifies.agree') }}
                </InputCheck>
            </div>
            <div v-if="user.role === 'admin'"> <!-- ONLY USER ADMIN  -->
                <span class="d-block text-uppercase pb-2">{{ $t('components.identifies.vote_danek') }}</span>
                <InputCheck @input="onInputDanekrae($event)" id="voteDanekrae" :value="getVoteDanekrae()">
                    {{ $t('components.identifies.agree') }}
                </InputCheck>
            </div>
        </div>
    </div>
    <div v-for="(item, index) in fossil.fossil_identifies" :key="item.id" class="row mt-3 mb-3">
        <div v-if="hasIdentify(item)" class="col card-container">
            <div class="card">
                <div class="card-body p-0">
                    <div class="card-suggestion row mx-0 align-items-center">
                        <div class="card-stars col-3  text-m p-3 d-flex">
                            <StarVotes :fossil="fossil" :identify="item"></StarVotes>
                        </div>
                        <div class="card-description p-3">
                            <h4 class="title heading-s d-flex"><span>{{ item.fossil_common }}</span> <span v-html="getLowesTaxonomy(item, $t('form.unknown'))"></span></h4>
                            <div class="meta divider-right-dash d-flex flex-wrap">
                                <span class="author">{{ $t('components.identifies.author') }}: <strong>{{ item.user.username ?? $t('general.anonymous') }}</strong></span>
                                <span class="date">{{item.created_at}}</span>
                            </div>
                        </div>
                        <div class="card-votes d-flex p-3 flex-column gap-2">
                            <div v-if="user">
                                <div class="d-flex justify-content-end align-items-center gap-2 flex-wrap">
                                    <span class="d-block">{{ $t('components.identifies.is_species') }}</span>
                                    <InputCheck @input="onInputCustomer($event, item, index)" :id="'voteUser-' + item.id" :value="getVoteUser(item)">
                                        {{ $t('components.identifies.agree') }}
                                    </InputCheck>
                                </div>
                            </div>
                            <div v-if="user && user.role === 'curator'">
                                <div class="d-flex justify-content-end align-items-center gap-2 flex-wrap">
                                    <span class="d-block">{{ $t('components.identifies.vote_expert') }}</span>
                                    <InputCheck @input="onInputCurator($event, item, index)"
                                                :id="'voteExpert-' + item.id"
                                                :value="getVoteCurator(item)"
                                                :disabled="item.vote_curator && item.vote_curator_id !== user.id">
                                        {{ $t('components.identifies.agree') }}
                                    </InputCheck>
                                </div>
                            </div>

                            <div class="gap-1 d-flex flex-column justify-content-end">
                                <div v-if="getVoteCurator(item) !== null" class="text-end">
                                    {{ $t('components.identifies.expert_validation') }}
                                    <strong> {{ item.vote_curator_user.username ?? $t('general.anonymous') }} </strong> -
                                    <span class="date">{{ item.vote_curator_date }}</span>
                                </div>
                                <div v-if="fossil.vote_scientific && fossil.fossil_identify_id === item.id" class="text-end">
                                    {{ $t('components.identifies.scientific_validation') }}
                                    <strong> {{ fossil.vote_scientific_user?.username ?? $t('general.anonymous') }} </strong> -
                                    <span class="date">{{ fossil.vote_scientific_date }}</span>
                                </div>
                            </div>
                        </div>
                        <div @mouseenter="scope.showVotes = item.id" @mouseleave="scope.showVotes = -1" class="card-user-vote bg-green p-3">
                            <h5 class="fw-700 c-white m-0">{{ item.vote_user }}/5</h5>
                            <span class="text-s c-white">
                                {{ $t('components.identifies.points') }}
                            </span>
                        </div>
                    </div>
                </div>
                <div v-if="scope.showVotes === item.id && item.vote_user > 0" @mouseenter="scope.showVotes = item.id" @mouseleave="scope.showVotes = -1" class="card card-votes-dropdown">
                    <div class="card-body">
                        <template v-if="item.vote_data">
                            <div v-for="(item, index) in item.vote_data.users" :key="index" class="d-block">
                                {{ item.username ?? $t('general.anonymous') }}
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
