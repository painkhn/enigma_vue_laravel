<script setup>
    // import ThemeComment from './ThemeComment.vue';
    import { ref, onMounted, defineProps } from 'vue';

    const comments = ref('')

    const props = defineProps({
        comments: {
            type: Object
        },
        user: {
            type: Object,
        },
        theme: {
            type: Object,
        },
    })

    const content = ref('');

    const updateComment = async (commentId) => {
        try {
            const response = await axios.patch(
            route('update_comment', { id: commentId }),
                {
                    content: content.value,
                    // theme_id: props.theme.id 
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                }
            );
            location.reload()

            console.log('Успешно', response.data.message);
            // location.reload(); // Refresh the page to update comments
        } catch (error) {
            console.log(error, commentId);
        }
    };

    const deleteComment = async (commentId) => {
        try {
            const response = await axios.delete(route('delete_comment', {id: commentId}), { 
                'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
            });
            console.log('Успешно', response.data.message)
            // if (response.data.redirect) {
            //     window.location.href = response.data.redirect;
            // }
            location.reload()
        } catch (error) {
            console.log(error, commentId)
        }
    }

    const commentEditIsVisible = ref(false)

    const commentEditOpen = () => {
        commentEditIsVisible.value = !commentEditIsVisible.value
    }

    onMounted(() => {
        console.log('комменты:', props.comments)
    })
</script>

<template>
    <ul class="themesComments__list flex flex-col gap-5">
        <!-- <ThemeComment /> -->
         <!-- <p>{{ props.comments }}</p> -->

        <li v-for="(comment, index) in props.comments" :key="comment.id">
            <div class="themesComments__list-item w-full p-5 rounded-md bg-gray-100 dark:bg-zinc-600 border-l-2 border-red-400 flex flex-col gap-3">
                <p class="themesComments__list-item--username text-red-400 font-semibold text-lg">{{ comment.user.name }} <span v-if="comment.user.is_admin == 1">- Администратор</span></p>
                <p class="themesComments__list-item--username text-gray-600 dark:text-white/90">{{ comment.content }}</p>
                <div class="flex items-center gap-3">
                    <!-- <a href="#!" class="px-5 py-2 bg-red-400 text-white font-semibold rounded-md transition-all hover:bg-red-300">Редактировать</a> -->
                    <button @click="commentEditOpen" href="#!" class="px-5 py-2 bg-red-400 text-white font-semibold rounded-md transition-all hover:bg-red-300">Редактировать</button>
                    <!-- <a href="#!" class="px-5 py-2 bg-red-400 text-white font-semibold rounded-md transition-all hover:bg-red-300">Удалить</a> -->
                    <button @click="deleteComment(comment.id)" class="px-5 py-2 bg-red-400 text-white font-semibold rounded-md transition-all hover:bg-red-300" v-if="$page.props.auth.user.is_admin == 1">Удалить</button>
                    <!-- <a href="#!" class="px-5 py-2 bg-transparent border border-black text-black rounded-md transition-all hover:bg-white">Пожаловаться</a> -->
                </div>
                <form @submit.prevent="updateComment(comment.id, $event)" v-if="commentEditIsVisible" action="" class="comment__edit-form flex flex-col">
                    <label for="" class="mb-1 dark:text-white/90">Введите новый комментарий</label>
                    <input v-model="content" type="text" class="dark:bg-zinc-600 dark:focus:bg-zinc-500 dark:text-white/90 w-full h-10 mb-2 outline-none transition-all rounded focus:ring-red-400 focus:border-red-400">
                    <button type="submit" class="w-full h-10 font-semibold bg-red-400 rounded-md transition-all hover:bg-red-300 text-white">Отправить</button>
                </form>
            </div>
        </li>
    </ul>
</template>