<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $fillable = [
        'name_ar', 'name_en',
        'description_ar', 'description_en',
        'overview_ar', 'overview_en',
        'details_ar', 'details_en',
        'sub_sub_category_id', 'image',
        'images', 'catalogs', 'safety_data_sheets',
        'product_catalogs', 'installation_guides',
        'product_files', 'warranties', 'company_files'
    ];

    protected $casts = [
        'images' => 'array',
        'catalogs' => 'array',
        'safety_data_sheets' => 'array',
        'product_catalogs' => 'array',
        'installation_guides' => 'array',
        'product_files' => 'array',
        'warranties' => 'array',
        'company_files' => 'array',
    ];


    public function subSubCategory()
    {
        return $this->belongsTo(SubSubCategory::class);
    }


}
