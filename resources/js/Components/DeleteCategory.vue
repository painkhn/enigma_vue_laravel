<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    category: {
        type: Object,
        required: true,
    },
});

const emit = defineEmits(['delete', 'cancel']);

const handleDelete = () => {
    emit('delete', props.category.id);
};

const handleCancel = () => {
    emit('cancel');
};
</script>

<template>
    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 z-10 bg-zinc-600 border border-zinc-900 shadow-md rounded-xl p-5 !max-w-xl w-full h-auto">
        <p class="text-white mb-5">Вы уверены, что хотите удалить категорию "{{ category.name }}"?</p>
        
        <div class="flex items-center gap-5">
            <button v-if="$page.props.auth.user.is_admin == 1" @click="handleDelete" class="px-4 py-2 bg-zinc-700 rounded-md transition-all hover:bg-zinc-800">
                Уверен
            </button>
            <button @click="handleCancel" class="px-4 py-2 bg-zinc-700 rounded-md transition-all hover:bg-zinc-800">Отмена</button>
        </div>
    </div>
</template>