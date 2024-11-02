<script setup>
    import ProfileCommentItem from '@/Components/ProfileCommentItem.vue'
    import CommentForm from '@/Components/CommentForm.vue'
    import ProfileCommentsList from './ProfileCommentsList.vue';
    import { ref, onMounted } from 'vue';

    const props = defineProps({
        user: {
            type: Object,
        },
    })

    const content = ref('');

    const createProfileComment = async () => {
        try {
            console.log(content.value);
            const response = await axios.post(route('new_profile_comment'), {
                content: content.value,
                profile_id: props.user.id 
            });

            location.reload()

            // if (response.data.redirect) {
            //     window.location.href = response.data.redirect;
            // }

            console.log('Коммент создан', content.value)
            // console.log('Данные:', content.value);
            // console.log('Тема создана');
            // Здесь вы можете перенаправить пользователя или очистить форму
        } catch (error) {
            console.error('Ошибка при создании комментария:', error);
        }
    };

    onMounted(() => {
        console.log('123123', props.user)
    })
</script>

<template>
    <div class="profileComments">
        <h2 class="profileComments__title text-center text-red-400 font-bold text-xl mb-2">Комментарии</h2>
        <!-- <CommentForm /> -->

        <form @submit.prevent="createProfileComment" action="" method="POST" class="themesComments__form flex flex-col mb-5">
            <!-- <p>{{props.theme.id}}</p> -->
            <label for="" class="themesComments__form-label mb-1 text-gray-600 font-semibold">Введите комментарий</label>
            <input v-model="content" type="text" class="themesComments__form-input placeholder:text-gray-400 mb-5 w-full h-10 transition-all border-gray-400 focus:ring-red-400 focus:border-red-400 rounded text-gray-600" placeholder="Ваш комментарий">
            <input type="submit" value="Отправить" class="themesComments__form-submit w-full h-10 bg-red-400 text-white font-semibold transition-all hover:bg-red-300 rounded-md cursor-pointer">
        </form>

        <ProfileCommentsList />
    </div>
</template>