<script setup>
    import { defineProps, defineEmits } from 'vue';

    const props = defineProps({
        theme: {
            type: Object,
            required: true,
        },
    });

    const emit = defineEmits(['delete', 'cancel']);

    const handleDelete = () => {
        emit('delete', props.theme.id);
    };

    const handleCancel = () => {
        emit('cancel');
    };
</script>

<template>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 z-10 dark:bg-zinc-600 bg-white border border-gray-200 dark:border-zinc-900 shadow-md rounded-xl p-5 !max-w-xl w-full h-auto">
        <p class="dark:text-white mb-5">Вы уверены, что хотите удалить тему "{{ $page.props.theme.name }}"?</p>
        
        <div class="flex items-center gap-5">
            <button v-if="$page.props.auth.user.is_admin == 1" @click="handleDelete" class="px-4 py-2 dark:bg-zinc-700 bg-red-400 text-white rounded-md transition-all hover:bg-red-300 dark:hover:bg-zinc-800">
                Уверен
            </button>
            <button @click="handleCancel" class="px-4 py-2 dark:bg-zinc-700 bg-red-400 text-white rounded-md transition-all hover:bg-red-300 dark:hover:bg-zinc-800">Отмена</button>
        </div>
    </div>
</template>