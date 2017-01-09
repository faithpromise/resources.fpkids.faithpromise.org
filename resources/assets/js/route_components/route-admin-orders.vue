<template>
  <div class="PackagingList">

    <div class="Admin-header">
      <h2 class="Admin-heading">Orders</h2>
      <button class="Button" v-on:click="toggle_filled_visibility">{{ this.is_filled_visible ? 'Hide Filled Items' : 'Show Filled Items' }}</button>
    </div>

    <div v-for="(campus, index) in campuses">

      <h3>{{ index }}</h3>

      <table>
        <thead>
          <tr>
            <th>Filled</th>
            <th>Item</th>
            <th class="PackagingList-photo"></th>
            <th>Qty</th>
            <th class="PackagingList-orderedAt">Order Date</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in filtered_items(campus)" v-bind:class="{ 'is-filled': item.filled_at }">
            <td class="PackagingList-toggleFilled" v-on:click="mark_filled(item)">
              <svg class="PackagingList-check">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" v-bind:xlink:href="'#checkbox-' + (item.filled_at ? 'checked' : 'empty')"></use>
              </svg>
            </td>
            <td class="PackagingList-photo">
              <div class="ProductList-image" v-bind:style="{ backgroundImage: item.product.image_url ? ('url(' + item.product.image_url + ')') : 'none' }"></div>
            </td>
            <td>
              <span class="PackagingList-name">{{ item.product.name }}</span>
              <div class="PackagingList-choices">{{ item.choices }}</div>
            </td>
            <td class="nowrap">{{ item.quantity }}</td>
            <td class="PackagingList-orderedAt nowrap">{{ item.order.ordered_at_formatted }}</td>
          </tr>
        </tbody>
      </table>

    </div>

  </div>
</template>
<script>

    import ordersService from '../api/orders.service';

    export default {

        created: function () {

            ordersService.packaging().then((result) => {
                this.campuses   = result.data.data;
                this.is_loading = false;
            });

        },

        data: function () {
            return {
                campuses:          [],
                is_loading:        true,
                is_filled_visible: true
            }
        },

        methods:  {

            toggle_filled_visibility() {
                this.is_filled_visible = !this.is_filled_visible;
            },

            filtered_items(items) {

                if (this.is_filled_visible) {
                    return items;
                }

                return items.filter((item) => {
                    return !item.filled_at;
                });

            },

            mark_filled(item) {

                let orig_filled_at = item.filled_at;

                if (orig_filled_at && !confirm('Are you sure?')) {
                    return;
                }

                item.filled_at = orig_filled_at ? null : new Date().toISOString().substring(0, 19).replace('T', ' ');

                ordersService.update({ 'id': item.id, 'filled_at': item.filled_at }).catch(() => {
                    item.filled_at = orig_filled_at;
                    alert('An error occurred. Unable to mark item filled/unfilled.');
                });

            }

        }

    }
</script>