<script setup>
    import axios from 'axios';
import { ref } from 'vue';

    const title = ref('')
    const props = defineProps({
        categories: Array,
        themes: Array,
        category: String
    })

    const createCategory = async () => {
        try {
            const response = await axios.post(route('new_category'), {
                name: title.value,
            });
            location.reload()
        } catch (error) {
            console.error('Ошибка при создании категории:', error);
        }
    };
    
    const deleteCategory = async (categoryId) => {
        try {
            const response = await axios.delete(route('delete_category', {id: categoryId}), { 
                'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
            });
            console.log('Успешно', response.data.message)
            location.reload()
        } catch (error) {
            console.log(error, categoryId)
        }
    }
</script>

<template>
    <h2 class="main__categories-title text-red-400 font-bold text-2xl mb-5">Категории</h2>
    <ul class="main__categories-list flex flex-col gap-2 text-gray-800 dark:text-white mb-5">
        <li v-for="category in $page.props.categories" :key="category.id" class="mb-4 relative">
            <a href="#!" class="transition-all hover:text-red-400 font-medium p-2 bg-gray-100 rounded-md hover:border-l-2 hover:border-red-400">{{ category.name }}</a>
            <button v-if="$page.props.auth.user.is_admin == 1" @click="deleteCategory(category.id)" class="absolute right-0">
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 12V17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 12V17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M4 7H20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 10V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V10" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </button>
        </li>
        <li v-if="$page.props.auth.user && $page.props.auth.user.is_admin == 1">
            <form @submit.prevent="createCategory" method="POST" class="flex items-center gap-2">
                <input v-model="title" placeholder="Новая категория" name="title" type="text" class="h-6 w-full px-2 transition-all border-gray-300 focus:ring-red-400 focus:border-red-400 rounded text-sm">
                <button type="submit">
                    <svg width="22px" height="22px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>plus-circle</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set-Filled" sketch:type="MSLayerGroup" transform="translate(-466.000000, -1089.000000)" fill="#f87171"> <path d="M488,1106 L483,1106 L483,1111 C483,1111.55 482.553,1112 482,1112 C481.447,1112 481,1111.55 481,1111 L481,1106 L476,1106 C475.447,1106 475,1105.55 475,1105 C475,1104.45 475.447,1104 476,1104 L481,1104 L481,1099 C481,1098.45 481.447,1098 482,1098 C482.553,1098 483,1098.45 483,1099 L483,1104 L488,1104 C488.553,1104 489,1104.45 489,1105 C489,1105.55 488.553,1106 488,1106 L488,1106 Z M482,1089 C473.163,1089 466,1096.16 466,1105 C466,1113.84 473.163,1121 482,1121 C490.837,1121 498,1113.84 498,1105 C498,1096.16 490.837,1089 482,1089 L482,1089 Z" id="plus-circle" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
                </button>
            </form>
        </li>
    </ul>
</template>