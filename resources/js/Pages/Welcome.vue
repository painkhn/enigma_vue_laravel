<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PageLogo from '@/Components/PageLogo.vue'
import HeaderSearch from '@/Components/HeaderSearch.vue'
import MainPageContent from '@/Components/MainPageContent.vue'
import GuestWelcome from '@/Components/GuestWelcome.vue'
import Footer from '@/Components/Footer.vue'

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Главная страница" />

    <div class="text-black/50 dark:bg-black dark:text-white/50">
        <div
            class="relative flex min-h-screen flex-col items-center selection:bg-[#f87171] selection:text-white"
        >
            <div class="w-full max-w-2xl px-6 lg:max-w-7xl">
                <header
                    class="grid grid-cols-2 items-center gap-2 py-10"
                >
                    <div class="flex justify-self-start lg:col-start-1 lg:justify-center">
                        <PageLogo />
                    </div>
                    <!-- <HeaderSearch class="focus:shadow-red-400" /> -->
                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
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

                <main class="mt-6">
                    <MainPageContent v-if="$page.props.auth.user" />                    

                    <GuestWelcome v-else />
                </main>

                <Footer />
            </div>
        </div>
    </div>
</template>
