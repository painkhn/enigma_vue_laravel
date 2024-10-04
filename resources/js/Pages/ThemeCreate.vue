<script setup>
    import { Head } from '@inertiajs/vue3'
    import Header from '@/Components/Header.vue'
    import Footer from '@/Components/Footer.vue'
</script>

<template>
    <Head :title="'Создать тему'" />

    <Header />

    <main class="selection:bg-[#f87171] selection:text-white">
        <div class="max-w-6xl w-full h-auto bg-white mx-auto my-0 p-10 shadow-md mt-10 rounded-md">
            <h1 class="themeCreate__title text-red-400 text-xl font-bold text-center mb-5">Создать тему</h1>
            <form action="" class="themeCreate__form flex flex-col gap-3">
                <div class="themeCreate__form-item flex flex-col gap-1">
                    <label for="" class="themeCreate__form-label text-red-400 font-semibold">Название темы</label>
                    <input placeholder="Введите название темы" type="text" class="text-gray-600 placeholder:text-gray-300 themeCreate__form-input outline-none h-8 rounded border-gray-300 border transition-all focus:border-red-400 focus:ring-red-400">
                </div>
                <div class="themeCreate__form-item flex flex-col gap-1">
                    <label for="" class="themeCreate__form-label text-red-400 font-semibold">Категория</label>
                    <select name="" id="" class="text-gray-600 outline-none h-10 rounded border-gray-300 border transition-all focus:border-red-400 focus:ring-red-400 text-sm">
                        <option value="">Игровые новости</option>
                        <option value="">Разработка игр</option>
                        <option value="">Блог</option>
                    </select>
                </div>
                <div class="themeCreate__form-item flex flex-col gap-1">
                    <label for="" class="themeCreate__form-label text-red-400 font-semibold">Контент</label>
                    <textarea placeholder="Введите контент темы" name="" id="" class="text-gray-600 placeholder:text-gray-300 w-full h-40 rounded border-gray-300 border transition-all focus:border-red-400 focus:ring-red-400"></textarea>
                </div>
                <input type="submit" value="Создать" class="w-full h-10 bg-red-400 text-white font-semibold rounded-md hover:bg-red-300 transition-all cursor-pointer">
            </form>
        </div>
    </main>

    <Footer />
</template>