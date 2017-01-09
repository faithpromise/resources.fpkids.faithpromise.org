<template>
  <div>
    <div class="AdminNav">
      <div class="AdminNav-container">
        <router-link v-bind:to="{ name: 'admin_products' }">Update Products</router-link>
        <router-link v-bind:to="{ name: 'admin_orders' }">Fill Orders</router-link>
      </div>
    </div>

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