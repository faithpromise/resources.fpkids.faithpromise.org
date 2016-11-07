import Vue from 'vue';
import store from './store';
import router from './routes';

Vue.http.interceptors.push((request, next) => {

    // Send JWT token with each request
    request.headers.append('Authorization', 'Bearer ' + localStorage.getItem('id_token'));

    // Catch unauthorized responses from server and redirect to login
    next((response) => {
        if (response.status === 401) {
            return router.push({ name: 'login' });
        }
    });

});

const app = new Vue({
           router,
    store: store,
    el:    '#app'
});
