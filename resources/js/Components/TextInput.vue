<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="rounded-md transition-all border-red-400 shadow-sm focus:border-red-400 dark:bg-zinc-600 dark:focus:bg-zinc-500 dark:text-white focus:ring-red-400"
        v-model="model"
        ref="input"
    />
</template>
