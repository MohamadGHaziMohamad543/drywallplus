<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_en', 'name_ar','desc_en', 'desc_ar','image', 'images'
    ];

    protected $casts = [
        'images' => 'array', // لتحويل مجموعة الصور إلى مصفوفة
    ];
}
