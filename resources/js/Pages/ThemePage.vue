<script setup>
    import { ref, onMounted } from 'vue';
    import Header from '@/Components/Header.vue';
    import Footer from '@/Components/Footer.vue'
    import ThemeCommentList from '@/Components/ThemeCommentList.vue';
    import CommentForm from '@/Components/CommentForm.vue';
    import { Head, Link, usePage } from '@inertiajs/vue3';
    import ComplaintForm from '@/Components/ComplaintForm.vue';
    import DeleteTheme from '@/Components/DeleteTheme.vue';

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
        views_count: {
            type: Number
        },
        likes_count: {
            type: Number
        },
        is_liked: {
            type: Boolean
        }
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

    const isFavorite = ref(props.is_liked); 

    const addLike = async () => {
        try {
            const response = await axios.post(route('new_like', { theme_id: props.theme.id }), {
                user_id: props.user.id
            })

            isFavorite.value = response.data.liked;
            props.likes_count = response.data.likes_count;

            // isFavorite.value = !isFavorite.value

            console.log(isFavorite.value)

            console.log('Лайк поставился успешно')

            location.reload()
        } catch (err) {
            console.log('Не удалось поставить лайк', err)
        }
    }

    const isDeleteVisible = ref(false)
    const selectedTheme = ref(null)

    const deleteVisibleChange = (theme) => {
        selectedTheme.value = theme
        isDeleteVisible.value = !isDeleteVisible.value
    }

    const handleDelete = (themeId) => {
        deleteTheme(themeId)
        isDeleteVisible.value = false
    }

    const handleCancel = () => {
        isDeleteVisible.value = false
    }

    onMounted(() => {
        console.log('Рез:', props.theme.id);

        const newView = async () => {
            try {
                const response = await axios.post(route('new_view', { theme_id: props.theme.id }), {
                    user_id: props.user.id
                });

                console.log('View recorded successfully:', response.data);
            } catch (error) {
                console.error('Error recording view:', error);
            }
        };

        newView();
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
        <!-- <p class="text-xl text-blue-500">{{ $page.props.user_id }}</p> -->
        <div class="themesInfo max-w-7xl rounded-xl w-full mx-auto my-0 h-auto p-5 dark:bg-zinc-700 dark:border-zinc-900 bg-white border border-slate-200 mt-10 selection:bg-[#f87171] selection:text-white mb-10">
            <button @click="goBack" class="themesInfo__back dark:text-white/80 dark:hover:text-red-400 text-gray-600 transition-all hover:text-red-400">Вернуться назад</button>
            <ul class="themesInfo__list flex flex-col gap-3 mt-3">
                <li class="mb-2">
                    <p @click="copyContent()" class="textForCopy text-red-400 font-semibold transition-all text-xl w-full py-2 px-4 bg-slate-100 dark:bg-zinc-500 dark:text-white/80 dark:hover:text-red-400 rounded cursor-pointer hover:border-l-2 hover:border-red-400">{{ $page.props.theme.name }}</p>
                </li>
                <li class="mb-4">
                    <p class="text-gray-600 text-md text-lg dark:text-white/90">{{ $page.props.theme.content }}</p>
                </li>
                <li>
                    <p class="text-gray-400 text-sm">{{ formatDate($page.props.theme.created_at) }}</p>
                </li>
                <li>
                    <Link class="text-red-400 transition-all font-semibold dark:hover:text-white/90" :href="`/category/${$page.props.theme.category.id}`">{{ $page.props.theme.category.name }}</Link>
                </li>
                <hr class="border">
                <li>
                    <Link :href="`/users/${$page.props.theme.user.name}`" class="text-red-400 text font-bold transition-all dark:hover:text-white/90">{{$page.props.theme.user.name}}</Link>
                </li>
                <li>
                    <p class="text-gray-400 text-sm">Просмотры: {{ props.views_count }}</p>
                </li>
                <li class="flex items-center gap-2">
                    
                    <button @click="addLike" v-if="isFavorite">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="m12.75 20.66 6.184-7.098c2.677-2.884 2.559-6.506.754-8.705-.898-1.095-2.206-1.816-3.72-1.855-1.293-.034-2.652.43-3.963 1.442-1.315-1.012-2.678-1.476-3.973-1.442-1.515.04-2.825.76-3.724 1.855-1.806 2.201-1.915 5.823.772 8.706l6.183 7.097c.19.216.46.34.743.34a.985.985 0 0 0 .743-.34Z"/>
                        </svg>                          
                    </button>
                    <button @click="addLike" v-if="!isFavorite">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z"/>
                        </svg>
                    </button>
                    <span class="dark:text-white text-black">{{ props.likes_count }}</span>
                </li>
                <li>
                    <button @click="complaintOpen" class="px-5 py-2 bg-red-400 rounded-md text-white font-semibold transition-all hover:bg-red-300">Пожаловаться</button>
                </li>
                <li v-if="complainIsVisible">
                    <ComplaintForm id="complaintForm" :complaint="props.complaint" :theme="props.theme" />
                </li>
                <li v-if="$page.props.auth.user.is_admin == 1 || $page.props.auth.user.id == $page.props.theme.user.id">
                    <button @click="themeEditOpen" class="px-5 py-2 bg-red-400 rounded-md text-white font-semibold transition-all hover:bg-red-300">
                        Редактировать тему
                    </button>
                </li>
                <li v-if="themeEditIsVisible">
                    <form action="" @submit.prevent="updateTheme(theme.id, $event)">
                        <label for="font-semibold text-gray-600 dark:text-white">
                            <span class="text-gray-600 dark:text-white/80">Редактировать тему</span>
                        </label>
                        <input v-model="title" placeholder="Название темы" type="text" class="w-full mt-1 h-10 mb-2 dark:bg-zinc-600 dark:focus:bg-zinc-500 dark:text-white/90 placeholder:text-gray-300 border-gray-400 outline-none transition-all rounded focus:ring-red-400 focus:border-red-400">
                        <!-- <input placeholder="Контент" type="text" class="w-full h-10 mb-2 outline-none transition-all rounded focus:ring-red-400 focus:border-red-400"> -->
                        <textarea v-model="content" name="" id="" placeholder="Контент" class="dark:bg-zinc-600 dark:focus:bg-zinc-500 dark:text-white/90 text-gray-600 placeholder:text-gray-300 w-full h-40 rounded border-gray-400 border transition-all focus:border-red-400 focus:ring-red-400">

                        </textarea>
                        <button type="submit" class="w-full h-10 font-semibold bg-red-400 rounded-md transition-all hover:bg-red-300 text-white">Отправить</button>
                    </form>
                </li>
                <li>
                    <button v-if="$page.props.auth.user.is_admin == 1 ||$page.props.auth.user.id == $page.props.theme.user.id " @click="deleteVisibleChange(theme)" class="px-5 py-2 bg-red-400 rounded-md text-white font-semibold transition-all hover:bg-red-300">
                        Удалить тему
                    </button>
                    <DeleteTheme
                        :theme="selectedTheme" 
                        v-if="isDeleteVisible" 
                        @delete="handleDelete" 
                        @cancel="handleCancel" 
                    />
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
</template>,
is_liked: {
    type: Boolean
}