<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PackagingController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index(Request $request)
    {

        $orderItems = OrderItem::with('order')->with('product')->where(function($query) {
            $min_date = Carbon::now()->subDays(7);
            $query->whereNull('filled_at')->orWhere('filled_at', '>', $min_date);
        })->orderByRaw('filled_at IS NOT NULL')->orderBy('product_id')->orderBy('choices')->get();

        $orders_grouped = $orderItems->groupBy('order.campus');

        return ['data' => $orders_grouped];

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = OrderItem::find($id);

        $item->update($request->only(['filled_at']));
    }

}
