<template>
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white text-center pb-10">ФОРУМ</h1>
    <div class="max-w-7xl w-full flex">
        <MainCategories :categories="categories" @filterByCategory="filterByCategory" />
        <div class="flex-1"></div>
        <MainThemes :themes="filteredThemes" />
    </div>
</template>

<script setup>
import MainCategories from './MainCategories.vue';
import MainThemes from './MainThemes.vue';
import { ref } from 'vue';

const props = defineProps({
    themes: Array,
    categories: Array,
});

const filteredThemes = ref([...props.themes]);

const filterByCategory = (categoryId) => {
    console.log('Filtering by category ID:', categoryId);
    if (categoryId) {
        filteredThemes.value = props.themes.filter(theme => theme.category_id === categoryId);
    } else {
        filteredThemes.value = [...props.themes]; // Если категория не выбрана, показываем все темы
    }
};
</script>