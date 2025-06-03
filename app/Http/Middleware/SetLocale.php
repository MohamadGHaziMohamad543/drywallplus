<?php


namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\App;


class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = $request->segment(1); 
        $availableLocales = ['en', 'ar'];


        if (in_array($locale, $availableLocales)) {
            App::setLocale($locale);
        } else {
            abort(404); 
        }


        return $next($request);
    }
}
