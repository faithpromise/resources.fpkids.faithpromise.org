import axios from 'axios';
import router from './routes';
import store from './store';
import jwtDecode from 'jwt-decode';
import authService from './api/auth.service';

const LOGIN_REDIRECT_TO = '/admin/products';

let logout_timer         = null;
let logout_warning_timer = null;

updateAuthStatus();
set_timers();

axios.interceptors.request.use(function (config) {
    config.headers = { 'Authorization': 'Bearer ' + localStorage.getItem('id_token') };
    return config;
}, function (error) {
    // Do something with request error
    // return Promise.reject(error);
});

function updateAuthStatus() {
    console.log('updateAuthStatus');
    store.dispatch('SET_AUTH_STATUS', is_authenticated());
    store.dispatch('SET_LOGOUT_WARNING', should_show_logout_warning());
}

function is_authenticated() {
    return get_seconds_until_logout() > 0;
}

function get_seconds_until_logout() {
    let jwtStr            = localStorage.getItem('id_token');
    let seconds_remaining = (typeof jwtStr === 'string') ? (jwtDecode(jwtStr).exp - Date.now() / 1000) : 0;

    return Math.round(Math.max(0, seconds_remaining));
}

function get_seconds_until_warning() {
    return Math.max(get_seconds_until_logout() - 180, 0);
}

function should_show_logout_warning() {
    return is_authenticated() && get_seconds_until_warning() < 2; // Buffer it a bit in case timeout is off
}

function set_timers() {

    let seconds_remaining_until_logout  = get_seconds_until_logout();
    let seconds_remaining_until_warning = get_seconds_until_warning();

    console.log('seconds_remaining_until_logout', seconds_remaining_until_logout);
    console.log('seconds_remaining_until_warning', seconds_remaining_until_warning);

    clearTimeout(logout_timer);
    clearTimeout(logout_warning_timer);

    if (seconds_remaining_until_logout) {

        logout_timer = setTimeout(() => {
            logout();
        }, seconds_remaining_until_logout * 1000);

        logout_warning_timer = setTimeout(() => {
            updateAuthStatus();
        }, seconds_remaining_until_warning * 1000);

    }

}

function logout() {
    localStorage.removeItem('id_token');
    updateAuthStatus();
    router.push({ name: 'login' });
}

export default {

    user: {},

    get_seconds_until_logout,
    is_authenticated,
    logout,

    login(context, creds, redirect = LOGIN_REDIRECT_TO) {

        authService.login(creds).then(
            (result) => {

                localStorage.setItem('id_token', result.data.token);

                updateAuthStatus();
                set_timers();

                if (redirect) router.push(redirect);

            },
            (err) => {
                context.error = err.body.error;
            }
        );
    }

}