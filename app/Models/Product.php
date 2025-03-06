<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'image_url', 'price', 'stock', 'product_category_id',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function wishlistItems()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

    public function getImage()
    {
        return $this->image_url == null ? asset('assets/images/logo.png') : Storage::url($this->image_url);
    }
}
