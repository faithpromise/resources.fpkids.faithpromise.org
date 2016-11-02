<template>
  <div class="CartPreview" v-bind:class="{ 'has-items' : cart.length > 0 }">
    <div class="CartPreview-container">

      <div class="CartPreview-back">
        <router-link class="CartPreview-link" v-if="back_button" v-bind:to="back_button.route">
          <svg class="CartPreview-icon">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#chevron-left"></use>
          </svg>
          {{ back_button.label }}
        </router-link>
      </div>

      <div class="CartPreview-logo">
        <img class="CartPreview-logoImage" src="/images/fpkids.svg">
      </div>

      <div class="CartPreview-checkout">
        <router-link class="CartPreview-link" v-bind:to="{ name: 'checkout' }">
          <svg class="CartPreview-icon">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cart"></use>
          </svg>
          {{ cart.length }} Item{{ cart.length === 1 ? '' : 's' }}
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