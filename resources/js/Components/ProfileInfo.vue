<script setup>
    import { Link } from '@inertiajs/vue3'
    import { ref } from 'vue';

    const downloadProfile = (userName) => {
        window.open(route('download_profile', { name: userName }), '_blank');
    }

    const getYearsWord = (age) => {
        if (age % 10 === 1 && age % 100 !== 11) {
            return 'год';
        } else if ((age % 10 >= 2 && age % 10 <= 4) && (age % 100 < 10 || age % 100 >= 20)) {
            return 'года';
        } else {
            return 'лет';
        }
    };



</script>

<template>
    <div class="profileInfo flex gap-5">
        <img v-if="$page.props.user.avatar == NULL" src='/img/avatar_default.jpg' class="profileInfo__avatar w-40 h-40 rounded border-slate-200" alt="">
        <img v-else :src="`/storage/` + $page.props.user.avatar" alt="Аватарка" encType="multipart/form-data" class="profileInfo__avatar w-40 h-40 rounded border-slate-200">
        
        <!-- <div>
            <input type="file" name="avatar_change" @change="handleFileChange" accept="image/*">
            <button @click="submitAvatarForm">Загрузить аватар</button>
        </div> -->
        <div class="profileInfo__info w-full mb-2">
            <div class="flex items-center justify-between">
                <h3 class="profileinfo__info-username uppercase text-red-400 font-bold mb-2">{{ $page.props.user.name }}</h3>
                <p v-if="$page.props.user.is_admin == 1" class="font-semibold text-red-400 uppercase">Администратор</p>
                <div class="flex gap-5 items-center" v-if="$page.props.auth.user.id == $page.props.user.id">
                    <Link href="/profile/edit" class="mb-2 dark:text-white/90 text-gray-600 transition-all dark:hover:text-red-400 hover:text-red-400" as="button">Редактировать</Link>
                    <Link :href="route('logout')" method="post" class="mb-2 text-gray-600 dark:text-white/90 transition-all dark:hover:text-red-400 hover:text-red-400" as="button">Выйти</Link>
                </div>
            </div>
            <hr class="border-gray-400 opacity-80 mb-2">
            <p class="profileInfo__info-email mb-2 dark:text-white">{{ $page.props.user.email }}</p>
            <p class="profileInfo__info-age mb-2 dark:text-white">{{ $page.props.user.age }} {{ getYearsWord($page.props.user.age) }}</p>
            <hr class="border-gray-400 opacity-80 mb-2">
            <div class="flex flex-col items-start gap-2">
                <Link :href="route('themeCreate')" class="transition-all dark:text-white/80 dark:hover:text-red-400 hover:text-red-400 font-semibold" as="button" v-if="$page.props.auth.user.id == $page.props.user.id">Создать тему</Link>
                <Link :href="route('complaints')" class="transition-all dark:text-white/80 dark:hover:text-red-400 hover:text-red-400 font-semibold" v-if="$page.props.auth.user.id == $page.props.user.id && $page.props.auth.user.is_admin == 1">Жалобы</Link>
                <button @click="downloadProfile($page.props.user.name)" class="transition-all dark:text-white/80 dark:hover:text-red-400 hover:text-red-400 font-semibold">Скачать информацию профиля</button>
            </div>
        </div>
    </div>
</template>