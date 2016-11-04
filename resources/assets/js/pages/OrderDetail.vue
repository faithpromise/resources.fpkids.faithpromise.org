<template>
  <div class="OrderDetail" v-if="order">

    <div class="Section-header">
      <h2 class="Section-heading">Order Details</h2>
      <p class="Section-subtitle">Placed on {{ order.ordered_at_formatted }}</p>
    </div>

    <ul class="Orders-list">
      <li class="Orders-item" v-for="item in order.items">
        {{ item.product.name }} ({{ item.choices }}) x {{ item.quantity }}
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