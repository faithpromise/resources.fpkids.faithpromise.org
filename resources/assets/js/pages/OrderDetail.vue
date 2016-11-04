<template>
  <div class="OrderDetail" v-if="order">

    <div class="Section-header">
      <h2 class="Section-heading">Order Details</h2>
      <p class="Section-subtitle">Placed on {{ order.ordered_at_formatted }}. Estimated delivery date is {{ order.delivery_date_formatted }}.</p>
    </div>

    <ul class="Cart-list">
      <li class="Cart-item" v-for="item in order.items">

        <div class="CartItem">
          <div class="CartItem-imageWrap">
            <div class="CartItem-image" v-bind:style="{ backgroundImage: item.product.image_url ? ('url(' + item.product.image_url + ')') : 'none' }"></div>
          </div>
          <div class="CartItem-info">
            <router-link class="CartItem-name" v-bind:to="{ name: 'product', params: { id: item.product.id } }">{{ item.product.name }}</router-link>
            <p class="CartItem-description" v-if="item.product.choices">{{ item.choices }}</p>
          </div>
          <div class="CartItem-qty">
            {{ item.quantity }}
          </div>
        </div>

      </li>
    </ul>

  </div>
</template>
<script>

  const back_button = { label: 'Orders', route: { name: 'my_orders' } };

  export default {
    created:  function () {

      this.$http.get('/api/orders/' + this.$route.params.id).then((data) => {
        this.order = data.data.data;
      });

      this.$store.commit("UPDATE_BACK_BUTTON", back_button);

    },

    beforeDestroy() {
      this.$store.commit("REMOVE_BACK_BUTTON", back_button);
    },

    data:     function () {
      return {
        order: null
      }
    },
    methods:  {},
    computed: {}
  }
</script>