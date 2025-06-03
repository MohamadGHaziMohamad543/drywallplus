<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
class StatckController extends Controller
{
    public function index($lang)
    {
        return view('website.home.index');
    }

}
