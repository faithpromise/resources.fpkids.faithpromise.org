import Home from './pages/Home.vue';
import Products from './pages/Products.vue';
import ProductDetail from './pages/ProductDetail.vue';
import Checkout from './pages/Checkout.vue';
import Orders from './pages/Orders.vue';
import OrderDetail from './pages/OrderDetail.vue';

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
                path:      '/products/:id',
                component: ProductDetail
            },
            {
                name:      'checkout',
                path:      '/checkout',
                component: Checkout
            },
            {
                name:      'my_orders',
                path:      '/orders',
                component: Orders
            },
            {
                name:      'my_order',
                path:      '/orders/:id',
                component: OrderDetail
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