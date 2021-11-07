<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['slug', 'name', 'type', 'description', 'quantity', 'price'];

    protected $hidden = [];

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class, 'product_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($productGallery) {
            $productGallery->galleries()->delete();
        });
    }
}
