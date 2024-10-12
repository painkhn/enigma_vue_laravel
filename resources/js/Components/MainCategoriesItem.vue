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
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM8.96963 8.96965C9.26252 8.67676 9.73739 8.67676 10.0303 8.96965L12 10.9393L13.9696 8.96967C14.2625 8.67678 14.7374 8.67678 15.0303 8.96967C15.3232 9.26256 15.3232 9.73744 15.0303 10.0303L13.0606 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0303 15.0303C9.73742 15.3232 9.26254 15.3232 8.96965 15.0303C8.67676 14.7374 8.67676 14.2625 8.96965 13.9697L10.9393 12L8.96963 10.0303C8.67673 9.73742 8.67673 9.26254 8.96963 8.96965Z" fill="#f87171"></path> </g></svg>
            </button>
        </li>
        <li v-if="$page.props.auth.user && $page.props.auth.user.is_admin == 1">
            <form @submit.prevent="createCategory" method="POST" class="flex items-center gap-2">
                <input v-model="title" name="title" type="text" class="h-6 w-4/6 px-2 transition-all border-gray-300 focus:ring-red-400 focus:border-red-400 rounded text-sm">
                <button type="submit">
                    <svg width="22px" height="22px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>plus-circle</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set-Filled" sketch:type="MSLayerGroup" transform="translate(-466.000000, -1089.000000)" fill="#f87171"> <path d="M488,1106 L483,1106 L483,1111 C483,1111.55 482.553,1112 482,1112 C481.447,1112 481,1111.55 481,1111 L481,1106 L476,1106 C475.447,1106 475,1105.55 475,1105 C475,1104.45 475.447,1104 476,1104 L481,1104 L481,1099 C481,1098.45 481.447,1098 482,1098 C482.553,1098 483,1098.45 483,1099 L483,1104 L488,1104 C488.553,1104 489,1104.45 489,1105 C489,1105.55 488.553,1106 488,1106 L488,1106 Z M482,1089 C473.163,1089 466,1096.16 466,1105 C466,1113.84 473.163,1121 482,1121 C490.837,1121 498,1113.84 498,1105 C498,1096.16 490.837,1089 482,1089 L482,1089 Z" id="plus-circle" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
                </button>
            </form>
        </li>
    </ul>
</template>