import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Enigma';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

// Функция смены цветовой темы
document.addEventListener("DOMContentLoaded", (event) => {
    const themeToggleDarkIcon = document.getElementById(
        "theme-toggle-dark-icon"
    );
    const themeToggleLightIcon = document.getElementById(
        "theme-toggle-light-icon"
    );

    const themeToggleBtn = document.getElementById("theme-toggle");
    const currentTheme = localStorage.getItem("color-theme");

    if (currentTheme) {
        document.documentElement.classList.add(currentTheme);
        if (currentTheme === "dark") {
            themeToggleLightIcon.classList.remove("hidden");
        } else {
            themeToggleDarkIcon.classList.remove("hidden");
        }
    } else {
        if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
            document.documentElement.classList.add("dark");
            themeToggleLightIcon.classList.remove("hidden");
            localStorage.setItem("color-theme", "dark");
        } else {
            themeToggleDarkIcon.classList.remove("hidden");
        }
    }

    themeToggleBtn.addEventListener("click", function () {
        document.documentElement.classList.toggle("dark");
        if (document.documentElement.classList.contains("dark")) {
            themeToggleLightIcon.classList.remove("hidden");
            themeToggleDarkIcon.classList.add("hidden");
            localStorage.setItem("color-theme", "dark");
        } else {
            themeToggleLightIcon.classList.add("hidden");
            themeToggleDarkIcon.classList.remove("hidden");
            localStorage.setItem("color-theme", "light");
        }
    });
});