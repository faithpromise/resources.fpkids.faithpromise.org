import home from './route_components/route-home.vue';
import products from './route_components/route-products.vue';
import productDetail from './route_components/route-product-detail.vue';
import checkout from './route_components/route-checkout.vue';
import orders from './route_components/route-orders.vue';
import orderDetail from './route_components/route-order-detail.vue';

// Admin
import admin from './route_components/route-admin.vue';
import adminLogin from './route_components/route-admin-login.vue';
import adminProducts from './route_components/route-admin-products.vue';
import adminProductEdit from './route_components/route-admin-product-edit.vue';
import adminOrders from './route_components/route-admin-orders.vue';
import auth from './auth';

const LOGIN_ROUTE_NAME = 'login';

const routes = [
    {
        name:      'home',
        path:      '/',
        redirect:  'products',
        component: home,
        children:  [
            {
                name:      'products',
                path:      '/products',
                component: products
            },
            {
                name:      'product',
                path:      '/products/:id',
                component: productDetail
            },
            {
                name:      'checkout',
                path:      '/checkout',
                component: checkout
            },
            {
                name:      'my_orders',
                path:      '/orders',
                component: orders
            },
            {
                name:      'my_order',
                path:      '/orders/:id',
                component: orderDetail
            }
        ]
    },
    {
        name:      'admin',
        path:      '/admin',
        redirect:  '/admin/products',
        component: admin,
        meta:      {
            requires_login: true
        },
        children:  [
            {
                name:      'admin_products',
                path:      '/admin/products',
                component: adminProducts
            },
            {
                name:      'admin_product_new',
                path:      '/admin/products/new',
                component: adminProductEdit
            },
            {
                name:      'admin_product_edit',
                path:      '/admin/products/:id',
                component: adminProductEdit
            },
            {
                name:      'admin_orders',
                path:      '/admin/orders',
                component: adminOrders
            }
        ]
    },
    {
        name:      'login',
        path:      '/admin/login',
        component: adminLogin
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

    // Check login
    let requires_login = false;

    to.matched.forEach((route) => {
        requires_login = route.meta.hasOwnProperty('requires_login') ? route.meta.requires_login : requires_login;
    });

    // Login page does not require login
    requires_login = to.name === LOGIN_ROUTE_NAME ? false : requires_login;

    if (requires_login && !auth.is_authenticated()) {
        next({ name: LOGIN_ROUTE_NAME });
    } else {
        next();
    }

});

export default router;