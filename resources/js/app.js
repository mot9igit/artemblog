/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import store from './store';
import PrimeVue from 'primevue/config';
import { definePreset } from '@primeuix/themes';
import Aura from '@primeuix/themes/aura';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

import ConfirmationService from 'primevue/confirmationservice';
import ToastService from 'primevue/toastservice';

import.meta.glob([
    '../assets/**',
]);

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const MachinestorePreset = definePreset(Aura, {
    semantic: {
        primary: {
            50: '#F92C0D',
            100: '#F92C0D',
            200: '#F92C0D',
            300: '#F92C0D',
            400: '#F92C0D',
            500: '#F92C0D',
            600: '#F92C0D',
            700: '#F92C0D',
            800: '#F92C0D',
            900: '#F92C0D',
            950: '#F92C0D'
        }
    }
});

const app = createApp({});
app.use(PrimeVue, {
    theme: {
        preset: MachinestorePreset
    }
});
app.use(store);
app.use(ConfirmationService);
app.use(ToastService);
// app.use(Vue2Editor);

import CreateProductCategoryComponent from './components/admin/product/category/CreateComponent.vue';
import ShowProductCategoryComponent from './components/admin/product/category/ShowComponent.vue';
import ShowSystemGeoComponent from './components/admin/system/geo/ShowComponent.vue';
import UserComponent from './components/admin/user/show.vue';
import ProfileFormComponent from './components/admin/profile/form.vue';
app.component('create-product-category-component', CreateProductCategoryComponent);
app.component('show-product-category-component', ShowProductCategoryComponent);
app.component('profile-form-component', ProfileFormComponent);
app.component('show-user-component', UserComponent);
app.component('show-system-geo-component', ShowSystemGeoComponent);
app.component('QuillEditor', QuillEditor)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

/*Object.entries(import.meta.glob('./!**!/!*.vue', { eager: true })).forEach(([path, definition]) => {
    console.log(path.split('/').pop().replace(/\.\w+$/, ''))
    console.log(definition)
    app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
});*/

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
