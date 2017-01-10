<template>

  <div>

    <div class="ProductAdded" v-if="order_placed">

      <h2 class="ProductAdded-title">Your order has been placed!</h2>

      <p>
        <router-link class="Button Button--primary" v-bind:to="{ name: 'my_orders' }">View Your Orders</router-link>
      </p>

    </div>

    <div class="Cart" v-if="!order_placed">

      <div v-if="cart.length">

        <div class="Section-header">
          <h2 class="Section-heading">Your Cart</h2>
          <p class="Section-subtitle">Items will be delivered the Monday before the first weekend of each month.</p>
        </div>

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
                <select class="Form-control" v-model="product.quantity">
                  <option v-for="qty in product.quantities" v-bind:value="qty">{{ qty }}</option>
                </select>
              </div>
              <div class="CartItem-remove">
                <span class="CartItem-removeLink" v-on:click="remove(index)">Remove</span>
              </div>
            </div>

          </li>
        </ul>

        <div class="Section-header">
          <h2 class="Section-heading">Complete Your Order</h2>
          <p class="Section-subtitle">Please provide your campus and email address.</p>
        </div>

        <div class="CheckoutForm-wrap">
          <form class="CheckoutForm" v-on:submit.prevent="submitOrder">
            <div class="Form-group CheckoutForm--campus">
              <select class="Form-control" v-model="campus" required>
                <option v-bind:value="null">Choose a Campus</option>
                <option value="Anderson">Anderson</option>
                <option value="Blount">Blount</option>
                <option value="Campbell">Campbell</option>
                <option value="North Knox">North Knox</option>
                <option value="Pellissippi">Pellissippi</option>
              </select>
            </div>
            <div class="Form-group CheckoutForm--email">
              <input class="Form-control" type="email" placeholder="Email" v-model="email" required>
            </div>
            <div class="Form-group CheckoutForm--submit">
              <button class="Button Button--order Button--flush" v-if="cart.length > 0">Place Order</button>
            </div>
          </form>
        </div>

      </div>

      <div class="Cart-empty" v-if="cart.length === 0">
        Your cart is empty.
        <router-link v-bind:to="{ name: 'products' }">Add some items!</router-link>
      </div>

    </div>

  </div>

</template>
<script>

  const back_button = { label: 'Products', route: { name: 'products' } };

  export default {

    created () {

      this.$store.commit("UPDATE_BACK_BUTTON", back_button);

      // Get from local storage
      // TODO: Put this in a shared service
      this.email  = localStorage.getItem('fpkids_resources_email');
      this.campus = localStorage.getItem('fpkids_resources_campus');

    },

    beforeDestroy() {
      this.$store.commit("REMOVE_BACK_BUTTON", back_button);
    },

    data () {
      return {
        email:        '',
        campus:       '',
        order_placed: false,
        in_progress:  false
      }
    },

    methods: {
      remove (index) {
        this.$store.commit('REMOVE_FROM_CART', index);
      },
      submitOrder () {

        if (this.in_progress) {
          return;
        }

        this.in_progress = true;

        if (!this.campus) {
          return alert('Please choose a campus');
        }

        if (!this.email) {
          return alert('Please enter an email address');
        }

        localStorage.setItem('fpkids_resources_email', this.email);
        localStorage.setItem('fpkids_resources_campus', this.campus);

        this.$http.post('/api/orders', {
          campus: this.campus,
          email:  this.email,
          items:  this.cart
        }).then(
                () => {
                  this.order_placed = true;
                  this.$store.commit('EMPTY_CART');
                },
                () => {
                  this.in_progress = false;
                  alert('Server error. Unable to place order.');
                }
        );

      }
    },

    computed: {
      cart () {
        return this.$store.state.cart;
      }
    }
  }
</script>