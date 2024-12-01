<script setup>
    import { Link, Head } from '@inertiajs/vue3'

</script>

<template>
    <Head :title="'Вы забанены'" />

    <div class="w-full min-h-screen flex flex-col items-center justify-center">
        <p class="text-2xl dark:text-white text-black font-bold">Вы забанены</p>
        <Link :href="route('logout')" method="post" class="mb-2 text-gray-600 dark:text-white/90 transition-all dark:hover:text-red-400 hover:text-red-400" as="button">Выйти</Link>
    </div>
</template>