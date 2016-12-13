import Vuex from 'vuex';

const state = {
    is_user_authenticated:     false,
    is_logout_warning_visible: false,
    nav_visible:               false,
    cart_visible:              false,
    products:                  [],
    selected_product:          null,
    cart:                      [],
    back_button:               null
};

const mutations = {
    SET_AUTH_STATUS:    function (state, value) {
        state.is_user_authenticated = value;
    },
    SET_LOGOUT_WARNING: function (state, value) {
        state.is_logout_warning_visible = value;
    },
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
};

const actions = {
    SET_AUTH_STATUS:    function (context, value) {
        context.commit('SET_AUTH_STATUS', value);
    },
    SET_LOGOUT_WARNING: function (context, value) {
        context.commit('SET_LOGOUT_WARNING', value);
    }
};

export default new Vuex.Store({
    state,
    mutations,
    actions
});