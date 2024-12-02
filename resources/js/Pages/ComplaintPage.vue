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

    const deleteComplaint = async (complaintId) => {
        try {
            const response = await axios.delete(route('delete_complaint', {id: complaintId}), { 
                'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
            });
            console.log('Успешно', response.data.message)
            // if (response.data.redirect) {
            //     window.location.href = response.data.redirect;
            // }
            location.reload()
        } catch (error) {
            console.log(error, themeId)
        }
    }

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

    <div class="max-w-7xl w-full h-auto dark:bg-zinc-700 bg-white mx-auto my-0 p-10 mt-10 rounded-md shadow-md">
        <ComplaintForm :complaint="props.complaint" v-if="$page.props.auth.user.is_admin == 0" />

        <ul class="complaint__list flex flex-col gap-5" v-else>
            <li v-for="complaint in $page.props.complaints" :key="complaint.id">
                <Link :href="`theme/${complaint.theme_id}`" class="transition-all hover:text-red-400 px-4 rounded-md flex w-full dark:bg-zinc-600 bg-gray-200 py-3 text-base font-semibold dark:hover:bg-zinc-500 hover:bg-gray-100 hover:border-l-2 hover:border-red-400 dark:text-white/90 dark:hover:text-white">
                    <span class="text-red-400 mr-2">{{ complaint.user.name }}:</span> {{ complaint.complaint }} <button class="ml-auto cursor-pointer hover:bg-gray-300 px-5 rounded-md hover:text-zinc-700 transition-all" @click="deleteComplaint(complaint.id)">Отклонить</button>
                </Link>
            </li>
        </ul>
    </div>
</template>