<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en', 'title_ar',
        'description_en', 'description_ar',
        'image_path',
    ];

    // هذا سيُستخدم لاسترجاع الصورة عبر Storage
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }

    // عند حذف السلايدر، نقوم بحذف الصورة من التخزين أيضًا
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($slider) {
            // حذف الصورة من التخزين عند حذف السلايدر
            if ($slider->image_path && Storage::exists('public/' . $slider->image_path)) {
                Storage::delete('public/' . $slider->image_path);
            }
        });
    }
}

