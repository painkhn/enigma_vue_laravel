<script setup>
    import MainCategories from './MainCategories.vue';
    import MainThemes from './MainThemes.vue';
    import { ref } from 'vue';

    const props = defineProps({
        themes: Array,
        categories: Array,
    });
</script>

<template>
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white text-center pb-10">ФОРУМ</h1>
    <div class="max-w-7xl w-full flex">
        <MainCategories />
        <!-- <div class="flex-1"></div> -->
        <MainThemes />
    </div>
</template>

