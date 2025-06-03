<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubSubCategoryController extends Controller
{
    // عرض كل الـ SubSubCategories
    public function index($lang)
    {
$subsubcategories = SubSubCategory::with('subcategory.category')->get();
        return view('admin.subsubcategories.index', compact('subsubcategories', 'lang'));
    }

    // عرض فورم إنشاء SubSubCategory
    public function create($lang)
    {
        $subcategories = SubCategory::all();
        return view('admin.subsubcategories.create', compact('subcategories', 'lang'));
    }

    // تخزين SubSubCategory جديد
    public function store($lang, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        SubSubCategory::create($request->only('name_ar', 'name_en', 'description_en', 'description_ar', 'subcategory_id'));

        return redirect()->route('subsubcategories.index', ['lang' => $lang])
                         ->with('success', __('messages.subsubcategory_created_successfully'));
    }

    // عرض صفحة تعديل SubSubCategory
    public function edit($lang, $id)
    {
        $subsubcategory = SubSubCategory::findOrFail($id);
        $subcategories = SubCategory::all();
        return view('admin.subsubcategories.edit', compact('subsubcategory', 'subcategories', 'lang'));
    }

    // تحديث بيانات SubSubCategory
    public function update($lang, Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $subsubcategory = SubSubCategory::findOrFail($id);
        $subsubcategory->update($request->only('name_ar', 'name_en', 'description_ar', 'description_en', 'subcategory_id'));

        return redirect()->route('subsubcategories.index', ['lang' => $lang])
                         ->with('success', __('messages.subsubcategory_updated_successfully'));
    }

    // حذف SubSubCategory
    public function destroy($lang, $id)
    {
        $subsubcategory = SubSubCategory::findOrFail($id);
        $subsubcategory->delete();

        return redirect()->route('subsubcategories.index', ['lang' => $lang])
                         ->with('success', __('messages.subsubcategory_deleted_successfully'));
    }
}
