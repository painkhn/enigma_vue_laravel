<script setup>
    import Header from '@/Components/Header.vue';
    import { Head } from '@inertiajs/vue3';
    import ProfileInfo from '@/Components/ProfileInfo.vue';
</script>

<template>
    <Head :title="'Профиль'" />

    <Header />

    <div class="max-w-6xl h-auto p-5 mx-auto my-0 bg-white shadow-lg mt-10">
        <ProfileInfo />
        <hr class="border border-red-400">
    </div>
</template>