<script setup>
import axios from 'axios';
import Header from '@/Components/Header.vue';
import { Head, Link } from '@inertiajs/vue3';
import { initFlowbite } from 'flowbite';
import { onMounted, ref } from 'vue';

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    user: {
        type: Object,
    },
    users: {
        type: Array,
    },
    comments: {
        type: Object,
    },
    themes: {
        type: Array,
    },
    newUsers: {
        type: Array,
    }
});

const options = {
    chart: {
        height: "100%",
        maxWidth: "100%",
        type: "area",
        fontFamily: "Inter, sans-serif",
        dropShadow: {
            enabled: false,
        },
        toolbar: {
            show: false,
        },
    },
    tooltip: {
        enabled: true,
        x: {
            show: false,
        },
    },
    fill: {
        type: "gradient",
        gradient: {
            opacityFrom: 0.55,
            opacityTo: 0,
            shade: "#1C64F2",
            gradientToColors: ["#1C64F2"],
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        width: 6,
    },
    grid: {
        show: false,
        strokeDashArray: 4,
        padding: {
            left: 2,
            right: 2,
            top: 0
        },
    },
    series: [
        {
            name: "New users",
            data: props.newUsers.map(user => user.count), // Используем количество новых пользователей
            color: "#1A56DB",
        },
    ],
    xaxis: {
        categories: props.newUsers.map(user => user.date), // Используем даты
        labels: {
            show: false,
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
    },
    yaxis: {
        show: false,
    },
};
const options_themes = {
    chart: {
        height: "100%",
        maxWidth: "100%",
        type: "area",
        fontFamily: "Inter, sans-serif",
        dropShadow: {
            enabled: false,
        },
        toolbar: {
            show: false,
        },
    },
    tooltip: {
        enabled: true,
        x: {
            show: false,
        },
    },
    fill: {
        type: "gradient",
        gradient: {
            opacityFrom: 0.55,
            opacityTo: 0,
            shade: "#1C64F2",
            gradientToColors: ["#1C64F2"],
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        width: 6,
    },
    grid: {
        show: false,
        strokeDashArray: 4,
        padding: {
            left: 2,
            right: 2,
            top: 0
        },
    },
    series: [
        {
            name: "New users",
            data: props.themes.map(theme => theme.count), // Используем количество новых пользователей
            color: "#1A56DB",
        },
    ],
    xaxis: {
        categories: props.themes.map(theme => theme.date), // Используем даты
        labels: {
            show: false,
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
    },
    yaxis: {
        show: false,
    },
};

    const searchWord = ref('');
    const word = ref('')
    const searchResults = ref([]);

    const searchUsers = async () => {
        try {
            const response = await axios.post(route('user_search'), {
                word: word.value,
            });
            searchResults.value = response.data;
        } catch (error) {
            console.error('Ошибка при поиске юзера:', error);
        }
    }

    const banUser = async (userId) => {
        try {
            await axios.post(route('ban_user', { id: userId }));
            location.reload();
        } catch (error) {
            console.error('Ошибка при бане пользователя:', error);
        }
    };

    const unbanUser = async (userId) => {
        try {
            await axios.post(route('unban_user', { id: userId }));
            location.reload();
        } catch (error) {
            console.error('Ошибка при разбане пользователя:', error);
        }
    };

    const downloadExcel = async () => {
        try {
            const response = await axios.get(route('excel'), {
                responseType: 'blob', // Указываем, что ожидаем бинарный файл
            });

            // Создаем ссылку для скачивания
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', 'report.xlsx'); // Устанавливаем имя файла
            document.body.appendChild(link);
            link.click();

            // Очищаем объект URL
            window.URL.revokeObjectURL(url);
        } catch (error) {
            console.error('Ошибка при скачивании Excel файла:', error);
        }
    };


    onMounted(() => {
        initFlowbite();

        if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("area-chart"), options);
            chart.render();
        }
        if (document.getElementById("area-chart-2") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("area-chart-2"), options_themes);
            chart.render();
        }

        console.log(props.users);
    });
</script>

<template>
    <Head :title="'Панель администратора'" />

    <Header
        :canLogin="props.canLogin" 
        :canRegister="props.canRegister" 
        :user="props.user"
    />

    <div class="max-w-7xl w-full h-auto p-10 rounded-xl border bg-white border-gray-200 dark:border-zinc-900 dark:bg-zinc-700 my-10 mx-auto">
        <div>
            <h2 class="text-white text-xl font-semibold mb-10">Аналитика</h2>
            <div class="flex mb-10 gap-10">

                <!-- diag 2 -->
                <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div class="flex justify-between">
                      <div>
                        <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{ $page.props.users.length }}</h5>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Всего пользователей</p>
                      </div>
                    </div>
                    <div id="area-chart"></div>
                    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                      <div class="flex justify-between items-center pt-5">
                        <!-- Button -->
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                            За последние 7 дней
                        </p>
                        <!-- Dropdown menu -->
                        <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                              <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                              </li>
                              <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                              </li>
                              <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>
                              </li>
                              <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a>
                              </li>
                              <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a>
                              </li>
                            </ul>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div class="flex justify-between">
                      <div>
                        <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{ $page.props.themes.length }}</h5>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Всего тем</p>
                      </div>
                    </div>
                    <div id="area-chart-2"></div>
                    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                      <div class="flex justify-between items-center pt-5">
                        <!-- Button -->
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                            За последние 7 дней
                        </p>
                        <!-- Dropdown menu -->
                        <div id="lastDaysdropdown-2" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                              <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                              </li>
                              <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                              </li>
                              <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>
                              </li>
                              <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a>
                              </li>
                              <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a>
                              </li>
                            </ul>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="mb-10">
                <button
                    @click="downloadExcel"
                    class="px-4 py-2 bg-red-400 transition-all hover:bg-red-300 text-white font-semibold rounded-md"
                >
                    Скачать в Excel
                </button>
            </div>
            <div class="flex gap-5 mb-5 w-full">
                <form @submit.prevent="searchUsers" method="POST" class="header__search-form flex items-center mb-5 w-full gap-5">
                    <input v-model="word" @input="searchWord" type="search" name="word" id="" class="header__search-input w-full h-14 dark:bg-zinc-600 bg-white dark:border-zinc-900 dark:focus:border-zinc-500 dark:text-white/90 dark:focus:bg-zinc-700 text-gray-800 outline-none px-4 rounded-md focus:ring-1 dark:focus:ring-zinc-500 focus:ring-red-400 focus:ring-offset-red-400 focus:ring-offset-0 transition-all border focus:border-red-400 focus:outline-none focus:shadow-md" placeholder="Поиск...">
                    <button class="w-14 h-14 hover:scale-125 transition-all bg-transparent" type="submit">
                        <svg class="w-14 h-14" viewBox="-2.4 -2.4 28.80 28.80" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="transparent"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect width="24" height="24" fill="transparent"></rect> <path fill-rule="evenodd" clip-rule="evenodd" d="M7.25007 2.38782C8.54878 2.0992 10.1243 2 12 2C13.8757 2 15.4512 2.0992 16.7499 2.38782C18.06 2.67897 19.1488 3.176 19.9864 4.01358C20.824 4.85116 21.321 5.94002 21.6122 7.25007C21.9008 8.54878 22 10.1243 22 12C22 13.8757 21.9008 15.4512 21.6122 16.7499C21.321 18.06 20.824 19.1488 19.9864 19.9864C19.1488 20.824 18.06 21.321 16.7499 21.6122C15.4512 21.9008 13.8757 22 12 22C10.1243 22 8.54878 21.9008 7.25007 21.6122C5.94002 21.321 4.85116 20.824 4.01358 19.9864C3.176 19.1488 2.67897 18.06 2.38782 16.7499C2.0992 15.4512 2 13.8757 2 12C2 10.1243 2.0992 8.54878 2.38782 7.25007C2.67897 5.94002 3.176 4.85116 4.01358 4.01358C4.85116 3.176 5.94002 2.67897 7.25007 2.38782ZM9 11.5C9 10.1193 10.1193 9 11.5 9C12.8807 9 14 10.1193 14 11.5C14 12.8807 12.8807 14 11.5 14C10.1193 14 9 12.8807 9 11.5ZM11.5 7C9.01472 7 7 9.01472 7 11.5C7 13.9853 9.01472 16 11.5 16C12.3805 16 13.202 15.7471 13.8957 15.31L15.2929 16.7071C15.6834 17.0976 16.3166 17.0976 16.7071 16.7071C17.0976 16.3166 17.0976 15.6834 16.7071 15.2929L15.31 13.8957C15.7471 13.202 16 12.3805 16 11.5C16 9.01472 13.9853 7 11.5 7Z" fill="#f87171"></path> </g></svg>
                    </button>
                </form>
            </div>
            <ul class="main__users-list flex flex-col gap-3 w-full" v-if="searchResults.length > 0">
                <li class="w-full h-auto" v-for="user in searchResults" :key="user.id">
                    <p class="px-5 py-2 text-red-400 border-2 text-md uppercase border-red-400 transition-all rounded-md font-semibold flex items-center">
                        <Link :href="`/users/${user.name}`">
                            {{ user.name }} 
                        </Link>
                        <button v-if="user.is_ban == 0" @click="banUser(user.id)" class="ml-auto px-4 py-2 dark:bg-black/20 rounded-md transition-all dark:hover:bg-black/30 bg-black/5 hover:bg-black/10">
                            Забанить
                        </button>
                        <button v-else @click="unbanUser(user.id)" class="ml-auto px-4 py-2 dark:bg-black/20 rounded-md transition-all dark:hover:bg-black/30 bg-black/5 hover:bg-black/10">
                            Разбанить
                        </button>
                    </p>
                </li>
            </ul>
            <ul class="main__users-list flex flex-col gap-3 w-full" v-else>
                <li class="w-full h-auto" v-for="user in $page.props.users" :key="user.id">
                    <p class="px-5 py-2 text-red-400 border-2 text-md uppercase border-red-400 transition-all rounded-md font-semibold flex items-center">
                        <Link :href="`/users/${user.name}`">
                            {{ user.name }} 
                        </Link>
                        <button v-if="user.is_ban == 0" @click="banUser(user.id)" class="ml-auto px-4 py-2 dark:bg-black/20 rounded-md transition-all dark:hover:bg-black/30 bg-black/5 hover:bg-black/10">
                            Забанить
                        </button>
                        <button v-else @click="unbanUser(user.id)" class="ml-auto px-4 py-2 dark:bg-black/20 rounded-md transition-all dark:hover:bg-black/30 bg-black/5 hover:bg-black/10">
                            Разбанить
                        </button>
                    </p>
                </li>
            </ul>
        </div>
    </div>
</template>