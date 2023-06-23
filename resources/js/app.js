import {
    createApp,
    h
} from 'vue';
import {
    createInertiaApp,
    Link
} from '@inertiajs/vue3';
import Modal from './Components/Modal.vue';

createInertiaApp({
    resolve: (name) => require(`./Pages/${name}.vue`),
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

// .catch(() => console.log('Error loading app'))
