<script setup>
    import Header from '@/Components/Header.vue';
    import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head :title="'Профиль'" />

    <Header />

    <div class="max-w-6xl h-auto p-5 mx-auto my-0 bg-white shadow-md mt-10">
        <div class="profileInfo">
            <img src="/@/public/img/avatar_default.jpg" alt="Аватарка" class="profileInfo__avatar">
        </div>
    </div>
</template>