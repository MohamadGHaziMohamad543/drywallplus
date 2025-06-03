<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_sub_categories';

    protected $fillable = [
        'subcategory_id',
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
    ];

public function subcategory()
{
    return $this->belongsTo(SubCategory::class);
}

// في نموذج SubCategory
public function category()
{
    return $this->belongsTo(Category::class);
}
}
