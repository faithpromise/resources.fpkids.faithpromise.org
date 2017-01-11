import axios from 'axios';
import router from './routes';
import jwtDecode from 'jwt-decode';
import authService from './api/auth.service';

const LOGIN_REDIRECT_TO = '/admin/products';
const LOGIN_ROUTE_NAME  = 'login';

axios.interceptors.request.use(function (config) {
    config.headers = { 'Authorization': 'Bearer ' + localStorage.getItem('id_token') };
    return config;
}, function (error) {
    // Do something with request error
    // return Promise.reject(error);
});

console.log(typeof router);

export default {

    get_seconds_until_logout,
    is_authenticated,
    logout,
    refresh,

    login(credentials, redirect = LOGIN_REDIRECT_TO) {

        return authService.login(credentials).then((result) => {

            localStorage.setItem('id_token', result.data.token);

            if (redirect) router.push(redirect);

        });
    }

}

function is_authenticated() {
    return get_seconds_until_logout() > 0;
}

function get_seconds_until_logout() {
    let jwtStr            = localStorage.getItem('id_token');
    let seconds_remaining = (typeof jwtStr === 'string') ? (jwtDecode(jwtStr).exp - Date.now() / 1000) : 0;
    let buffer            = 50; // Don't go down to the last second to avoid (user) race condition issues.

    return Math.round(Math.max(0, seconds_remaining - buffer));
}

function refresh() {
    return authService.refresh().then((result) => {
        localStorage.setItem('id_token', result.data.token);
    });
}

function logout() {
    localStorage.removeItem('id_token');
    router.push({ name: LOGIN_ROUTE_NAME });
}