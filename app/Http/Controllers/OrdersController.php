<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
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
