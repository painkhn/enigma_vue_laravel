<script setup>
    import { ref, onMounted } from 'vue';
    import Header from '@/Components/Header.vue';
    import Footer from '@/Components/Footer.vue'
    import ThemeCommentList from '@/Components/ThemeCommentList.vue';
    import CommentForm from '@/Components/CommentForm.vue';
    import { Head, Link, usePage } from '@inertiajs/vue3';
import theme from 'tailwindcss/defaultTheme';

    const goBack = () => {
        window.history.back();
    }

    const formatDate = (dateString) => {
        const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
        return new Date(dateString).toLocaleDateString('ru-RU', options);
    };

    const deleteTheme = async (themeId) => {
        try {
            const response = await axios.delete(route('delete_theme', {id: themeId}), { 
                'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
            });
            console.log('Успешно', response.data.message)
            if (response.data.redirect) {
                window.location.href = response.data.redirect;
            }
        } catch (error) {
            console.log(error, themeId)
        }
    }

    const props = defineProps({
        canLogin: {
            type: Boolean,
        },
        canRegister: {
            type: Boolean,
        },
        user: {
            type: Object,
        },
        theme: {
            type: Object
        },
        comments: {
            type: Object
        }
    });
</script>

<template>
    <Head :title="$page.props.theme.name" />

    <Header
        :canLogin="props.canLogin" 
        :canRegister="props.canRegister" 
        :user="props.user"
    />

    <main>
        <div class="themesInfo max-w-7xl rounded-md w-full mx-auto my-0 h-auto p-5 bg-white shadow-md mt-10 selection:bg-[#f87171] selection:text-white mb-10">
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
                <li>
                    <Link class="text-red-400 font-semibold" :href="`/category/${$page.props.theme.category.id}`">{{ $page.props.theme.category.name }}</Link>
                </li>
                <hr class="border">
                <li>
                    <Link :href="`/users/${$page.props.theme.user.name}`" class="text-red-400 text font-bold">{{$page.props.theme.user.name}}</Link>
                </li>
                <li>
                    <button v-if="$page.props.auth.user.is_admin == 1" @click="deleteTheme($page.props.theme.id)" class="px-5 py-2 bg-red-400 rounded-md text-white font-semibold transition-all hover:bg-red-300">
                        Удалить тему
                    </button>
                </li>
            </ul>

            <div class="themesComments py-10 w-full h-auto">
                <CommentForm :theme="theme" />

                <h2 class="themesComments__title text-red-400 text-xl font-bold text-center mb-5">Комментарии</h2>
                <ThemeCommentList :comments="comments" :theme="theme" />
            </div>
        </div>
    </main>
</template>