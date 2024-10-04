<script setup>
    import ProfileCommentItem from '@/Components/ProfileCommentItem.vue'
</script>

<template>
    <div class="profileComments">
        <h2 class="profileComments__title text-center text-red-400 font-bold text-xl mb-2">Комментарии</h2>
        <ul class="profileComments__list">
            <li>
                <ProfileCommentItem />
            </li>
        </ul>
    </div>
</template>