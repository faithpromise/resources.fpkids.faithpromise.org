import Home from './pages/Home.vue';
import Products from './pages/Products.vue';
import ProductDetail from './pages/ProductDetail.vue';
import Checkout from './pages/Checkout.vue';
import Orders from './pages/Orders.vue';
import OrderDetail from './pages/OrderDetail.vue';

// Admin
import Admin from './pages/Admin.vue';
import AdminLogin from './pages/AdminLogin.vue';
import AdminProducts from './pages/AdminProducts.vue';
import AdminProductEdit from './pages/AdminProductEdit.vue';
import AdminOrders from './pages/AdminOrders.vue';
import auth from './auth';

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
    },
    {
        name:      'admin',
        path:      '/admin',
        redirect:  '/admin/products',
        component: Admin,
        meta:      {
            requires_login: true
        },
        children:  [
            {
                name:      'admin_products',
                path:      '/admin/products',
                component: AdminProducts
            },
            {
                name:      'admin_product_new',
                path:      '/admin/products/new',
                component: AdminProductEdit
            },
            {
                name:      'admin_product_edit',
                path:      '/admin/products/:id',
                component: AdminProductEdit
            },
            {
                name:      'admin_orders',
                path:      '/admin/orders',
                component: AdminOrders
            }
        ]
    },
    {
        name:      'login',
        path:      '/admin/login',
        component: AdminLogin
    }
];

const router = new VueRouter({
                    routes,
    mode:           'history',
    scrollBehavior: (to, from, savedPosition) => {
        return savedPosition ? savedPosition : { x: 0, y: 0 }
    }
});


router.beforeEach((to, from, next) => {

    // console.log('to', to);
    // console.log('from', from);

    // Set body class
    document.body.classList.remove(from.name + '_page');
    document.body.classList.add(to.name + '_page');

    // Check login
    let requires_login = false;

    to.matched.forEach((route) => {
        requires_login = route.meta.hasOwnProperty('requires_login') ? route.meta.requires_login : requires_login;
    });

    // Login page does not require login
    requires_login = to.name === 'login' ? false : requires_login;

    if (requires_login && !auth.is_authenticated()) {
        next({ name: 'login' });
    } else {
        next();
    }

});

export default router;