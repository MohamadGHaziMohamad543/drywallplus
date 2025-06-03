<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
   
    public function generatePDF($lang, Category $category)
    {
        $pdf = Pdf::loadView('admin.categories.pdf', compact('category'))
          ->setPaper('a4', 'portrait')
          ->setOption(['isRemoteEnabled' => true]);
            return $pdf->download("categories_{$category->id}.pdf");
    }
    public function index($lang)
    {
        $name = 'name_' . $lang;
        $desc = 'description_' . $lang;
        $categories = Category::all();
        return view('admin.category.index', compact('categories','name','desc'));
    }

    public function create($lang)
    {
        return view('admin.category.create');
    }

    public function store($lang,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'desc_ar' => 'required|string',
            'desc_en' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            $data = [
        'name_ar' => $request->name_ar,
        'name_en' => $request->name_en,
        'description_ar' => $request->desc_ar,
        'description_en' => $request->desc_en,
    ];

        Category::create($data);

        return redirect()->route('categories.index', ['lang' => app()->getLocale()])->with('success',  __('messages.category_created_successfully'));
    }

    public function edit($lang,Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update($lang,Request $request, Category $category)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'desc_ar' => 'required|string',
            'desc_en' => 'required|string',
        ]);
            $data = [
        'name_ar' => $request->name_ar,
        'name_en' => $request->name_en,
        'description_ar' => $request->desc_ar,
        'description_en' => $request->desc_en,
    ];


        $category->update($data);

        return redirect()->route('categories.index', ['lang' => app()->getLocale()])->with('success', __('messages.category_updated_successfully'));
    }

    public function destroy($lang,Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index', ['lang' => app()->getLocale()])->with('success', __('messages.category_delete_successfully'));
    }
}
