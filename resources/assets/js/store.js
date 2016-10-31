import Vuex from 'vuex';

const store = new Vuex.Store({
    state:     {
        nav_visible:      false,
        cart_visible:     false,
        products:         [],
        selected_product: {},
        cart:             []
    },
    mutations: {
        HIDE_NAV:         function (state) {
            state.nav_visible     = false;
            state.filters_visible = false;
        },
        TOGGLE_NAV:       function (state) {
            state.nav_visible = !state.nav_visible;
        },
        TOGGLE_CART:      function (state) {
            state.cart_visible = !state.cart_visible;
        },
        UPDATE_PRODUCTS:  function (state, products) {
            state.products = products;
        },
        SELECT_PRODUCT:   function (state, product) {
            state.selected_product = product;
        },
        DESELECT_PRODUCT: function (state) {
            state.selected_product = {};
        },
        ADD_TO_CART:      function (state, product) {
            state.cart.push({
                id:        product.id,
                name:      product.name,
                image_url: product.image_url,
                quantity:  product.quantity,
                choices:   product.choices ? product.choices : null
            });
        }
    }
});

export default store;