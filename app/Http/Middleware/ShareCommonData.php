<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\ContactUs;

class ShareCommonData
{
    public function handle($request, Closure $next)
    {
        // البيانات التي نريد تمريرها لجميع الصفحات
        $categories = Category::all();
        $contact = ContactUs::first(); // إذا كانت هناك بيانات واحدة فقط

        // مشاركتها مع جميع الـ views
        View::share([
            'global_categories' => $categories,
            'global_contact' => $contact,
        ]);

        return $next($request);
    }
}
