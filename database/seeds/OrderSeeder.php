<?php

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->truncate();

        for ($i = 0; $i <= 10; $i++) {

            $order = Order::create(['email' => 'bradr@faithpromise.org', 'campus' => 'Pellissippi']);

            $products = Product::query()->limit(rand(1, 5))->inRandomOrder()->get();

            /* @var Product $product */
            foreach ($products as $product) {
                $quantity = count($product->quantities) ? $product->quantities[rand(1, count($product->quantities)) - 1] : 1;
                $order_item = OrderItem::create(['order_id' => $order->id, 'product_id' => $product->id, 'quantity' => $quantity]);
            }

        }

    }
}
