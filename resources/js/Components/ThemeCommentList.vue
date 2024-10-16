<script setup>
    // import ThemeComment from './ThemeComment.vue';
    import { ref, onMounted } from 'vue';

    const comments = ref('')

    const props = defineProps({
        comments: {
            type: Array
        }
    })

    onMounted(() => {
        console.log('комменты:', comments)
    })
</script>

<template>
    <ul class="themesComments__list flex flex-col gap-5">
        <!-- <ThemeComment /> -->

        <li v-for="(comment, index) in $page.props.theme.comments" :key="comment.id">
            <div class="themesComments__list-item w-full p-5 rounded-md border border-black flex flex-col gap-3">
                <p class="themesComments__list-item--username text-red-400 font-semibold text-lg">Username</p>
                <p class="themesComments__list-item--username text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur cumque aut quos, voluptatibus dolorem rem laboriosam tempora tempore illo commodi optio consequatur hic repudiandae voluptate assumenda? Beatae quasi incidunt repellendus!</p>
                <div class="flex items-center gap-3">
                    <a href="#!" class="px-5 py-2 bg-red-400 text-white font-semibold rounded-md transition-all hover:bg-red-300">Редактировать</a>
                    <a href="#!" class="px-5 py-2 bg-red-400 text-white font-semibold rounded-md transition-all hover:bg-red-300">Удалить</a>
                </div>
            </div>
        </li>
    </ul>
</template>