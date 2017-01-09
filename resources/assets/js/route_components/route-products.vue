<template>
  <div class="Products">

    <ul class="Products-list">
      <li class="Products-item" v-for="product in products">

        <router-link class="Product" v-bind:to="{ name: 'product', params: { id: product.id } }">
          <div class="Product-imageWrap">
            <div class="Product-image" v-bind:style="{ backgroundImage: product.image_url ? ('url(' + product.image_url + ')') : 'none' }"></div>
          </div>
          <div class="Product-info">
            <h2 class="Product-name">{{ product.name }}</h2>
            <p class="Product-description">{{ product.description}}</p>
          </div>
        </router-link>

      </li>
    </ul>
  </div>
</template>
<script>

    import productsService from '../api/products.service';

    export default {

        created() {

            if (this.products.length === 0) {

                productsService.all().then((result) => {
                    this.$store.commit('UPDATE_PRODUCTS', result.data.data);
                });

            }

        },

        data() {
            return {
                is_loading: true
            }
        },

        methods:  {

            add_to_cart: function (product) {
                this.$store.commit('ADD_TO_CART', product);
            }

        },

        computed: {

            products: function () {
                return this.$store.state.products;
            }

        }
    }
</script>