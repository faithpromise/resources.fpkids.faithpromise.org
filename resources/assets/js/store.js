import Vuex from 'vuex';

const store = new Vuex.Store({
    state:     {
        nav_visible:      false,
        cart_visible:     false,
        products:         [],
        selected_product: null,
        cart:             [],
        back_button:      null
    },
    mutations: {
        HIDE_NAV:           function (state) {
            state.nav_visible     = false;
            state.filters_visible = false;
        },
        TOGGLE_NAV:         function (state) {
            state.nav_visible = !state.nav_visible;
        },
        TOGGLE_CART:        function (state) {
            state.cart_visible = !state.cart_visible;
        },
        UPDATE_PRODUCTS:    function (state, products) {
            state.products = products;
        },
        SELECT_PRODUCT:     function (state, product) {
            state.selected_product = product;
        },
        DESELECT_PRODUCT:   function (state) {
            state.selected_product = null;
        },
        ADD_TO_CART:        function (state, product) {
            state.cart.push({
                id:         product.id,
                name:       product.name,
                image_url:  product.image_url,
                quantity:   product.quantity,
                quantities: product.quantities, // Add quantities to cart so they can be changed on cart/checkout page
                choices:    product.choices ? product.choices : null
            });
        },
        REMOVE_FROM_CART:   function (state, index) {
            state.cart.splice(index, 1);
        },
        EMPTY_CART:         function (state) {
            state.cart = [];
        },
        UPDATE_BACK_BUTTON: function (state, btn) {
            state.back_button = btn;
        },
        REMOVE_BACK_BUTTON: function (state, button = null) {
            if (state.back_button === button || button === null) {
                state.back_button = null;
            }
        }
    }
});

export default store;