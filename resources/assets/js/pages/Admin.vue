<template>
  <div>
    <router-link v-bind:to="{ name: 'admin_products' }">Products</router-link>
    <router-link v-bind:to="{ name: 'admin_orders' }">Orders</router-link>

    <router-view></router-view>
  </div>
</template>
<script>
  export default {
    created () {
      document.body.classList.add('admin');
    },
    beforeDestroy () {
      document.body.classList.remove('admin');
    }
  }
</script>