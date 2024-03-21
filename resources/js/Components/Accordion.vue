<script setup>
defineProps({
    items: { type: Array }
})
</script>

<template>
    <div class="accordion accordion-flush" id="accordionUpload">
        <div v-for="(item, index) in items" :key="index" class="accordion-item">
            <h2 class="accordion-header" :id="'flush-heading-' + (index + 1) ">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    :data-bs-target="'#flush-collapse-' + (index + 1)" aria-expanded="false"
                    :aria-controls="'flush-collapse-' + (index + 1)">
                    {{ item.title }}
                </button>
            </h2>
            <div :id="'flush-collapse-' + (index + 1)" class="accordion-collapse collapse"
                :aria-labelledby="'flush-heading-' + (index + 1)" data-bs-parent="#accordionUpload">
                <div class="accordion-body">
                    <span v-html="item.text"></span>
                </div>
            </div>
        </div>
    </div>
</template>
