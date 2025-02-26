<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'duration', 'type', 'deposit_price', 'service_category_id', 'image_url'
    ];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getImage()
    {
        return $this->image_url == null ? asset('assets/images/about-img-1.jpg') : Storage::url($this->image_url);
    }
}
