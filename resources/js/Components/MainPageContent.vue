<script setup>
    import MainCategories from './MainCategories.vue';
    import MainThemes from './MainThemes.vue';
</script>

<template>
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white text-center pb-10">ФОРУМ</h1>
    <div class="max-w-6xl w-full flex">
        <MainCategories />
        <div class="flex-1"></div>
        <MainThemes />
    </div>
</template>