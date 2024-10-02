<script setup>
    import PageLogo from './PageLogo.vue';
    import { Link } from '@inertiajs/vue3';
</script>

<template>
    <header class="header w-full h-20 flex items-center justify-center shadow-xl">
        <Link href="/">
            <PageLogo />
        </Link>
    </header>
</template>