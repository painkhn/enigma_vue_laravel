<script setup>
    import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="main__themes w-8/12 h-auto p-10 rounded-xl bg-white dark:bg-zinc-800 shadow-xl">
        <h2 class="main__themes-title text-red-400 font-bold text-2xl mb-5">Название категории</h2>
        <ul class="main__themes-list flex flex-col gap-5 text-gray-600 dark:text-white">
            <li v-for="theme in $page.props.themes" :key="theme.id">
                <Link :href="route('themeShow', { id: theme.id })"  class="transition-all hover:text-red-400 px-4 rounded-md flex w-full bg-gray-200 py-2 text-base font-semibold hover:bg-gray-100 hover:border-l-2 hover:border-red-400">{{ theme.name }}</Link>
            </li>
        </ul>
    </div>
</template>