<template>
  <div class="CartWrapper">

    <div class="Cart">

      <h1 class="Cart-title">Your Cart</h1>

      <p class="Cart-subtitle">Items will be delivered the Monday before the first weekend of each month.</p>

      <ul class="Cart-list">
        <li class="Cart-item" v-for="(product, index) in cart">

          <div class="CartItem">
            <div class="CartItem-imageWrap">
              <div class="CartItem-image" v-bind:style="{ backgroundImage: product.image_url ? ('url(' + product.image_url + ')') : 'none' }"></div>
            </div>
            <div class="CartItem-info">
              <router-link class="CartItem-name" v-bind:to="{ name: 'product', params: { id: product.id } }">{{ product.name }}</router-link>
              <p class="CartItem-description" v-if="product.choices">{{ product.choices }}</p>
            </div>
            <div class="CartItem-qty">
              <select v-model="product.quantity">
                <option v-for="qty in product.quantities" v-bind:value="qty">{{ qty }}</option>
              </select>
            </div>
            <div class="CartItem-remove">
              <span class="CartItem-removeLink" v-on:click="remove(index)">Remove Item</span>
            </div>
          </div>

        </li>
      </ul>

      <router-link class="Button" v-bind:to="{ name: 'products' }" v-if="cart.length > 0">Keep Shopping</router-link>
      <button class="Button Button--order" v-if="cart.length > 0">Place Order</button>

      <div class="Cart-empty" v-if="cart.length === 0">
        Your cart is empty. Add some items!
      </div>

    </div>

  </div>
</template>
<script>

  const back_button = { label: 'Products', route: { name: 'products' } };

  export default {

    created () {
      this.$store.commit("UPDATE_BACK_BUTTON", back_button);
    },

    beforeDestroy() {
      this.$store.commit("REMOVE_BACK_BUTTON", back_button);
    },

    data () {
      return {}
    },

    methods:  {
      remove (index) {
        this.$store.commit('REMOVE_FROM_CART', index);
      }
    },

    computed: {
      cart () {
        return this.$store.state.cart;
      }
    }
  }
</script>