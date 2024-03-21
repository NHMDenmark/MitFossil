<template>
    <nav class="text-align-center mt-5" aria-label="Table navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item" :class="{ 'disabled': !page.first_page_url }">
                <a class="page-link" :href="page.first_page_url">{{ $t('components.paginator.first') }}</a>
            </li>
            <li v-for="(link, index) in page.links" class="page-item" :class="{ 'active': link.active }">
                <span v-if="index === 0 && !link.url" class="page-link"> <i class="fa-solid fa-chevron-left"></i> </span>
                <a v-if="index === 0 && link.url" class="page-link" :href="link.url"> <i class="fa-solid fa-chevron-left"></i> </a>

                <span v-if="index === (page.links.length -1) && !link.url" class="page-link"> <i class="fa-solid fa-chevron-right"></i> </span>
                <a v-if="index === (page.links.length -1) && link.url" class="page-link" :href="link.url"> <i class="fa-solid fa-chevron-right"></i> </a>

                <span v-if="link.active" class="page-link">
                    {{ link.label }}
                </span>

                <a v-if="link.url && !link.active && index !== 0 && index !== (page.links.length -1)" class="page-link" :href="link.url">{{ link.label }}</a>
            </li>
            <li class="page-item" :class="{ 'disabled': !page.last_page_url }">
                <a class="page-link" :href="page.last_page_url">{{ $t('components.paginator.last') }}</a>
            </li>
        </ul>
    </nav>
</template>

<script setup>

defineProps({
    page: { type: Object, required: true },
});
</script>
