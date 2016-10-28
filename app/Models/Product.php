<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Product
 * @package App\Models
 *
 * @property string $id
 * @property Category $category
 * @property string $name
 * @property array $quantities
 * @property array $options
 * @property string $description
 * @property string $is_popular
 *
 */
class Product extends Model {

    protected $hidden = ['category_id', 'created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'quantities' => 'json',
        'options'    => 'json',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
