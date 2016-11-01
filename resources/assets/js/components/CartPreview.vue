<template>
  <div class="CartPreview" v-bind:class="{ 'has-items' : cart.length > 0 }">
    <div class="CartPreview-container">
      <div class="CartPreview-logo">
        <img class="CartPreview-logoImage" src="/images/fpkids.svg">
      </div>

      <div class="CartPreview-content" v-if="cart.length === 0">
        <span>Your cart is empty. Add some items!</span>
      </div>

      <div class="CartPreview-checkout" v-if="cart.length > 0">
        <router-link class="CartPreview-link" to="/cart">
          Continue With {{ cart.length }} Items
          <svg class="CartPreview-icon">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hand-right"></use>
          </svg>
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
      }
    }
  }
</script>