import Vue from 'vue';
import store from './store';
import router from './routes';

const app = new Vue({
           router,
    store: store,
    el:    '#app'
});