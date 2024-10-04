<script setup>
    import Header from '@/Components/Header.vue';
    import { Head } from '@inertiajs/vue3';
    import ProfileInfo from '@/Components/ProfileInfo.vue';
    import ProfileThemes from '@/Components/ProfileThemes.vue';
    import ProfileComments from '@/Components/ProfileComments.vue';
    import { ref } from 'vue';

    const themesIsVisible = ref(true);

    const openThemes = () => {
        themesIsVisible.value = !themesIsVisible.value
    }
    
</script>

<template>
    <Head :title="'Профиль'" />

    <Header />

    <div class="max-w-6xl h-auto p-5 mx-auto my-0 bg-white shadow-lg mt-10 selection:bg-[#f87171] selection:text-white rounded-md">
        <ProfileInfo />
        <hr class="border border-red-400 mb-5">
        <button @click="openThemes" class="px-5 py-3 bg-red-400 rounded-md text-white text-lg font-medium transition-all hover:bg-red-300">
            <span v-if="themesIsVisible">Показать комментарии</span>
            <span v-else>Показать темы</span>
        </button>

        <ProfileThemes v-if="themesIsVisible" />
        <ProfileComments v-else />
        
    </div>
</template>