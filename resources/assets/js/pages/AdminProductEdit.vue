<template>
  <div>
    <h2>{{ product.name }}</h2>
    <form>
      <input type="text" v-model="product.name"><br>
      <textarea v-model="product.description"></textarea><br>
      <ul>
        <li v-for="qty in product.quantities">{{ qty }}</li>
        <li><input type="text" v-model="new_quantity" v-on:keyup.enter="add_quantity" placeholder="Enter new qty and press ENTER"></li>
      </ul>
    </form>
  </div>
</template>
<script>

  export default {
    created:  function () {

      this.$http.get('/api/products/' + this.$route.params.id).then(
              (data) => {
                this.product = data.data.data;
              },
              (err) => {}
      );

    },
    data:     function () {
      return {
        product:      {},
        new_quantity: ''
      }
    },
    methods:  {
      add_quantity() {
        let qty = this.new_quantity.trim();
        if (qty.length) {
          console.log('adding qty', qty);
          this.product.quantities.push(qty);
        }
        this.new_quantity = '';
      }
    },
    computed: {
      quantities(){
        return this.product.quantities.join(',');
      }
    }
  }
</script>