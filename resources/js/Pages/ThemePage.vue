<script setup>
    import { ref, onMounted } from 'vue';
    import Header from '@/Components/Header.vue';
    import Footer from '@/Components/Footer.vue'
    import ThemeCommentList from '@/Components/ThemeCommentList.vue';
    import CommentForm from '@/Components/CommentForm.vue';
    import { Head, Link, usePage } from '@inertiajs/vue3';
    import ComplaintForm from '@/Components/ComplaintForm.vue';

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

    const title = ref('');
    const content = ref('');

    const updateTheme = async (themeId) => {
        try {
            const response = await axios.patch(
            route('update_theme', { id: themeId }),
                {
                    title: title.value,
                    content: content.value,
                    // 'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                }
            );
            location.reload()

            console.log('Успешно', response.data.message);
        } catch (error) {
            console.log(error, themeId);
        }
    };

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
        },
        complaint: {
            type: Object
        },
    });

    const complainIsVisible = ref(false)

    const complaintOpen = () => {
        const compForm = document.getElementById('complaintForm')

        // compForm.classList.remove('hidden')
        complainIsVisible.value = !complainIsVisible.value
    }

    const downloadTheme = (themeId) => {
        window.open(route('download_theme', { id: themeId }), '_blank');
    }

    const themeEditIsVisible = ref(false)

    const themeEditOpen = () => {
        themeEditIsVisible.value = !themeEditIsVisible.value
    }

    const copyContent = async () => {
        try {
            const textElement = document.querySelector('.textForCopy');
            if (textElement) {
                const text = textElement.textContent;
                await navigator.clipboard.writeText(text);
                alert('Текст успешно скопирован')
                console.log('Content copied to clipboard');
            } else {
                console.error('Text element not found');
            }
        } catch (err) {
            console.error('Failed to copy: ', err);
        }
    }

    onMounted(() => {
        console.log('Comments:', props.comments);
    })
</script>

<template>
    <Head :title="$page.props.theme.name" />

    <Header
        :canLogin="props.canLogin" 
        :canRegister="props.canRegister" 
        :user="props.user"
    />

    <main>
        <div class="themesInfo max-w-7xl rounded-xl w-full mx-auto my-0 h-auto p-5 bg-white border border-slate-200 mt-10 selection:bg-[#f87171] selection:text-white mb-10">
            <button @click="goBack" class="themesInfo__back text-gray-600 transition-all hover:text-red-400">Вернуться назад</button>
            <ul class="themesInfo__list flex flex-col gap-3 mt-3">
                <li class="mb-2">
                    <p @click="copyContent()" class="textForCopy text-red-400 font-semibold transition-all text-xl w-full py-2 px-4 bg-slate-100 rounded cursor-pointer hover:border-l-2 hover:border-red-400">{{ $page.props.theme.name }}</p>
                </li>
                <li class="mb-4">
                    <p class="text-gray-600 text-md text-lg">{{ $page.props.theme.content }}</p>
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
                    <button @click="complaintOpen" class="px-5 py-2 bg-red-400 rounded-md text-white font-semibold transition-all hover:bg-red-300">Пожаловаться</button>
                </li>
                <li v-if="complainIsVisible">
                    <ComplaintForm id="complaintForm" :complaint="props.complaint" :theme="props.theme" />
                </li>
                <li>
                    <button @click="themeEditOpen" class="px-5 py-2 bg-red-400 rounded-md text-white font-semibold transition-all hover:bg-red-300">
                        Редактировать тему
                    </button>
                </li>
                <li v-if="themeEditIsVisible">
                    <form action="" @submit.prevent="updateTheme(theme.id, $event)">
                        <label for="font-semibold font-gray-600">Редактировать тему</label>
                        <input v-model="title" placeholder="Название темы" type="text" class="w-full mt-1 h-10 mb-2 placeholder:text-gray-300 border-gray-400 outline-none transition-all rounded focus:ring-red-400 focus:border-red-400">
                        <!-- <input placeholder="Контент" type="text" class="w-full h-10 mb-2 outline-none transition-all rounded focus:ring-red-400 focus:border-red-400"> -->
                        <textarea v-model="content" name="" id="" placeholder="Контент" class="text-gray-600 placeholder:text-gray-300 w-full h-40 rounded border-gray-400 border transition-all focus:border-red-400 focus:ring-red-400">

                        </textarea>
                        <button type="submit" class="w-full h-10 font-semibold bg-red-400 rounded-md transition-all hover:bg-red-300 text-white">Отправить</button>
                    </form>
                </li>
                <li>
                    <button v-if="$page.props.auth.user.is_admin == 1" @click="deleteTheme($page.props.theme.id)" class="px-5 py-2 bg-red-400 rounded-md text-white font-semibold transition-all hover:bg-red-300">
                        Удалить тему
                    </button>
                </li>
                <li>
                    <button @click="downloadTheme($page.props.theme.id)" class="px-5 py-2 bg-red-400 rounded-md text-white font-semibold transition-all hover:bg-red-300">
                        Скачать тему
                    </button>
                </li>
            </ul>

            <div class="themesComments py-10 w-full h-auto">
                <CommentForm :theme="props.theme" />

                <h2 class="themesComments__title text-red-400 text-xl font-bold text-center mb-5">Комментарии</h2>
                <ThemeCommentList :comments="props.comments"  />
            </div>
        </div>
    </main>
</template>