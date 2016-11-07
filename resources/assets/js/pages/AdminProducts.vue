<template>
  <div>
    <h2>Products</h2>
    <table>
      <tbody>
        <tr v-for="product in products">
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