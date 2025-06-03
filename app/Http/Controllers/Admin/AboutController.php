<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($lang)
    {
        $abouts = About::all();
        return view('admin.about.index',compact('abouts'));
    }

   
    public function create($lang)
    {
        return view('admin.about.create');
    }
    public function store($lang,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'desc_en' => 'required|string',
            'desc_ar' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images' => 'nullable|array',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $about = new About($request->except('image', 'images'));

        
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $ext = $img->getClientOriginalExtension();
            $name = time() . '.' . $ext;
            $path = public_path('storegs/about/image');
            $img->move($path, $name);
            $imager = "storegs/about/image/".$name;
            $about->image = $imager;
        }

        // رفع مجموعة الصور
        if ($request->hasFile('images')) { $images = [];

            foreach ($request->file('images') as $img) {
                $ext = $img->getClientOriginalExtension();
                $name = time() . rand(1000, 9999) . '.' . $ext; // لضمان عدم تكرار الأسماء
                $path = public_path('storegs/about/images');

                // التأكد من أن المجلد موجود، وإذا لم يكن موجودًا، يتم إنشاؤه
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $img->move($path, $name);
                $images[] = "storegs/about/images/" . $name; // تخزين المسار النسبي
            }

            $gallary_images = json_encode($images);
            $about->images = $gallary_images;
        }

        $about->save();

        return redirect()->route('abouts.index', ['lang' => app()->getLocale()])->with('success', __('messages.about_created_successfully'));
    }

    public function show($lang, About $about)
{
    // Dynamically select the name and description based on the language
    $nameKey = 'name_' . $lang;
    $descKey = 'desc_' . $lang;

    // Fallback if translation doesn't exist
    $name = $about->$nameKey ?? $about->name_en;
    $desc = $about->$descKey ?? $about->desc_en;

    // Decode gallery images from JSON
    $galleryImages = json_decode($about->images, true) ?? [];

    return view('admin.about.show', compact('about', 'name', 'desc', 'galleryImages'));
}


    public function edit($lang,About $about)
    {
        return view('admin.about.edit', compact('about'));
    }
    
    public function update($lang, Request $request, About $about)
{
    $validator = Validator::make($request->all(), [
        'name_en' => 'required|string|max:255',
        'name_ar' => 'required|string|max:255',
        'desc_en' => 'required|string',
        'desc_ar' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'images' => 'nullable|array',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $about->update($request->except('image', 'images'));

    // Replace main image
    if ($request->hasFile('image')) {
        // Delete old image
        if ($about->image && file_exists(public_path($about->image))) {
            unlink(public_path($about->image));
        }

        $img = $request->file('image');
        $ext = $img->getClientOriginalExtension();
        $name = time() . '.' . $ext;
        $path = public_path('storegs/about/image');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $img->move($path, $name);
        $imager = "storegs/about/image/" . $name;
        $about->image = $imager;
    }

    // Replace gallery images
    if ($request->hasFile('images')) {
        // Delete old gallery images
        if ($about->images) {
            $oldImages = json_decode($about->images, true);
            if (is_array($oldImages)) {
                foreach ($oldImages as $imgPath) {
                    if (file_exists(public_path($imgPath))) {
                        unlink(public_path($imgPath));
                    }
                }
            }
        }

        $images = [];
        foreach ($request->file('images') as $img) {
            $ext = $img->getClientOriginalExtension();
            $name = time() . rand(1000, 9999) . '.' . $ext;
            $path = public_path('storegs/about/images');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $img->move($path, $name);
            $images[] = "storegs/about/images/" . $name;
        }

        $about->images = json_encode($images);
    }

    $about->save();

    return redirect()->route('abouts.index', ['lang' => app()->getLocale()])
        ->with('success', __('messages.about_updated_successfully'));
}


    public function destroy($lang, About $about)
{
    // Delete main image if it exists
    if ($about->image && file_exists(public_path($about->image))) {
        unlink(public_path($about->image));
    }

    // Delete gallery images if they exist
    if ($about->images) {
        $images = json_decode($about->images, true);
        if (is_array($images)) {
            foreach ($images as $imgPath) {
                if (file_exists(public_path($imgPath))) {
                    unlink(public_path($imgPath));
                }
            }
        }
    }

    // Delete the record from database
    $about->delete();

    return redirect()->route('abouts.index', ['lang' => app()->getLocale()])
        ->with('success', __('messages.about_deleted_successfully'));
}
}
