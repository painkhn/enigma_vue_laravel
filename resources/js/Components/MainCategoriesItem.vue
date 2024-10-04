
<template>
    <h2 class="main__categories-title text-red-400 font-bold text-2xl mb-2">Название</h2>
    <ul class="main__categories-list pl-3 flex flex-col gap-2 text-gray-800 dark:text-white mb-5">
        <li><a href="#!" class="transition-all hover:text-red-400">Категория</a></li>
        <li><a href="#!" class="transition-all hover:text-red-400">Категория</a></li>
        <li><a href="#!" class="transition-all hover:text-red-400">Категория</a></li>
        <li v-if="$page.props.auth.user && $page.props.auth.user.is_admin == 1">
            <input type="text" class="h-6 w-4/6 px-2 transition-all border-gray-300 focus:ring-red-400 focus:border-red-400 rounded text-sm">
        </li>
    </ul>
</template>