<script setup>
    import Header from '@/Components/Header.vue';
    import { Head } from '@inertiajs/vue3';

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
        comments: {
            type: Object,
        }
    });

</script>

<template>
    <Head :title="'Панель администратора'" />

    <Header
        :canLogin="props.canLogin" 
        :canRegister="props.canRegister" 
        :user="props.user"
    />

    <div class="max-w-7xl w-full h-auto p-10 rounded-xl bg-zinc-700 my-10 mx-auto"></div>
</template>