import Home from './pages/Home.vue';
import Products from './pages/Products.vue';
import ProductDetail from './pages/ProductDetail.vue';

const routes = [
    {
        name:      'home',
        path:      '/',
        redirect:  'products',
        component: Home,
        children:  [
            {
                name:      'products',
                path:      '/products',
                component: Products
            },
            {
                name:      'product',
                path:      ':id',
                component: ProductDetail
            }
        ]
    }
];

const router = new VueRouter({
                    routes,
    mode:           'history',
    scrollBehavior: (to, from, savedPosition) => {
        return savedPosition ? savedPosition : { x: 0, y: 0 }
    }
});

export default router;