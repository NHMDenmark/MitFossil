<script setup>
import { computed, ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: { type: String, required: true },
    active: { type: Boolean },
    method: { type: String },
    as: { type: String },
});

const classes = computed(() =>
    props.active
        ? 'nav-link active'
        : 'nav-link'
);

const open = ref( props.active );

function onClick() {
    open.value = !open.value;
}
</script>

<template>
    <li class="nav-item">
        <template v-if="!$slots.submenu">
            <Link
                  class="nav-link"
                  :method="method"
                  :href="href"
                  :class="{ active: active }" :aria-current="active ? 'page' : undefined" :as="as">
                <slot />
            </Link>
        </template>
        <template v-if="$slots.submenu">
            <span class="nav-link" :class="{ active: active }" @click="onClick">
                <slot />
            </span>
            <ul v-if="$slots.submenu" class="sub-menu" :class="{ active: open }">
                <slot name="submenu"></slot>
            </ul>
        </template>
    </li>
</template>

<style scoped>
button {
    background: transparent;
    border: none;
    box-shadow: none;
    width: 100%;
}

span.nav-link {
    cursor: pointer;
}
</style>
