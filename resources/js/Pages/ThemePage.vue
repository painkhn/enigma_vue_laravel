<script setup>
    import { ref, onMounted } from 'vue';
    import Header from '@/Components/Header.vue';
    import Footer from '@/Components/Footer.vue'
    import ThemeCommentList from '@/Components/ThemeCommentList.vue';
    import { Head, Link, usePage } from '@inertiajs/vue3';

    const goBack = () => {
        window.history.back();
    }

    const formatDate = (dateString) => {
        const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
        return new Date(dateString).toLocaleDateString('ru-RU', options);
    };

    
    
    // const props = defineProps(['theme']);
    // const theme = $page.props.theme;
    // onMounted(() => {
    //     console.log(123);
    // }),
</script>

<template>
    <Head :title="$page.props.theme.name" />

    <Header />

    <main>
        <div class="themesInfo max-w-6xl w-full mx-auto my-0 h-auto p-5 bg-white shadow-md mt-10 selection:bg-[#f87171] selection:text-white mb-10">
            <button @click="goBack" class="themesInfo__back text-gray-600 transition-all hover:text-red-400">Вернуться назад</button>
            <ul class="themesInfo__list flex flex-col gap-3 mt-3">
                <li>
                    <p class="text-red-400 font-semibold text-xl">{{ $page.props.theme.name }}</p>
                </li>
                <li>
                    <p class="text-gray-600 text-md">{{ $page.props.theme.content }}</p>
                </li>
                <li>
                    <p class="text-gray-400 text-sm">{{ formatDate($page.props.theme.created_at) }}</p>
                </li>
                <hr class="border">
                <li>
                    <Link :href="`/profile/${$page.props.theme.user.id}`" class="text-red-400 text font-bold">{{$page.props.theme.user.name}}</Link>
                </li>
            </ul>

            <div class="themesComments py-10 w-full h-auto">
                <form action="" class="themesComments__form flex flex-col mb-5">
                    <label for="" class="themesComments__form-label mb-1 text-gray-600 font-semibold">Введите комментарий</label>
                    <input type="text" class="themesComments__form-input placeholder:text-gray-400 mb-5 w-full h-10 transition-all border-gray-400 focus:ring-red-400 focus:border-red-400 rounded text-gray-600" placeholder="Ваш комментарий">
                    <input type="submit" value="Отправить" class="themesComments__form-submit w-full h-10 bg-red-400 text-white font-semibold transition-all hover:bg-red-300 rounded-md cursor-pointer">
                </form>

                <h2 class="themesComments__title text-red-400 text-xl font-bold text-center mb-5">Комментарии</h2>
                <ThemeCommentList />
            </div>
        </div>
    </main>
</template>