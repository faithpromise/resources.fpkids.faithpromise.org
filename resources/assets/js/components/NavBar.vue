<template>
  <div class="NavBar" v-bind:class="{ 'has-items' : cart.length > 0 }">
    <div class="NavBar-container">

      <div class="NavBar-back">
        <router-link class="NavBar-link" v-if="back_button" v-bind:to="back_button.route">
          <svg class="NavBar-icon">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chevron-left"></use>
          </svg>
          {{ back_button.label }}
        </router-link>
      </div>

      <router-link class="NavBar-logo" v-bind:to="{ name: 'products' }">
        <img class="NavBar-logoImage" src="/images/fpkids.svg">
      </router-link>

      <div class="NavBar-account">
        <router-link class="NavBar-link NavBar-link--account" v-bind:to="{ name: 'my_orders' }">
          <svg class="NavBar-icon">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
          </svg>
        </router-link>
        <router-link class="NavBar-link" v-bind:to="{ name: 'checkout' }">
          <svg class="NavBar-icon">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cart"></use>
          </svg>
          <span class="Navbar-cartQty" v-if="cart.length">{{ cart.length }}</span>
        </router-link>
      </div>

    </div>

  </div>
</template>
<script>

  export default {
    data:     function () {
      return {}
    },
    methods:  {
      remove_from_cart: function (product) {
        this.$store.commit('REMOVE_FROM_CART', product);
      }
    },
    computed: {
      cart: function () {
        return this.$store.state.cart;
      },
      back_button: function() {
        return this.$store.state.back_button;
      }
    }
  }
</script>