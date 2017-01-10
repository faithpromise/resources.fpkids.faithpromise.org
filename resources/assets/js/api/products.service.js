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
            return axios.put('/api/products/' + product.id, product);
        }
        return axios.post('/api/products', product);
    },

    delete(id) {
        return axios.delete('/api/products/' + id);
    },

    upload_image(formData) {
        return axios.post('/api/product-images', formData);
    }

}
