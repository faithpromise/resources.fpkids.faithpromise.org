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
 * @property string $image_url
 *
 */
class Product extends Model {

    protected $hidden = ['category_id', 'created_at', 'updated_at', 'deleted_at'];
    protected $appends = ['image_url'];

    protected $casts = [
        'quantities' => 'json',
        'options'    => 'json',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute()
    {

        foreach (['jpg', 'png', 'gif'] as $ext) {
            $image_path = public_path('images/products/' . $this->id . '.' . $ext);
            if (file_exists($image_path)) {
                return '/images/products/' . $this->id . '.' . $ext . '?v=' . fileatime($image_path);
            }
        }

        return null;
    }

}
