<template>
  <div class="ProductList">

    <div class="Admin-header">
      <h2 class="Admin-heading">Products</h2>
      <router-link class="Button Button--primary" v-bind:to="{ name: 'admin_product_new' }">Add a New Product</router-link>
    </div>

    <table>
      <tbody>
        <tr v-for="product in products">
          <td>
            <div class="ProductList-image" v-bind:style="{ backgroundImage: product.image_url ? ('url(' + product.image_url + ')') : 'none' }"></div>
          </td>
          <td>{{ product.name }}</td>
          <td>
            <router-link v-bind:to="{ name: 'admin_product_edit', params: { id: product.id } }">Edit</router-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>

  export default {
    created:  function () {

      if (this.products.length === 0) {

        this.$http.get('/api/products').then(
                (data) => {
                  this.products   = data.data.data;
                  this.is_loading = false;
                },
                (err) => {});
      }

    },
    data:     function () {
      return {
        products:   [],
        is_loading: true
      }
    },
    methods:  {},
    computed: {}
  }
</script>