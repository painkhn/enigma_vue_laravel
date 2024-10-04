<script setup>
    import ProfileCommentsButtons from '@/Components/ProfileCommentsButtons.vue'
</script>

<template>
    <div class="profileComments__item p-2 rounded-md border border-black flex flex-col gap-2">
        <h3 class="profileComments__username text-xl text-red-400 font-semibold">username</h3>
        <p class="profileComments__text text-gray-600">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Illum assumenda voluptatibus totam quos accusantium ex commodi modi harum minus nam et, esse numquam perspiciatis dolor porro? Harum vitae amet dolore.</p>
        <ProfileCommentsButtons />
        <button class="px-5 py-2 bg-white border border-black rounded-md text-gray-600 font-semibold transition-all hover:bg-gray-100 hover:text-black">Пожаловаться</button>
    </div>
</template>