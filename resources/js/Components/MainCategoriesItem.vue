<template>
    <h2 class="main__categories-title text-red-400 font-bold text-2xl mb-5">Категории</h2>
    <ul class="main__categories-list flex flex-col gap-2 text-gray-800 dark:text-white mb-5">
        <li v-for="category in $page.props.categories" :key="category.id" class="mb-4"><a href="#!" class="transition-all hover:text-red-400 font-medium p-2 bg-gray-100 rounded-md hover:border-l-2 hover:border-red-400">{{ category.name }}</a></li>
        <li v-if="$page.props.auth.user && $page.props.auth.user.is_admin == 1">
            <input type="text" class="h-6 w-4/6 px-2 transition-all border-gray-300 focus:ring-red-400 focus:border-red-400 rounded text-sm">
        </li>
    </ul>
</template>