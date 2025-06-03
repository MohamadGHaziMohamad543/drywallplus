<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store($lang,Request $request)
    {
        $request->validate([
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // تخزين الصورة
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $ext = $img->getClientOriginalExtension();
            $name = time() . '.' . $ext;
            $path = public_path('storegs/sliders/image');
            $img->move($path, $name);
            $imager = "storegs/sliders/image/".$name;
            $imagePath = $imager;
        }

        Slider::create([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'title_fr' => $request->title_fr,
            'title_tr' => $request->title_tr,
            'title_de' => $request->title_de,
            'title_zh' => $request->title_zh,
            'title_nl' => $request->title_nl,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'description_fr' => $request->description_fr,
            'description_tr' => $request->description_tr,
            'description_de' => $request->description_de,
            'description_zh' => $request->description_zh,
            'description_nl' => $request->description_nl,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('sliders.index', ['lang' => app()->getLocale()])->with('success', __('messages.slider_created_successfully'));
    }

    public function edit($lang,Slider $slider)
    {
        
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update($lang , Slider $slider , Request $request)
    {
        $request->validate([
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        // تحديث الصورة إذا تم رفع صورة جديدة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة

            // تخزين الصورة الجديدة
            $img = $request->file('image');
            $ext = $img->getClientOriginalExtension();
            $name = time() . '.' . $ext;
            $path = public_path('storegs/sliders/image');
            $img->move($path, $name);
            $imager = "storegs/sliders/image/".$name;
            $imagePath = $imager;
        

        }else{
            $imagePath = $slider->image_path; 
        }

        $slider->update([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'title_fr' => $request->title_fr,
            'title_tr' => $request->title_tr,
            'title_de' => $request->title_de,
            'title_zh' => $request->title_zh,
            'title_nl' => $request->title_nl,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'description_fr' => $request->description_fr,
            'description_tr' => $request->description_tr,
            'description_de' => $request->description_de,
            'description_zh' => $request->description_zh,
            'description_nl' => $request->description_nl,
            'image_path'=> $imagePath,
        ]);

        return redirect()->route('sliders.index', ['lang' => app()->getLocale()])->with('success', __('messages.slider_edit_successfully'));
    }

    public function destroy($lang,$id)
    {
        $slider = Slider::findOrFail($id);
        // حذف الصورة من التخزين
        Storage::delete('public/' . $slider->image_path);
        $slider->delete();

        return redirect()->route('sliders.index', ['lang' => app()->getLocale()])->with('success', __('messages.slider_delete_successfully'));
    }
}
