<script setup>
    import { Link } from '@inertiajs/vue3';
    import { defineProps } from 'vue';
    import { ref, onMounted } from 'vue';

    const props = defineProps({
        categories: Array,
        themes: Array,
        category: Array
    })

    const searchWord = ref('');
    const word = ref('')
    const searchResults = ref([]);

    const isThemeVisible = ref(true)

    const searchThemes = async () => {
        try {
            const response = await axios.post(route('search'), {
                word: word.value,
            });
            searchResults.value = response.data;
        } catch (error) {
            console.error('Ошибка при поиске темы:', error);
        }
    }

</script>

<template>
    <div class="main__themes w-full h-auto p-8 rounded-r-xl rounded-b-xl dark:bg-zinc-700 dark:border-zinc-900 bg-white border border-slate-200">
        <h2 class="main__themes-title text-red-400 font-bold text-2xl mb-5">Темы</h2>
        <form @submit.prevent="searchThemes" method="POST" class="header__search-form flex items-center mb-5">
            <input v-model="word" @input="searchWord" type="search" name="word" id="" class="header__search-input w-full dark:bg-zinc-600 bg-white dark:border-zinc-900 dark:focus:border-zinc-500 dark:text-white/90 dark:focus:bg-zinc-700 text-gray-800 outline-none px-4 h-8 rounded-md focus:ring-1 dark:focus:ring-zinc-500 focus:ring-red-400 focus:ring-offset-red-400 focus:ring-offset-0 transition-all border focus:border-red-400 focus:outline-none focus:shadow-md" placeholder="Поиск...">
            <button class="w-10 h-10 hover:scale-125 transition-all bg-transparent" type="submit">
                <svg class="w-10 h-10" viewBox="-2.4 -2.4 28.80 28.80" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="transparent"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect width="24" height="24" fill="transparent"></rect> <path fill-rule="evenodd" clip-rule="evenodd" d="M7.25007 2.38782C8.54878 2.0992 10.1243 2 12 2C13.8757 2 15.4512 2.0992 16.7499 2.38782C18.06 2.67897 19.1488 3.176 19.9864 4.01358C20.824 4.85116 21.321 5.94002 21.6122 7.25007C21.9008 8.54878 22 10.1243 22 12C22 13.8757 21.9008 15.4512 21.6122 16.7499C21.321 18.06 20.824 19.1488 19.9864 19.9864C19.1488 20.824 18.06 21.321 16.7499 21.6122C15.4512 21.9008 13.8757 22 12 22C10.1243 22 8.54878 21.9008 7.25007 21.6122C5.94002 21.321 4.85116 20.824 4.01358 19.9864C3.176 19.1488 2.67897 18.06 2.38782 16.7499C2.0992 15.4512 2 13.8757 2 12C2 10.1243 2.0992 8.54878 2.38782 7.25007C2.67897 5.94002 3.176 4.85116 4.01358 4.01358C4.85116 3.176 5.94002 2.67897 7.25007 2.38782ZM9 11.5C9 10.1193 10.1193 9 11.5 9C12.8807 9 14 10.1193 14 11.5C14 12.8807 12.8807 14 11.5 14C10.1193 14 9 12.8807 9 11.5ZM11.5 7C9.01472 7 7 9.01472 7 11.5C7 13.9853 9.01472 16 11.5 16C12.3805 16 13.202 15.7471 13.8957 15.31L15.2929 16.7071C15.6834 17.0976 16.3166 17.0976 16.7071 16.7071C17.0976 16.3166 17.0976 15.6834 16.7071 15.2929L15.31 13.8957C15.7471 13.202 16 12.3805 16 11.5C16 9.01472 13.9853 7 11.5 7Z" fill="#f87171"></path> </g></svg>
            </button>
        </form>
        <ul class="main__themes-list flex flex-col gap-3 text-gray-600 dark:text-white" v-if="searchResults.length > 0">
            <li v-for="theme in searchResults" :key="theme.id">
                <Link :href="route('themeShow', { id: theme.id })"  class="transition-all hover:text-red-400 px-4 rounded-md flex w-full dark:bg-zinc-600 bg-gray-100 py-2 text-base font-semibold hover:border-l-2 hover:border-red-400">
                    {{ theme.name }}
                </Link>
            </li>
        </ul>

        <ul class="main__themes-list flex flex-col gap-3 text-gray-600 dark:text-white" v-else>
            <li v-for="theme in $page.props.themes" :key="theme.id">
                <Link :href="route('themeShow', { id: theme.id })"  class="transition-all hover:text-red-400 px-4 rounded-md flex w-full dark:bg-zinc-600 bg-gray-100 py-2 text-base font-semibold hover:bg-gray-100 hover:border-l-2 hover:border-red-400">{{ theme.name }}</Link>
            </li>
        </ul>
    </div>
</template>