<script setup>
        import { Head, Link } from '@inertiajs/vue3';
        import Header from '@/Components/Header.vue'
        import { ref, onMounted } from 'vue';

        const props = defineProps({
            canLogin: {
                type: Boolean,
            },
            canRegister: {
                type: Boolean,
            },
            user: {
                type: Object,
            },
            themes: {
                type: Array,
            },
            theme: {
                type: Object
            },
            comments: {
                type: Object
            },
            complaint: {
                type: Object
            },
            views_count: {
                type: Number
            },
            likes_count: {
                type: Number
            }
        });

        onMounted(() => {
            console.log(props.themes)
        })
</script>

<template>
    <Head :title="'Рейтинг'" />

    <Header
        :canLogin="props.canLogin" 
        :canRegister="props.canRegister" 
        :user="props.user"
    />

    <div class="max-w-7xl h-auto w-full bg-white dark:bg-zinc-700 mx-auto my-10 rounded-xl border border-zinc-900 p-10">
        <h1 class="text-white text-center font-bold text-xl mb-10">Рейтинг</h1>
        <div class="flex justify-center gap-5 mb-10">
            <Link :href="route('rating_views')" class="text-white font-semibold px-5 py-3 bg-black/20 rounded-xl transition-all hover:bg-black/30">По просмотрам</Link>
            <Link :href="route('rating_likes')" class="text-white font-semibold px-5 py-3 bg-black/20 rounded-xl transition-all hover:bg-black/30">По Лайкам</Link>
            <!-- <button class="text-white font-semibold px-5 py-3 bg-black/20 rounded-xl transition-all hover:bg-black/30">По лайкам</button> -->
        </div>
        <ul class="flex flex-col gap-5">
            <li v-for="(theme, index) in $page.props.themes" :key="index">
                <Link :href="route('themeShow', { id: theme.id })" class="w-full flex flex-col gap-2 px-8 py-4 rounded-xl font-semibold transition-all bg-black/20 hover:bg-black/60 text-white">
                    {{ theme.name }}
                    <br>
                    <span class="text-sm text-white/90 font-normal">Количество просмотров: {{ theme.views_count }}</span> 
                    <span class="text-sm text-white/90 font-normal">Количество лайков: {{ theme.likes_count }}</span> 
                </Link>
            </li>
        </ul>
    </div>
</template>