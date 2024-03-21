<template>
    <div>
        <template v-if="format === 'button'">
            <button :disabled="disabled ? true : undefined"
                    class="rounded text-uppercase btn-mit"
                    :type="type"
                    :class="color">
                <slot></slot>
            </button>
        </template>
        <template v-if="format === 'link'">
            <Link :href="url ?? 'undefined'"
                  class="rounded text-uppercase btn-mit"
                  :class="color">
                <slot></slot>
            </Link>
        </template>
    </div>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    url: { type: String, required: false },
    disabled: { type: Boolean, default: false },
    className: { types: [Object, String] },
    variant: { type: String, default: 'normal' },
    type: { type: String, default: 'button' }
});

const colors = {
    normal: 'bg-green',
    light: 'bg-light-green',
    normal2: 'bg-green suggest',
    dark: 'bg-dark-green',
};

const format = computed(() => {
    return !props.url || props.disabled ? 'button' : 'link';
})

const color = computed(() => {
    let result = props.className ?? {};

    if(typeof result === 'object')
        result[ colors[props.variant] ] = true;
    else
        result += ' ' + colors[props.variant];

    return result;
})

</script>
