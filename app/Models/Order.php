<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 *
 * @property string $id
 * @property OrderItem[] $items
 * @property string $email
 * @property string $campus
 *
 */
class Order extends Model {

    protected $hidden = ['created_at', 'updated_at'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

}
