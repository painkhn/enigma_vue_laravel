<script setup>
    import PageLogo from '@/Components/PageLogo.vue';
    import { Link } from '@inertiajs/vue3';
    import { onMounted } from 'vue';

    const props = defineProps({
        canLogin: {
            type: Boolean,
        },
        canRegister: {
            type: Boolean,
        },
        user: {
            type: Object,
        }
    });
    
    onMounted(() => {
        console.log(props.user)
    })
</script>

<template>
    <div class="w-full bg-white border-b border-slate-200 dark:bg-zinc-700 dark:border-zinc-900">
        <header class="header max-w-7xl w-full h-14 grid grid-cols-3 items-center mx-auto my-0 gap-2 rounded-md">
            <PageLogo />
            <nav class="justify-self-center justify-center flex items-center gap-3 w-full">
                <Link :href="'/'" class="dark:hover:text-white/80 dark:text-white/90 text-gray-600 transition-all flex items-center h-14 px-2 dark:hover:bg-zinc-600 hover:text-red-400 font-medium hover:border-b-2 hover:bg-slate-50 hover:border-red-400">
                    Главная
                </Link>
                <Link :href="route('themeCreate')" class="dark:hover:text-white/80 dark:text-white/90 text-gray-600 transition-all flex items-center dark:hover:bg-zinc-600 hover:text-red-400 h-14 font-medium hover:border-b-2 hover:bg-slate-50 px-2 hover:border-red-400">
                    Создать тему
                </Link>
                <Link :href="'/'" v-if="$page.props.auth.user && $page.props.auth.user.is_admin == 1" class="dark:hover:text-white/80 dark:text-white/90 text-gray-600 header__admin-link transition-all flex px-2 items-center dark:hover:bg-zinc-600 hover:text-red-400 hover:bg-slate-50 h-14 font-medium hover:border-b-2 hover:border-red-400">
                    Панель администратора
                </Link>
            </nav>
            <Link
                v-if="$page.props.auth.user"
                :href="route('profile', { name: $page.props.auth.user.name})"
                class="rounded-md px-3 font-semibold py-2 text-gray-600 ring-1 ring-transparent transition hover:text-red-400 focus:outline-none focus-visible:ring-[#FF2D20] dark:hover:bg-zinc-600 dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                {{ $page.props.auth.user.name }}
            </Link>
            <!-- <nav v-if="canLogin" class="flex flex-1 justify-self-end">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('profile', { name: $page.props.auth.user.name})"
                    class="rounded-md px-3 font-semibold py-2 text-black ring-1 ring-transparent transition hover:text-red-400 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    {{ $page.props.auth.user.name }}
                </Link>

                <template v-else>
                    <Link
                        :href="route('login')"
                        class="rounded-md px-3 py-2 font-semibold text-black ring-1 ring-transparent transition hover:text-red-400 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Вход
                    </Link>

                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="rounded-md px-3 py-2 font-semibold text-black ring-1 ring-transparent transition hover:text-red-400 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Регистрация
                    </Link>
                </template>
            </nav> -->
        </header>
    </div>
    <slot></slot>
</template>