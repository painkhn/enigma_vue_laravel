<script setup>
    import { ref, defineProps } from 'vue';
    // const props = defineProps({
    //     complain: {
    //         type: String
    //     },
    //     user: {
    //         type: Object,
    //     },
    //     theme: {
    //         type: Object
    //     },
    //     comments: {
    //         type: Object
    //     }
    // })

    const props = defineProps({
        complaint: {
            type: String
        },
        user: {
            type: String
        },
        theme: {
            type: Object
        }
    })

    const complaint = ref('')

    const createComplaint = async () => {
        try {
            const response = await axios.post(route('new_complaint'), {
                complaint: complaint.value,
                theme_id: props.theme.id 
                // content: content.value,
                // category_id: selectedCategory.value,
            });

            location.reload()

            // if (response.data.redirect) {
            //     window.location.href = response.data.redirect;
            // }
            // console.log('Данные:', content.value);
            console.log('Жалоба создана');
            // Здесь вы можете перенаправить пользователя или очистить форму
        } catch (error) {
            console.error('Ошибка при создании темы:', error);
        }
    };
</script>

<template>
    <form @submit.prevent="createComplaint" method="POST" action="" class="complaint__form flex flex-col w-full">
        <h2 class="complaint__form__title text-center font-bold text-red-400 text-lg mb-5">Отправить жалобу</h2>
        <label for="" class="text-red-400 font-semibold mb-2">Жалоба</label>
        <textarea v-model="complaint" name="complain" id="complain" placeholder="Введите сюда текст вашей жалобы" class="mb-5 transition-all rounded w-full h-40 outline-none focus:ring-red-400 focus:border-red-400"></textarea>
        <input type="submit" value="Отправить" class="w-full h-10 bg-red-400 text-white font-semibold transition-all hover:bg-red-300 rounded-md cursor-pointer">
        <!-- <button type="submit" class="w-full h-10 bg-red-400 text-white font-semibold transition-all hover:bg-red-300 rounded-md cursor-pointer">Отправить</button> -->
    </form>
</template>