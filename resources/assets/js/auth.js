import router from './routes';

const LOGIN_URL = '/api/login';

export default {

    user: {
        authenticated: false
    },

    login (context, creds, redirect = '/admin') {

        context.$http.post(LOGIN_URL, creds).then(

            (data) => {

                console.log('auth data', data);

                localStorage.setItem('id_token', data.body.token);

                this.user.authenticated = true;

                if (redirect) {
                    router.push(redirect);
                }

            },
            (err) => {
                context.error = err.body.error;
            }

        );

    },

    logout() {
        localStorage.removeItem('id_token');
        this.user.authenticated = false;
    },

    checkAuth() {
        var jwt = localStorage.getItem('id_token');

        this.user.authenticated = jwt ? true : false;
    },

    getAuthHeader() {
        return {
            'Authorization': 'Bearer ' + localStorage.getItem('id_token')
        }
    }

}