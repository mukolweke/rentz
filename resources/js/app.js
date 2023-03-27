import {
    createApp,
    h
} from 'vue';
import {
    createInertiaApp,
    Link
} from '@inertiajs/vue3';
import {
    resolvePageComponent
} from 'laravel-vite-plugin/inertia-helpers';
import '../css/app.css';
import Modal from './Components/Modal.vue';

createInertiaApp({
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`,
        import.meta.glob('./Pages/**/*.vue')),
    setup({
        el,
        App,
        props,
        plugin
    }) {
        return createApp({
                render: () => h(App, props)
            })
            .mixin({
                methods: {
                    route
                }
            })
            .component('Link', Link)
            .component('Modal', Modal)
            .use(plugin)
            .mount(el)
    },
});
