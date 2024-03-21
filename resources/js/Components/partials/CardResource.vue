<script setup>

const props = defineProps({
    resource: {type: Object},
    redirect: { type: Boolean, default: false }
})

function prevent (event) {
    if(!props.redirect) {
        event.preventDefault();
    }
}
</script>

<template>
    <div class="col-12">
        <a @click="prevent" :href="route('customer.resources.show', resource.endpoint)" class="text-decoration-none">
            <div class="resource-child border-light shadow rounded p-0 col-divider" :class="{ 'clickable': redirect }">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center p-4 gap-3 gap-sm-4 ">
                    <div class="d-flex flex-column flex-sm-row justify-content-start gap-3">
                        <img v-if="resource.image" :src="resource.image" alt="Resource" class="img-fluid">
                        <div>
                            <h5 class="text-primary">{{ resource.name }}</h5>
                            <span> {{ resource.description }} </span>
                        </div>
                    </div>
                    <slot>  </slot>
                </div>
            </div>
        </a>
    </div>
</template>
