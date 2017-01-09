<template>

  <div>
    <div class="Orders">

      <div class="Section-header">
        <h2 class="Section-heading">Your Past Orders</h2>
        <p class="Section-subtitle">Showings orders for {{ user_email}}</p>
      </div>

      <table class="Orders-list">
        <thead>
          <tr>
            <th>Ordered On</th>
            <th>Est. Delivery</th>
            <th>Items</th>
          </tr>
        </thead>
        <tbody>
          <tr class="Orders-item" v-for="order in orders">
            <td class="Orders-date">
              <router-link v-bind:to="{ name: 'my_order', params: { id: order.id } }">{{ order.ordered_at_formatted }}</router-link>
            </td>
            <td class="Orders-date">
              {{ order.delivery_date_formatted }}
            </td>
            <td class="Orders-description Orders-description--desktop">
              <span v-for="(item, index) in item_prose(order.items)">{{ item.product.name }}{{ order.items.length > (index+1) ? ', ' : '' }}</span>
              <span v-if="order.items.length > 2">and {{ order.items.length - 2 }} other items</span>
            </td>
            <td class="Orders-description Orders-description--mobile">
              {{ order.items.length }} Items
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="Admin-link">
      <router-link v-bind:to="{ name: 'admin' }">Admin</router-link>
    </div>
  </div>

</template>
<script>

    import ordersService from '../api/orders.service';

    const back_button = { label: 'Products', route: { name: 'products' } };

    export default {

        created: function () {

            let email = localStorage.getItem('fpkids_resources_email');

            ordersService.byEmail(email).then((data) => {
                this.orders = data.data.data;
            });

            this.$store.commit("UPDATE_BACK_BUTTON", back_button);

        },

        beforeDestroy() {
            this.$store.commit("REMOVE_BACK_BUTTON", back_button);
        },

        data: function () {
            return {
                orders: null
            }
        },

        computed: {

            user_email () {
                return localStorage.getItem('fpkids_resources_email');
            }

        },

        methods: {

            item_prose (items) {
                return items.slice(0, 2);
            }

        }
    }
</script>