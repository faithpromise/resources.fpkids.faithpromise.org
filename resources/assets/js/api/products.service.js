import axios from 'axios';

export default {

    all() {
        return axios.get('/api/products');
    },

    find(id) {
        return axios.get('/api/products/' + id);
    },

    save(product) {
        if (product.id) {
            return axios.post('/api/products', product);
        }
        return axios.put('/api/products/' + product.id, product);
    },

    upload_image(formData) {
        return axios.post('/api/product-images', formData);
    }

}
