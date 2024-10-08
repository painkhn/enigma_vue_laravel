<script setup>
    import { Link } from '@inertiajs/vue3';
    import { usePage } from '@inertiajs/vue3';

    const { themes } = usePage().props;
    console.log(themes);
</script>

<template>
    <li v-for="theme in $page.props.themes" :key="theme.id">
        <Link :href="route('themeShow', { id: theme.id })"  class="transition-all hover:text-red-400 px-4 rounded-md flex w-full bg-gray-200 py-2 text-base font-semibold hover:bg-gray-100 hover:border-l-2 hover:border-red-400">{{ theme.name }}</Link>
    </li>
</template>