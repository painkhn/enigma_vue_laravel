<script setup>
    import Header from '@/Components/Header.vue'
    import { Head, Link, usePage } from '@inertiajs/vue3';
    import ComplaintForm from '@/Components/ComplaintForm.vue';
    import { onMounted } from 'vue';

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
        },
        complaint: {
            type: Object
        },
        complaints: {
            type: Array
        }
    });

    onMounted(() => {
        console.log(props.complaints)
    })
</script>

<template>
    <Head :title="'Жалобы'" />

    <Header
        :canLogin="props.canLogin" 
        :canRegister="props.canRegister" 
        :user="props.user"
    />

    <div class="max-w-7xl w-full h-auto bg-white mx-auto my-0 p-10 mt-10 rounded-md shadow-md">
        <ComplaintForm :complaint="props.complaint" v-if="$page.props.auth.user.is_admin == 0" />

        <ul class="complaint__list flex flex-col gap-5" v-else>
            <li v-for="complaint in $page.props.complaints" :key="complaint.id">
                <Link class="transition-all hover:text-red-400 px-4 rounded-md flex w-full bg-gray-200 py-3 text-base font-semibold hover:bg-gray-100 hover:border-l-2 hover:border-red-400">
                    <span class="text-red-400 mr-2">{{ complaint.user.name }}:</span> {{ complaint.complaint }}
                </Link>
            </li>
        </ul>
    </div>
</template>