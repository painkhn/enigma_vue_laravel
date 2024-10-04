<script setup>
    import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="profileInfo flex gap-5">
        <img src="../../../public/img/avatar_default.jpg" alt="Аватарка" class="profileInfo__avatar max-w-40">
        <div class="profileInfo__info w-full">
            <div class="flex items-center justify-between">
                <h3 class="profileinfo__info-username uppercase text-red-400 font-bold mb-2">{{ $page.props.auth.user.name }}</h3>
                <div class="flex gap-5 items-center">
                    <Link href="/profile/edit" class="mb-2 text-gray-600 transition-all hover:text-red-400">Редактировать</Link>
                    <Link :href="route('logout')" method="post" class="mb-2 text-gray-600 transition-all hover:text-red-400">Выйти</Link>
                </div>
            </div>
            <hr class="border-gray-400 opacity-80 mb-2">
            <p class="profileInfo__info-email mb-2">{{ $page.props.auth.user.email }}</p>
            <p class="profileInfo__info-age mb-2">{{ $page.props.auth.user.age }} лет</p>
            <p class="profileInfo__info-sex mb-2">Man</p>
        </div>
    </div>
</template>