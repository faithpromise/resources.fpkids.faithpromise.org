<template>
  <div class="ProductDetail">



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
                v-bind:class="{ 'is-selected': product.options[0].selected === option }"
                v-for="option in product.options[0].values"
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
                v-bind:class="{ 'is-selected': product.options[1].selected === option.label, 'is-disabled': !secondary_option_available(option) }"
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

    <button class="Button Button--add-to-cart" v-on:click="add_to_cart">Add Item</button>

  </div>
</template>
<script>

  export default {

    created: function () {

      let self = this;

      this.$http.get('/api/products/' + this.$route.params.id).then(function (data) {

        let product = data.data.data;

        // Need to add "selected" property so that it's observable
        if (product.options) {
          for (let i = 0; i < product.options.length; i++) {
            product.options[i].selected = null;
          }
        }

        self.$store.commit('SELECT_PRODUCT', product);
      });

    },

    beforeDestroy() {
      this.$store.commit('DESELECT_PRODUCT');
    },

    data: function () {
      return {
        quantity: 0,
        options:  {}
      }
    },

    methods: {
      add_to_cart: function () {

        // Add quantity
        this.product.quantity = this.quantity;

        if (this.product.options && this.product.options.length > 0) {

          // Add first option
          if (!this.product.options[0].selected) {
            return alert('Please select a ' + this.product.options[0].name);
          }

          this.product.choices = this.product.options[0].selected;

          // Add second option
          if (this.product.options.length > 1) {
            if (!this.product.options[1].selected) {
              return alert('Please select a ' + this.product.options[1].name);
            }
            this.product.choices += ' / ' + this.product.options[1].selected;
          }

        }

        if (this.quantity <= 0) {
          return alert('Please select a quantity');
        }

        this.$store.commit('ADD_TO_CART', this.product);
      },

      set_quantity: function (qty) {
        this.quantity = qty;
      },

      select_primary_option(option) {
        this.product.options[0].selected = option;
        // Reset secondary option
        if (this.product.options.length > 1) {
          this.product.options[1].selected = null;
        }
      },

      select_secondary_option(option) {
        if (this.secondary_option_available(option)) {
          this.product.options[1].selected = option.label;
        }
      },

      secondary_option_available: function (option) {
        return this.product.options.length > 1
                && option.available_in.indexOf(this.product.options[0].selected) >= 0;
      }
    },

    computed: {
      product: function () {
        return this.$store.state.selected_product;
      }
    }
  }
</script>