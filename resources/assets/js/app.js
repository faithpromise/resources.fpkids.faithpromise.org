import Vue from 'vue';
import store from './store';
import router from './routes';
import axios from 'axios';
import auth from './auth';

Vue.prototype.$http = axios;

var countdown_timer;

const app = new Vue({
        router,
        store,
    el: '#app',

    data: function () {
        return {
            logout_countdown: null
        }
    },

    created: function () {
        toggle_countdown(this);
    },

    computed: {
        is_authenticated() {
            return this.$store.state.is_user_authenticated;
        },
        is_logout_warning_visible() {
            return this.$store.state.is_logout_warning_visible;
        }
    },

    watch: {
        is_logout_warning_visible: function () {
            toggle_countdown(this);
        }
    }
});

function toggle_countdown(app) {
    clearInterval(countdown_timer);

    if (!app.is_logout_warning_visible)
        return;

    app.logout_countdown = auth.get_seconds_until_logout();

    countdown_timer = setInterval(() => {
        console.log('countdown', app.logout_countdown);
        app.logout_countdown = app.logout_countdown - 1;
    }, 1000);
}