<script setup>
    import Header from '@/Components/Header.vue';
    import ThemeCommentList from '@/Components/ThemeCommentList.vue';
    import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head :title="'Тема'" />

    <Header />

    <main>
        <div class="themesInfo max-w-6xl w-full mx-auto my-0 h-auto p-5 bg-white shadow-md mt-10 selection:bg-[#f87171] selection:text-white">
            <Link href="/" class="themesInfo__back text-gray-600 transition-all hover:text-red-400">Вернуться назад</Link>
            <ul class="themesInfo__list flex flex-col gap-3 mt-3">
                <li>
                    <p class="text-red-400 font-semibold text-xl">Название темы</p>
                </li>
                <li>
                    <p class="text-gray-600 text-md">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Adipisci dolore distinctio iure maxime reiciendis eum maiores expedita sint cum odio! Nostrum itaque ipsa sequi suscipit, nihil provident vel hic illum. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius earum pariatur quasi sit beatae, doloribus expedita quis cupiditate assumenda dolorum ipsum quam ad quidem reprehenderit eveniet ex repellendus enim dolore? Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore perferendis, sapiente fuga quam hic nihil necessitatibus qui? Necessitatibus ipsum magnam cupiditate aperiam, beatae molestias fuga quam voluptatem corporis natus est.</p>
                </li>
                <li>
                    <p class="text-gray-400 text-sm">01.01.2024</p>
                </li>
                <hr class="border">
                <li>
                    <Link href="/profile" class="text-red-400 text font-bold">Username</Link>
                </li>
            </ul>

            <div class="themesComments py-10 w-full h-auto">
                <h2 class="themesComments__title text-red-400 text-xl font-bold text-center mb-5">Комментарии</h2>
                <ThemeCommentList />
            </div>
        </div>
    </main>
</template>