<template>
  <div class="Orders" style="padding-top: 100px">
    <ul class="Orders-list">
      <li class="Orders-item" v-for="order in orders">

        <router-link v-bind:to="{ name: 'my_order', params: { id: order.id } }">{{ order.created_at }} {{ order.items.length }} Items</router-link>

      </li>
    </ul>
  </div>
</template>
<script>

  export default {
    created:  function () {

      let email = localStorage.getItem('fpkids_resources_email');

      this.$http.get('/api/orders?email=' + email).then(function (data) {
        this.orders = data.data.data;
      });

    },
    data:     function () {
      return {
        orders: null
      }
    },
    methods:  {},
    computed: {}
  }
</script>