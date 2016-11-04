<template>
  <div class="OrderDetail" v-if="order" style="padding-top: 100px">

    <ul class="Orders-list">
      <li class="Orders-item" v-for="item in order.items">
        {{ item.product.name }} ({{ item.choices }}) x {{ item.quantity }}
      </li>
    </ul>

  </div>
</template>
<script>

  export default {
    created:  function () {

      let self = this;

      this.$http.get('/api/orders/' + this.$route.params.id).then((data) => {
        console.log(data.data.data);
        self.order = data.data.data;
      });

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