<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index(Request $request)
    {

        $orders = Order::with('items.product')->orderBy('created_at', 'desc')->limit(100);

        $email = strtolower($request->get('email', null));
        if ($email) {
            $orders->where('email', '=', $email);
        }

        return ['data' => $orders->get()];

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function store(Request $request)
    {

        $order = Order::create($request->only('email', 'campus'));

        foreach ($request->get('items') as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['id'],
                'choices'    => $item['choices'],
                'quantity'   => $item['quantity'],
            ]);
        }

        $order->load('items.product');

        $cc = collect([['email' => 'ginam@faithpromise.org', 'name' => 'Gina McClain'], ['email' => 'adamw@faithpromise.org', 'name' => 'Adam Wilkerson'], ['email' => 'tiffanyr@faithpromise.org', 'name' => 'Tiffany Reid']]);

        Mail::to($order->email)
            ->cc($cc)
            ->send(new OrderConfirmation($order));

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function show($id)
    {
        $result = ['data' => Order::with('items.product')->find($id)];

        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
