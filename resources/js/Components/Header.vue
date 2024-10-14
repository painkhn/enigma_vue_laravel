<script setup>
    import PageLogo from './PageLogo.vue';
    import { Link } from '@inertiajs/vue3';

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
</script>

<template>
    <div class="w-full bg-white shadow-xl">
        <header class="header max-w-7xl w-full h-14 flex items-center justify-between mx-auto my-0 gap-2 rounded-md">
            <Link href="/">
                <PageLogo />
            </Link>
            <!-- <Link v-if="$page.props.auth.user.is_admin == 1" class="header__admin-link transition-all hover:text-red-400 font-medium">
                Панель администратора
            </Link> -->
            <nav v-if="canLogin" class="flex flex-1 justify-end">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('profile', { name: $page.props.auth.user.name})"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-red-400 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    {{ $page.props.auth.user.name }}
                </Link>

                <template v-else>
                    <Link
                        :href="route('login')"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-red-400 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Вход
                    </Link>

                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-red-400 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Регистрация
                    </Link>
                </template>
            </nav>
        </header>
    </div>
</template>