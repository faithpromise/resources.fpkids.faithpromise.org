<template>
  <div class="Admin-container">

    <div v-if="notification">
      <h5>{{ notification }}</h5>
    </div>

    <div v-show="!notification">
      <h2 class="Admin-heading">{{ product.name }}</h2>

      <form class="ProductForm" v-on:submit.prevent="save">

        <div class="Form-group">
          <span class="Form-label">Product Name</span>
          <input class="Form-control" type="text" v-model="product.name" required>
        </div>

        <div class="Form-group">
          <span class="Form-label">Description</span>
          <textarea class="Form-control" v-model="product.description" v-autosize></textarea>
        </div>

        <div class="Form-group">
          <span class="Form-label">Image</span>
          <input id="file_field" class="form-control" type="file" v-on:change="upload_image">
          <div class="ProductForm-image" v-bind:style="{ backgroundImage: product.image_url ? ('url(' + product.image_url + ')') : 'none' }"></div>
        </div>

        <div class="Form-group">
          <span class="Form-label">Available Quantities</span>
          <ul class="Form-inputList Form-inputList--qty">
            <li v-for="(qty, index) in product.quantities">
              <input class="Form-control" type="text" v-model="product.quantities[index]">
              <span class="Form-deleteItem">
              <svg class="Form-deleteIcon" v-on:click="remove_quantity(index)">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#trash"></use>
              </svg>
            </span>
            </li>
            <li>
              <input class="Form-control" type="text" v-model="new_quantity" v-on:keydown.enter.prevent="add_quantity" placeholder="New qty / ENTER">
            </li>
          </ul>
        </div>

        <!-- Primary options -->
        <div class="Form-group" v-if="has_primary_option">
          <span class="Form-label">{{ product.options[0].name }} Options</span>
          <ul class="Form-inputList">
            <li v-for="(value, index) in product.options[0].values">
              <input class="Form-control" type="text" v-model="value.label">
              <span class="Form-deleteItem">
              <svg class="Form-deleteIcon" v-on:click="remove_primary_option_value(index)">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#trash"></use>
              </svg>
            </span>
            </li>
            <li>
              <input class="Form-control" type="text" v-model="new_primary_option_value" v-on:keydown.enter.prevent="add_primary_option_value($event)" v-bind:placeholder="'New ' + product.options[0].name + ' choice / ENTER'">
            </li>
          </ul>
        </div>

        <!-- Secondary options -->
        <div class="Form-group" v-if="has_secondary_option">
          <span class="Form-label">{{ product.options[1].name }} Options</span>
          <ul class="Form-inputList">
            <li v-for="(value, index) in product.options[1].values">
              <input class="Form-control" type="text" v-model="value.label">
              <span class="Form-deleteItem">
              <svg class="Form-deleteIcon" v-on:click="remove_secondary_option_value(index)">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#trash"></use>
              </svg>
            </span>
            </li>
            <li>
              <input class="Form-control" type="text" v-model="new_secondary_option_value" v-on:keydown.enter.prevent="add_secondary_option_value" v-bind:placeholder="'New ' + product.options[1].name + ' choice / ENTER'">
            </li>
          </ul>
        </div>

        <div class="Form-group">
        <span class="Form-label">
          <a href="#" v-if="!has_primary_option" v-on:click.prevent="add_primary_option">Add an Option</a>
          <a href="#" v-if="has_primary_option && !has_secondary_option" v-on:click.prevent="add_secondary_option">Add a Second Option</a>
        </span>
        </div>

        <div class="Form-group">
          <span class="Form-label">Availability</span>

          <table class="OptionsMatrix" v-if="has_primary_option">
            <thead>
              <tr>
                <th>&nbsp;</th>
                <th v-for="secondary_value in secondary_option_values">{{ secondary_value.label }}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="primary_value in primary_option_values">
                <th>{{ primary_value.label }}</th>
                <td v-for="secondary_value in secondary_option_values">
                  <input type="checkbox" v-model="secondary_value.available_in[primary_value.id]">
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="Form-group">
          <button class="Button Button--primary" type="submit" v-bind:disabled="is_submit_disabled">{{ submit_text ? submit_text : 'Save' }}</button>
        </div>

      </form>

      <span class="ProductForm-delete" v-show="product.id" v-on:click="destroy">Delete this item</span>
    </div>

  </div>
</template>
<script>

    import Vue from 'vue';
    import autosize from '../directives/autosize';
    import productsService from '../api/products.service';

    export default {

        directives: {
            autosize
        },

        created: function () {

            // If editing, load the product
            if (this.$route.params.hasOwnProperty('id')) {
                productsService.find(this.$route.params.id).then((result) => {
                        this.product = result.data.data;
                    }
                );
            }

        },

        data: function () {
            return {
                product:                    {
                    id:          null,
                    name:        null,
                    description: null,
                    quantities:  [],
                    options:     null
                },
                new_quantity:               '',
                new_primary_option_value:   '',
                new_secondary_option_value: '',
                new_x_value:                '',
                new_y_value:                '',
                is_submit_disabled:         false,
                submit_text:                null,
                notification:               null
            }
        },

        methods:  {

            disable_submit(msg) {
                this.is_submit_disabled = true;
                this.submit_text        = msg;
            },

            enable_submit() {
                this.is_submit_disabled = false;
                this.submit_text        = null;
            },

            upload_image(event) {

                this.disable_submit('Uploading image. Please wait...');

                let formData = new FormData();
                let file     = event.target.files[0];

                if (!file.type.match('image.*')) {
                    return alert('Please upload (JPG, PNG, GIF) images only.');
                }

                this.update_image_preview(file);

                formData.append('image', file, file.name);

                productsService.upload_image(formData).then((result) => {
                        this.product.image = result.data.data;
                        this.enable_submit();
                    }
                ).catch(() => {
                    alert('Error uploading image');
                    this.enable_submit();
                });

            },

            update_image_preview(file) {

                let self   = this;
                let reader = new FileReader();

                reader.onload = function (e) {
                    self.product.image_url = e.target.result;
                };

                reader.readAsDataURL(file);
            },

            save() {

                if (this.is_submit_disabled) {
                    return alert('Unable to save product. Please try again.');
                }

                let notification = this.product.id ? 'Product Updated' : 'Product Added';

                productsService.save(this.product).then(() => {
                    this.notification = notification;
                });

            },

            destroy() {
                productsService.delete(this.product.id).then(() => {
                    this.notification = 'Product Deleted';
                });
            },

            add_primary_option() {
                let name = prompt('Enter a name for the option (i.e. "Size")');

                this.product.options = [
                    {
                        name:   name,
                        values: []
                    }
                ];
            },

            add_secondary_option() {

                if (this.has_secondary_option) {
                    return alert('A product can only have two options.');
                }

                let name = prompt('Enter a name for the second option (i.e. "Color")');

                this.product.options.push({
                    name:   name,
                    values: []
                });

            },

            add_primary_option_value(event) {

                let id    = Math.random().toString(36).substr(2, 7),
                    label = this.new_primary_option_value.trim();
                this.product.options[0].values.push({ id, label });

                this.secondary_option_values.forEach(function (value) {
                    value.available_in[id] = true;
                });

                this.new_primary_option_value = '';
            },

            remove_primary_option_value(index) {

                let id = this.product.options[0].values[index].id;

                this.product.options[0].values.splice(index, 1);

                this.secondary_option_values.forEach(function (value) {
                    Vue.delete(value.available_in, id);
                });
            },

            add_secondary_option_value() {
                let label = this.new_secondary_option_value.trim();

                let available_in = {};

                this.primary_option_values.forEach(function (value) {
                    available_in[value.id] = true;
                });

                this.product.options[1].values.push({
                    label:        label,
                    available_in: available_in
                });

                this.new_secondary_option_value = '';
            },

            remove_secondary_option_value(index) {
                this.product.options[0].values.splice(index, 1);
            },

            add_quantity() {
                let qty = this.new_quantity.trim();

                if (!this.product.hasOwnProperty('quantities')) {
                    this.product.quantities = [];
                }

                if (qty.length) {
                    this.product.quantities.push(qty);
                }
                this.new_quantity = '';
            },

            remove_quantity(index) {
                this.product.quantities.splice(index, 1);
            }

        },
        computed: {

            quantities(){
                return this.product.quantities.join(',');
            },

            secondary_option_values() {
                return this.product.options && (this.product.options.length > 1) ? this.product.options[1].values : [];
            },

            primary_option_values() {
                return this.product.options && (this.product.options.length > 0) ? this.product.options[0].values : [];
            },

            has_primary_option() {
                return this.product.options && (this.product.options.length > 0);
            },

            has_secondary_option() {
                return this.product.options && (this.product.options.length > 1);
            }

        }
    }
</script>