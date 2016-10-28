<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 *
 * @property string $id
 * @property Product $product
 * @property integer $quantity
 * @property string $unit
 *
 */
class OrderItem extends Model {

    protected $hidden = ['order_id', 'product_id', 'created_at', 'updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
