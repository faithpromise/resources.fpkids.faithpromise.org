<template>

  <div>

    <div class="ProductAdded" v-if="is_added">

      <span class="CloseButton" v-on:click="reset()">
        <img class="CloseButton-image" src="/images/close.svg">
      </span>

      <h2 class="ProductAdded-title">Item Added to Cart</h2>

      <p>
        <router-link class="Button Button--primary" v-bind:to="{ name: 'checkout' }">Checkout</router-link>
        <router-link class="Button" to="/products">Keep Shopping</router-link>
      </p>

    </div>

    <div class="ProductDetail" v-if="product && !is_added">

      <div class="ProductDetail-header">
        <div class="ProductDetail-imageWrap">
          <div class="ProductDetail-image" v-bind:style="{ backgroundImage: product.image_url ? ('url(' + product.image_url + ')') : 'none' }"></div>
        </div>
        <div class="ProductDetail-info">
          <h1 class="ProductDetail-name">{{ product.name }}</h1>
          <p class="ProductDetail-description">{{ product.description }}</p>
        </div>
      </div>

      <div class="ProductDetail-optionGroup" v-if="product.options && product.options.length">

        <span class="ProductDetail-optionLabel">{{ product.options[0].name }}:</span>

        <ul class="OptionList">
          <li class="OptionList-item"
                  v-for="option in product.options[0].values"
                  v-bind:class="{ 'is-selected': choice_1 === option }"
                  v-on:click="select_primary_option(option)">
            {{ option }}
          </li>
        </ul>

      </div>

      <div class="ProductDetail-optionGroup" v-if="product.options && product.options.length > 1">

        <span class="ProductDetail-optionLabel">{{ product.options[1].name }}:</span>

        <ul class="OptionList">
          <li class="OptionList-item"
                  v-if=""
                  v-bind:class="{ 'is-selected': choice_2 === option.label, 'is-disabled': !secondary_option_available(option) }"
                  v-for="option in product.options[1].values"
                  v-on:click="select_secondary_option(option)">
            {{ option.label }}
          </li>
        </ul>

      </div>

      <div class="ProductDetail-optionGroup">

        <span class="ProductDetail-optionLabel">Quantity:</span>

        <ul class="OptionList">
          <li class="OptionList-item" v-bind:class="{ 'is-selected': quantity === qty }" v-for="qty in product.quantities" v-on:click="set_quantity(qty)">{{ qty }}</li>
        </ul>

      </div>

      <button class="Button Button--add-to-cart" v-on:click="add_to_cart">Add to Cart</button>

    </div>

  </div>

</template>
<script>

    import productsService from '../api/products.service';

    const back_button = { label: 'Products', route: { name: 'products' } };

    export default {

        created: function () {

            productsService.find(this.$route.params.id).then((result) => {
                this.$store.commit('SELECT_PRODUCT', result.data.data);
                this.$store.commit("UPDATE_BACK_BUTTON", back_button);
            });

        },

        beforeDestroy() {
            this.$store.commit('DESELECT_PRODUCT');
            this.$store.commit("REMOVE_BACK_BUTTON", back_button);
        },

        data: function () {
            return {
                quantity: 0,
                options:  {},
                choice_1: null,
                choice_2: null,
                is_added: false
            }
        },

        methods: {
            add_to_cart: function () {

                // Add quantity
                this.product.quantity = this.quantity;

                if (this.product.options && this.product.options.length > 0) {

                    // Add first option
                    if (!this.choice_1) {
                        return alert('Please select a ' + this.product.options[0].name);
                    }

                    this.product.choices = this.choice_1.label;

                    // Add second option
                    if (this.product.options.length > 1) {
                        if (!this.choice_2) {
                            return alert('Please select a ' + this.product.options[1].name);
                        }
                        this.product.choices += ' / ' + this.choice_2;
                    }

                }

                if (this.quantity <= 0) {
                    return alert('Please select a quantity');
                }

                this.$store.commit('ADD_TO_CART', this.product);
                this.is_added = true;

            },

            set_quantity: function (qty) {
                this.quantity = qty;
            },

            select_primary_option(option) {
                this.choice_1 = option;
                // Reset secondary option
                if (this.product.options.length > 1) {
                    this.choice_2 = null;
                }
            },

            select_secondary_option(option) {
                if (this.secondary_option_available(option)) {
                    this.choice_2 = option.label;
                }
            },

            secondary_option_available: function (option) {
                return this.choice_1
                    && this.product.options.length > 1
                    && option.available_in[this.choice_1.id];
            },

            reset: function () {
                this.quantity = 0;
                this.choice_1 = null;
                this.choice_2 = null;
                this.is_added = false;
            }
        },

        computed: {
            product: function () {
                return this.$store.state.selected_product;
            }
        }
    }
</script>