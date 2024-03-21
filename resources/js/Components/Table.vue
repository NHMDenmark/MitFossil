<template>
    <div class="d-flex flex-column flex-xl-row gap-45 align-items-start">
        <div class="col bg-white border-light shadow rounded p-3">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th v-for="th in header" :key="th.value">{{ th.label }}</th>
                        <th class="text-center" width="20%">{{ $t('components.card_table.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in (paginate ? items.data : items)" :key="item.id">
                        <td v-for="th in header" :key="th.value" v-html="getValue( th.value, item )"></td>
                        <td class="text-center">
                            <slot name="buttons" :id="item.id" :active="item.active" :item="item"></slot>
                        </td>
                    </tr>
                    <tr v-if="(paginate ? items.data.length : items.length) === 0">
                        <td class="text-center" colspan="4">{{ $t('components.card_table.not_found_admin') }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <Paginator v-if="paginate" :page="items"></Paginator>
        </div>
    </div>
</template>

<script setup>
import Paginator from "@/Components/Paginator.vue";
import {render} from "vue";

const props = defineProps({
    header: { type: Array },
    items: { types: [Array, Object] },
    paginate: { type: Boolean, default: false }
});

const getValue = (value, item) => {
    const p = value.split('.');
    const head = props.header.find( (x) => x.value === value );

    let result = '';

    if(p.length > 0) {
        let actual = item;

        for(let i in p) {
            let key = p[i];

            if(i < (p.length - 1 )) {
                actual = actual[key];
            } else {
                if(actual && actual.hasOwnProperty(key)) {
                    result = actual[key];
                } else {
                    result = '';
                }
            }
        }
    }

    if(head?.render) {
        return head.render( result );
    }

    return result;
};

</script>
