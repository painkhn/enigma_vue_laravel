<script setup>
    import Header from '@/Components/Header.vue'
    import { Head, Link, usePage } from '@inertiajs/vue3';
    import ComplaintForm from '@/Components/ComplaintForm.vue';

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
        theme: {
            type: Object
        },
        comments: {
            type: Object
        }
    });

</script>

<template>
    <Head :title="'Жалобы'" />

    <Header
        :canLogin="props.canLogin" 
        :canRegister="props.canRegister" 
        :user="props.user"
    />

    <div class="max-w-7xl w-full h-auto bg-white mx-auto my-0 p-10 mt-10 rounded-md shadow-md">
        <ComplaintForm />
    </div>
</template>