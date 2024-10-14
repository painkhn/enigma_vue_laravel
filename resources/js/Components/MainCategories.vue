<template>
    <div class="flex w-3/12 flex-col">
        <div class="main__categories w-full bg-white dark:bg-zinc-800 p-10 rounded-xl shadow-xl">
            <MainCategoriesItem :categories="categories" @filterByCategory="emitFilterByCategory" />
        </div>
        <div class="main__users mt-4 w-full">
            <h2 class="text-center mb-4 text-red-400 font-bold text-lg">Пользователи</h2>
            <ul class="main__users-list flex flex-col gap-3 w-full">
                <li class="w-full h-auto" v-for="user in $page.props.users" :key="user.id">
                    <Link class="px-5 py-2 text-red-400 border-2 text-md uppercase border-red-400 transition-all hover:bg-red-400 hover:text-white rounded-md font-semibold flex" :href="`/users/${user.name}`">{{ user.name }}</Link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import MainCategoriesItem from '@/Components/MainCategoriesItem.vue';
import { defineProps, defineEmits } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    categories: Array,
});

const emit = defineEmits(['filterByCategory']);

const emitFilterByCategory = (categoryId) => {
    emit('filterByCategory', categoryId);
};
</script>