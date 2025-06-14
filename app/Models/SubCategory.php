<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'subcategories';

        protected $fillable = [
        'name_ar', 'name_en',
        'desc_ar', 'desc_en',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subSubCategories()
{
    return $this->hasMany(SubSubCategory::class);
}

}
