<script setup>
    import Header from '@/Components/Header.vue';
    import { Head } from '@inertiajs/vue3';
    import ProfileInfo from '@/Components/ProfileInfo.vue';
    import ProfileThemes from '@/Components/ProfileThemes.vue';
    import ProfileComments from '@/Components/ProfileComments.vue';
    import Footer from '@/Components/Footer.vue'
    import CommentForm from '@/Components/CommentForm.vue'
    import { ref } from 'vue';

    const themesIsVisible = ref(true);

    const openThemes = () => {
        themesIsVisible.value = !themesIsVisible.value
    }

    const props = defineProps({
        canLogin: {
            type: Boolean,
        },
        canRegister: {
            type: Boolean,
        },
        user: {
            type: Object,
        }
    });
    
</script>

<template>
    <Head :title="'Профиль'" />

    <Header
        :canLogin="props.canLogin" 
        :canRegister="props.canRegister" 
        :user="props.user"
    />

    <div class="max-w-7xl h-auto p-5 mx-auto my-0 bg-white shadow-lg mt-10 selection:bg-[#f87171] selection:text-white rounded-md">
        <ProfileInfo />
        <hr class="border border-red-400 mb-5">
        <button @click="openThemes" class="px-5 py-3 bg-red-400 rounded-md text-white text-lg font-medium transition-all hover:bg-red-300">
            <span v-if="themesIsVisible">Показать комментарии</span>
            <span v-else>Показать темы</span>
        </button>

        <ProfileThemes v-if="themesIsVisible" />

        <ProfileComments v-else />
        <!-- <form class="profile__comment-form">
            <label for="">Оставьте комментарий</label>
            <textarea name="" id=""></textarea>
        </form> -->
        <!-- <CommentForm /> -->

        
    </div>

    <Footer />
</template>