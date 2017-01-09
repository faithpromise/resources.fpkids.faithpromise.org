import axios from 'axios';

export default {

    find(id) {
        return axios.get('/api/orders/' + id);
    },

    byEmail(email) {
        return axios.get('/api/orders?email=' + email);
    },

    packaging() {
        return axios.get('/api/packaging');
    },

    update(item) {
        return axios.put('/api/order-items/' + item.id, item);
    }

}
