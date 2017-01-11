import axios from 'axios';

const LOGIN_URL = '/api/login';
const REFRESH_URL = '/api/login/refresh';

export default {

    login(creds) {
        return axios.post(LOGIN_URL, creds);
    },

    refresh() {
        return axios.get(REFRESH_URL);
    }

}