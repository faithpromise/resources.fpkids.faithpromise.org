<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


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

    const TEMP_IMAGE_DIR = 'temp';
    const IMAGE_DIR = 'public/products';
    const IMAGE_URL = '/storage/app/public/products/%s?v=%s';

    protected $guarded = [];
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
            $image_path = $this->getImagePath($ext);
            if (Storage::exists($image_path)) {
                return sprintf(self::IMAGE_URL, $this->getImageFileName($ext), fileatime(storage_path('app/' . $image_path)));
            }
        }

        return null;
    }

    public function getImageFileName($ext = 'jpg')
    {
        return $this->id . '.' . $ext;
    }

    public function getImagePath($ext = 'jpg')
    {
        return self::IMAGE_DIR . '/' . $this->getImageFileName($ext);
    }

}
