<script setup>
    import { Head } from '@inertiajs/vue3';
    import Header from '@/Components/Header.vue';
    import MainPageContent from '@/Components/MainPageContent.vue';
    import GuestWelcome from '@/Components/GuestWelcome.vue';
    import Footer from '@/Components/Footer.vue';

    const props = defineProps({
        canLogin: Boolean,
        canRegister: Boolean,
        user: Object,
        themes: Array,
        categories: Array,
    });
</script>

<template>
    <Head title="Главная страница" />
    <Header 
        :canLogin="props.canLogin" 
        :canRegister="props.canRegister" 
        :user="props.user" 
    />
    <div class="text-black/50 dark:bg-black dark:text-white/50">
        <div class="relative flex min-h-screen flex-col items-center selection:bg-[#f87171] selection:text-white">
            <div class="w-full max-w-2xl px-6 lg:max-w-7xl">
                <main class="mt-10">
                    <MainPageContent v-if="$page.props.auth.user" />                    
                    <GuestWelcome v-else />
                </main>
                <Footer />
            </div>
        </div>
    </div>
</template>

