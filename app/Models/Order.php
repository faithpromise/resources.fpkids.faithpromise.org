<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 *
 * @property string $id
 * @property OrderItem[] $items
 * @property string $email
 * @property string $campus
 * @property Carbon $delivery_date
 * @property string $delivery_date_formatted
 * @property Carbon $created_at
 * @property Carbon $ordered_at
 * @property string $ordered_at_formatted
 *
 */
class Order extends Model {

    protected $fillable = ['campus', 'email'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['ordered_at_formatted', 'delivery_date_formatted'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getOrderedAtAttribute()
    {
        return $this->created_at->copy();
    }

    public function getOrderedAtFormattedAttribute()
    {
        return $this->created_at->format('M j, Y');
    }

    public function getDeliveryDateAttribute()
    {

        $ordered_at = $this->ordered_at->endOfDay();
        $delivery_month = $ordered_at->copy();
        $lead_time_in_days = 3;

        while (0 == 0) {

            $first_saturday = new Carbon('first saturday of ' . $delivery_month->format('F Y'));
            $delivery_day = $first_saturday->copy()->subDays(5);
            $packing_day = $delivery_day->copy()->subDays($lead_time_in_days);

            if ($packing_day->gt($ordered_at)) {
                return $delivery_day;
            }

            $delivery_month->addMonth();

        }

    }

    public function getDeliveryDateFormattedAttribute()
    {
        return $this->delivery_date->format('M j, Y');
    }

}
