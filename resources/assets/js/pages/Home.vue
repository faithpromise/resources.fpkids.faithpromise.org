<template>
  <div class="Layout-container" v-bind:class="{ 'nav-open': nav_visible }" v-on:click="hide_nav">
    <div class="Layout-menu Layout-menu--nav">
      <div class="Nav">
        <ul class="Nav-list">
          <li class="Nav-item">
            <router-link v-bind:to="{ name: 'products' }">All Products</router-link>
          </li>
        </ul>
      </div>
    </div>
    <div class="Layout-menu Layout-menu--cart">
      <cart></cart>
    </div>
    <div class="Layout-pusher">
      <div class="Layout-content">
        <div class="Layout-content-inner">
          <router-view></router-view>
        </div>
      </div>
    </div>
  </div>
</template>
<script>

  import Cart from '../components/Cart.vue';

  function hasParentClass(e, class_name) {

    if (e === document) {
      return false
    }

    if (e.classList.contains(class_name)) {
      return true;
    }

    return e.parentNode && hasParentClass(e.parentNode, class_name);

  }

  export default {
    components: {
      'cart': Cart
    },
    methods:    {
      hide_nav:    function (evt) {
        if (!hasParentClass(evt.target, 'Layout-menu')) {
          this.$store.commit('HIDE_NAV');
        }
      },
      toggle_nav:  function (evt) {
        evt.stopPropagation();
        evt.preventDefault();
        this.$store.commit('TOGGLE_NAV');
      },
      toggle_cart: function () {
        this.$store.commit('TOGGLE_CART');
      }
    },
    computed:   {
      nav_visible:  function () {
        return this.$store.state.nav_visible;
      },
      cart_visible: function () {
        return this.$store.state.cart_visible;
      }
    }
  }
</script>