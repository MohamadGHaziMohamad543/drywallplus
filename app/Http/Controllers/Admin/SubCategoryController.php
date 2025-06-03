<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    // عرض كل الـ SubCategories
    public function index($lang)
    {
        $subcategories = SubCategory::with('category')->get();
        return view('admin.subcategories.index', compact('subcategories','lang'));
    }

    // عرض فورم إنشاء SubCategory
    public function create($lang)
    {
        $categories = Category::all();
        return view('admin.subcategories.create', compact('categories'));
    }

    // تخزين SubCategory جديد
    public function store($lang, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'desc_ar' => 'required|string',
            'desc_en' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        SubCategory::create($request->only('name_ar', 'name_en', 'desc_ar', 'desc_en', 'category_id'));

        return redirect()->route('subcategories.index', ['lang' => $lang])
                         ->with('success', __('messages.subcategory_created_successfully'));
    }

    // عرض صفحة تعديل SubCategory
    public function edit($lang, $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::all();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    // تحديث بيانات SubCategory
    public function update($lang, Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'desc_ar' => 'required|string',
            'desc_en' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $subcategory = SubCategory::findOrFail($id);
        $subcategory->update($request->only('name_ar', 'name_en', 'desc_ar', 'desc_en', 'category_id'));

        return redirect()->route('subcategories.index', ['lang' => $lang])
                         ->with('success', __('messages.subcategory_updated_successfully'));
    }

    // حذف SubCategory
    public function destroy($lang, $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();

        return redirect()->route('subcategories.index', ['lang' => $lang])
                         ->with('success', __('messages.subcategory_deleted_successfully'));
    }
}
