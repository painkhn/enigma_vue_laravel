<script setup>
    import ProfileThemesItem from './ProfileThemesItem.vue';
</script>

<template>
    <div class="profileThemes py-5 px-3">
        <h2 class="profileThemes__title text-center text-red-400 font-bold text-xl mb-2">Темы пользователя {{ $page.props.auth.user.name }}</h2>
        <ul class="profileThemes__list grid grid-cols-2 gap-2">
            <ProfileThemesItem />
            <ProfileThemesItem />
            <ProfileThemesItem />
            <ProfileThemesItem />
            <ProfileThemesItem />
            <ProfileThemesItem />
        </ul>
    </div>
</template>