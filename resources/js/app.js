/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { createApp } from 'vue';

window.Vue = require('vue').default;

const app = createApp({});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// app.component('example-component', require('./components/ExampleComponent.vue').default);

app.component('app', require('./components/App.vue').default);

app.component('recipelist', require('./components/RecipeList.vue').default);

app.component('recipecardsmall', require('./components/RecipeCardSmall.vue').default);

app.component('ingredienttray', require('./components/IngredientTray.vue').default);

app.component('newrecipeform', require('./components/NewRecipeForm.vue').default);

app.component('headernav', require('./components/HeaderNav.vue').default);

app.component('pantry', require('./components/Pantry.vue').default);

app.component('infomodal', require('./components/InfoModal.vue').default);

app.component('pictureinput', require('./components/PictureInput.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 app.mount('#app');