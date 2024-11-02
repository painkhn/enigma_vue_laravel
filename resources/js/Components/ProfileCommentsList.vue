<script setup>
    import { ref, onMounted, defineProps } from 'vue';

    const content = ref('')

    const props = defineProps({
        comments: {
            type: Object
        },
        user: {
            type: Object,
        },
    })

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

    const commentEditIsVisible = ref(false)

    const commentEditOpen = () => {
        commentEditIsVisible.value = !commentEditIsVisible.value
    }

    onMounted(() => {
        console.log('комменты:', props.comments)
    })
</script>

<template>
    <ul class="profileComments__list flex flex-col gap-5 cursor-pointer">
        <li v-for="(comment, index) in comments" :key="comment.id">
            <div class="py-2 px-4 w-full dark:bg-zinc-600 dark:hover:bg-zinc-500 bg-gray-100 rounded-md transition-all hover:border-l-2 hover:border-red-400">
                <h3 class="profileComments__list-username font-semibold text-lg text-gray-600 dark:text-white">{{ comment.user.name }} <span v-if="comment.user.is_admin == 1">- Администратор</span></h3>
                <p class="textForCopy mb-2 dark:text-white">{{ comment.content }}</p>
                <div v-if="$page.props.auth.user.is_admin == 1 || $page.props.auth.user.id == comment.user.id" class="flex gap-2">
                    <button @click="commentEditOpen" class="px-5 py-2 bg-red-400 text-white transition-all hover:bg-red-300 rounded-md font-semibold">Редактировать</button>
                    <button @click="deleteComment(comment.id)" class="px-5 py-2 bg-red-400 text-white transition-all hover:bg-red-300 rounded-md font-semibold">Удалить</button>
                </div>
                <form @submit.prevent="updateComment(comment.id, $event)" v-if="commentEditIsVisible" action="" class="comment__edit-form flex flex-col mt-2">
                    <label for="" class="mb-1">Введите новый комментарий</label>
                    <input v-model="content" type="text" class="w-full h-10 mb-2 outline-none transition-all rounded focus:ring-red-400 focus:border-red-400">
                    <button type="submit" class="w-full h-10 font-semibold bg-red-400 rounded-md transition-all hover:bg-red-300 text-white">Отправить</button>
                </form>
            </div>
        </li>
    </ul>
</template> 

<style scoped>
    .profileComments__list li:hover .profileComments__list-username {
        transition: all .2s;
        color: #f87171;
    }
</style>