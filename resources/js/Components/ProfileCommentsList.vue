<script setup>
    import { ref, onMounted, defineProps } from 'vue';

    const comments = ref('')

    const props = defineProps({
        comments: {
            type: Object
        },
        user: {
            type: Object,
        },
    })

    onMounted(() => {
        console.log('комменты:', props.comments)
    })
</script>

<template>
    <ul class="profileComments__list">
        <li v-for="(comment, index) in $page.props.comments" :key="comment.id">
            asdasd
        </li>
    </ul>
</template>