<script setup>
    import ProfileThemesItem from './ProfileThemesItem.vue';
    import { Link } from '@inertiajs/vue3';

    import { usePage } from '@inertiajs/vue3';

    const { themes } = usePage().props;
    console.log(themes);
</script>

<template>
    <div class="profileThemes py-5 px-3">
        <h2 class="profileThemes__title text-center text-red-400 font-bold text-xl mb-2">Темы пользователя {{ $page.props.auth.user.name }}</h2>
        <ul class="profileThemes__list grid grid-cols-2 gap-2">
            <!-- <ProfileThemesItem /> -->
            <li v-for="theme in $page.props.themes" :key="theme.id">
                <Link :href="route('themeShow', { id: theme.id })"  class="transition-all hover:text-red-400 px-4 rounded-md flex w-full bg-gray-200 py-2 text-base font-semibold hover:bg-gray-100 hover:border-l-2 hover:border-red-400">{{ theme.name }}</Link>
            </li>
        </ul>
    </div>
</template>