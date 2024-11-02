<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const avatarFile = ref(null);

const handleFileChange = (event) => {
    avatarFile.value = event.target.files[0];
};

const submitAvatarForm = async () => {
    if (!avatarFile.value) {
        alert('Пожалуйста, выберите файл для загрузки.');
        return;
    }

    const formData = new FormData();
    formData.append('avatar_change', avatarFile.value);

    try {
        await axios.post(route('new_avatar'), formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        });
        // Обработка успешного изменения аватарки
        avatarFile.value = null; // Сбросить выбранный файл
        // console.log('аватарка успешно изменена')
        alert('Новая аватарка успешно установлена!')
    } catch (error) {
        // Обработка ошибок валидации
        console.error('Произошла ошибка при загрузке аватарки:', error.response.data.errors);
        // alert('Произошла ошибка при загрузке аватарки: ' + error.response.data.errors.avatar_change.join(', '));
    }
}
</script>

<template>
    <Head title="Редактировать профиль" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div
                    class="dark:bg-zinc-700 bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div
                    class="dark:bg-zinc-700 bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                        Изменить аватарку
                    </h2>
        
                    <p class="mt-1 text-sm text-gray-600 dark:text-white/90">
                        Введите новую аватарку, которая будет отображаться в вашем профиле
                    </p>
                    <form id="avatar-file-form" @submit.prevent="submitAvatarForm" class="mt-5">
                        <label class="flex items-center justify-center transition-all border-2 px-3 py-2 border-primary cursor-pointer w-1/2 mb-5 rounded-md hover:border-red-400" for="avatar_change">
                            <input @change="handleFileChange" class="hidden" type="file" name="avatar_change" id="avatar_change" accept="image/*">
                            <span class="text-base text-gray-600 dark:text-white font-semibold">Сменить аватарку</span>
                        </label>
                        <button type="submit" class="bg-red-400 transition-all text-white px-4 py-2 hover:bg-red-300 rounded-md uppercase text-xs font-semibold tracking-widest">Сохранить</button>
                    </form>
                </div>

                

                <div
                    class="bg-white dark:bg-zinc-700 p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div
                    class="bg-white dark:bg-zinc-700 p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
