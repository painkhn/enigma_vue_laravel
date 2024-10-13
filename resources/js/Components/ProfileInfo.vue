<script setup>
    import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="profileInfo flex gap-5">
        <img src="../../../public/img/avatar_default.jpg" alt="Аватарка" class="profileInfo__avatar max-w-40">
        <div class="profileInfo__info w-full mb-2">
            <div class="flex items-center justify-between">
                <h3 class="profileinfo__info-username uppercase text-red-400 font-bold mb-2">{{ $page.props.user.name }}</h3>
                <p v-if="$page.props.user.is_admin == 1" class="font-semibold text-red-400 uppercase">Администратор</p>
                <div class="flex gap-5 items-center" v-if="$page.props.auth.user.id == $page.props.user.id">
                    <Link href="/profile/edit" class="mb-2 text-gray-600 transition-all hover:text-red-400" as="button">Редактировать</Link>
                    <Link :href="route('logout')" method="post" class="mb-2 text-gray-600 transition-all hover:text-red-400" as="button">Выйти</Link>
                </div>
            </div>
            <hr class="border-gray-400 opacity-80 mb-2">
            <p class="profileInfo__info-email mb-2">{{ $page.props.user.email }}</p>
            <p class="profileInfo__info-age mb-2">{{ $page.props.user.age }} лет</p>
            <Link :href="route('themeCreate')" class="transition-all hover:text-red-400 font-semibold" as="button" v-if="$page.props.auth.user.id == $page.props.user.id">Создать тему</Link>
        </div>
    </div>
</template>