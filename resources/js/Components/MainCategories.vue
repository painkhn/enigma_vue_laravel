<script setup>
    import MainCategoriesItem from '@/Components/MainCategoriesItem.vue';
    import { defineProps, defineEmits } from 'vue';
    import { Link } from '@inertiajs/vue3';

    const props = defineProps({
        categories: Array,
    });
</script>

<template>
    <div class="flex w-4/12 flex-col">
        <div class="main__categories w-full dark:border-zinc-900 bg-white dark:bg-zinc-700 p-8 rounded-l-xl border-l border-t border-b border-slate-200">
            <MainCategoriesItem />
        </div>
        <div class="main__users mt-4 w-full px-5">
            <h2 class="text-center mb-4 text-red-400 font-bold text-lg">Пользователи</h2>
            <ul class="main__users-list flex flex-col gap-3 w-full">
                <li class="w-full h-auto" v-for="user in $page.props.users" :key="user.id">
                    <Link class="px-5 py-2 text-red-400 border-2 text-md uppercase border-red-400 transition-all hover:bg-red-400 hover:text-white rounded-md font-semibold flex" :href="`/users/${user.name}`">{{ user.name }}</Link>
                </li>
            </ul>
        </div>
    </div>
</template>