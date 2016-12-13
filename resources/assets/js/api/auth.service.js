import axios from 'axios';

const LOGIN_URL = '/api/login';

export default {

    login(creds) {
        return axios.post(LOGIN_URL, creds);
    },

    refresh() {

    }

}