<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // عرض قائمة المنتجات
    public function index($lang)
    {
        $products = Product::with('subsubcategory')->paginate(10);
        return view('admin.products.index', compact('products', 'lang'));
    }

    // عرض صفحة إنشاء منتج جديد
    public function create()
    {
        $subsubcategories = SubSubCategory::with('subcategory.category')->get();
        return view('admin.products.create', compact('subsubcategories'));
    }public function store($lang, Request $request)
{
    $data = $request->validate([
        'name_ar' => 'required|string',
        'name_en' => 'required|string',
        'description_ar' => 'required|string',
        'description_en' => 'required|string',
        'overview_ar' => 'nullable|string',
        'overview_en' => 'nullable|string',
        'details_ar' => 'nullable|string',
        'details_en' => 'nullable|string',
        'sub_sub_category_id' => 'required|exists:sub_sub_categories,id',
        'image' => 'nullable|image',
        'images.*' => 'nullable|image',
        'catalogs.*' => 'nullable|file',
        'safety_data_sheets.*' => 'nullable|file',
        'product_catalogs.*' => 'nullable|file',
        'installation_guides.*' => 'nullable|file',
        'product_files.*' => 'nullable|file',
        'warranties.*' => 'nullable|file',
        'company_files.*' => 'nullable|file',
    ]);

    // ✅ حفظ الصورة الرئيسية
    if ($request->hasFile('image')) {
        $img = $request->file('image');
        $imageName = time() . '.' . $img->getClientOriginalExtension();
        $imagePath = public_path('storegs/products/image');

        if (!file_exists($imagePath)) {
            mkdir($imagePath, 0777, true);
        }

        $img->move($imagePath, $imageName);
        $data['image'] = 'storegs/products/image/' . $imageName;
    }

    // ✅ حفظ الصور المتعددة
    if ($request->hasFile('images')) {
        $data['images'] = [];
        $multiImagePath = public_path('storegs/products/images');

        if (!file_exists($multiImagePath)) {
            mkdir($multiImagePath, 0777, true);
        }

        foreach ($request->file('images') as $multiImage) {
            $name = uniqid() . '.' . $multiImage->getClientOriginalExtension();
            $multiImage->move($multiImagePath, $name);
            $data['images'][] = 'storegs/products/images/' . $name;
        }

        $data['images'] = json_encode($data['images']);
    }

    // ✅ الحقول التي تحتوي على ملفات متعددة
    $fileFields = [
        'catalogs', 'safety_data_sheets', 'product_catalogs',
        'installation_guides', 'product_files', 'warranties', 'company_files'
    ];

    foreach ($fileFields as $field) {
        if ($request->hasFile($field)) {
            $files = $request->file($field);
            $savedPaths = [];
            $destinationPath = public_path("storegs/products/{$field}");

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            foreach ($files as $file) {
                $ext = $file->getClientOriginalExtension();
                $fileName = time() . '_' . uniqid() . '.' . $ext;
                $file->move($destinationPath, $fileName);
                $savedPaths[] = "storegs/products/{$field}/" . $fileName;
            }

            $data[$field] = json_encode($savedPaths); // يتم حفظها كسلسلة JSON
        }
    }

    // ✅ حفظ البيانات في قاعدة البيانات
    Product::create($data);

    return redirect()->route('products.index', $lang)->with('success', 'تم حفظ المنتج بنجاح');
}


      

    // عرض صفحة تعديل منتج
    public function edit($lang, Product $product)
    {
        $subsubcategories = SubSubCategory::all();
        return view('admin.products.edit', compact('product', 'subsubcategories', 'lang'));
    }

    // تحديث بيانات المنتج
    public function update(Request $request, $lang, Product $product)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'sub_sub_category_id' => 'required|exists:sub_sub_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'catalog' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $data = $request->only([
            'name_ar', 'name_en',
            'description_ar', 'description_en',
            'sub_sub_category_id'
        ]);

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $ext = $img->getClientOriginalExtension();
            $name = time() . '.' . $ext;
            $path = public_path('storegs/products/image');
            $img->move($path, $name);
            $data['image'] = "storegs/products/image/" . $name;
        }

        if ($request->hasFile('catalog')) {
            $file = $request->file('catalog');
            $ext = $file->getClientOriginalExtension();
            $name = time() . '_catalog.' . $ext;
            $path = public_path('storegs/products/catalog');
            $file->move($path, $name);
            $data['catalog'] = "storegs/products/catalog/" . $name;
        }

        $product->update($data);

        return redirect()->route('products.index', $lang)->with('success', 'تم تحديث المنتج بنجاح');
    }

    // حذف المنتج
    public function destroy($lang, Product $product)
    {
        $product->delete();
        return redirect()->route('products.index', $lang)->with('success', 'تم حذف المنتج بنجاح');
    }

    // عرض تفاصيل المنتج (اختياري)
    public function show($lang, Product $product)
    {
        return view('admin.products.show', compact('product', 'lang'));
    }
}
