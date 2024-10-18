<script setup>
    // import ThemeComment from './ThemeComment.vue';
    import { ref, onMounted } from 'vue';

    const comments = ref('')

    const props = defineProps({
        comments: {
            type: Object
        },
        user: {
            type: Object,
        },
    })

    onMounted(() => {
        console.log('комменты:', props.comments)
    })
</script>

<template>
    <ul class="themesComments__list flex flex-col gap-5">
        <!-- <ThemeComment /> -->
         <p>{{ props.comments }}</p>

        <li v-for="(comment, index) in props.comments" :key="comment.id">
            <div class="themesComments__list-item w-full p-5 rounded-md border border-black flex flex-col gap-3">
                <p class="themesComments__list-item--username text-red-400 font-semibold text-lg">{{ comment.user_id }}</p>
                <p class="themesComments__list-item--username text-gray-600">{{ comment.content }}</p>
                <div class="flex items-center gap-3">
                    <a href="#!" class="px-5 py-2 bg-red-400 text-white font-semibold rounded-md transition-all hover:bg-red-300">Редактировать</a>
                    <a href="#!" class="px-5 py-2 bg-red-400 text-white font-semibold rounded-md transition-all hover:bg-red-300">Удалить</a>
                </div>
            </div>
        </li>
    </ul>
</template>