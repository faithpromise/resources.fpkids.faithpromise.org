import Vue from 'vue';
import store from './store';
import router from './routes';
import axios from 'axios';
import logoutCountdown from './components/logout-countdown.vue';

Vue.prototype.$http = axios;

const app = new Vue({
    router,
    store,
    el:         '#app',
    components: {
        logoutCountdown
    }
});
