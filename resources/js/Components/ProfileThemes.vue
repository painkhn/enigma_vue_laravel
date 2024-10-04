<script setup>
    import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="profileThemes py-5 px-3">
        <h2 class="profileThemes__title text-center text-red-400 font-bold text-xl mb-2">Темы пользователя</h2>
        <ul class="profileThemes__list flex flex-col gap-2">
            <li class="bg-gray-200 hover:bg-gray-100 transition-all rounded">
                <Link href="/theme" class="profileThemes__list-link text-gray-800 transition-all hover:text-red-400 text-lg w-full flex px-3 py-2">название темы</Link>
            </li>
            <li class="bg-gray-200 hover:bg-gray-100 transition-all rounded">
                <Link href="/theme" class="profileThemes__list-link text-gray-800 transition-all hover:text-red-400 text-lg w-full flex px-3 py-2">название темы</Link>
            </li>
            <li class="bg-gray-200 hover:bg-gray-100 transition-all rounded">
                <Link href="/theme" class="profileThemes__list-link text-gray-800 transition-all hover:text-red-400 text-lg w-full flex px-3 py-2">название темы</Link>
            </li>
        </ul>
    </div>
</template>