<script setup>
    import PageLogo from './PageLogo.vue';
    import { Link } from '@inertiajs/vue3';
</script>

<template>
    <header class="header w-full h-32 flex items-center justify-center shadow-xl flex-col gap-2 rounded-md bg-white">
        <Link href="/">
            <PageLogo />
        </Link>
        <Link v-if="$page.props.auth.user.is_admin == 1" class="header__admin-link transition-all hover:text-red-400 font-medium">
            Панель администратора
        </Link>
    </header>
</template>