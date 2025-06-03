<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'phone',
        'whatsapp_link',
        'linkedin_link',
        'facebook_link',
        'linkedin_link',
        'instagram_link',
        'map_location',
        'address_en',
        'address_ar',
        'map_link',
    ];

}
