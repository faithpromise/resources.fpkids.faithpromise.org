<template>
  <div class="Cart">
    <div class="Cart-container">
      <div class="Cart-logo">
        <img class="Cart-logoImage" src="/images/fpkids.svg">
      </div>
      <ul class="CartList">
        <li class="CartList-item" v-for="product in cart">
          <div class="CartItem">
            <div class="CartItem-imageWrap">
              <div class="CartItem-image" v-bind:style="{ backgroundImage: product.image_url ? ('url(' + product.image_url + ')') : 'none' }"></div>
            </div>
            <div class="CartItem-info">
              <h2 class="CartItem-name">{{ product.name }} ({{ product.quantity}})</h2>
              <p class="CartItem-description" v-if="product.choices">{{ product.choices }}</p>
            </div>
          </div>
        </li>
      </ul>

      <div class="Cart-empty" v-if="cart.length === 0">
        Your cart is empty. Add some items!
      </div>
    </div>

    <button class="Button Button--order" v-if="cart.length > 0">Order Items</button>

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