<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    // عرض البيانات
    public function index($lang)
    {
        $contactUs = ContactUs::all();
        return view('admin.contact_us.index', compact('contactUs'));
    }

    // عرض نموذج إضافة البيانات
    public function create()
    {
        return view('admin.contact_us.create');
    }

    // تخزين البيانات
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'phone' => 'required|string|regex:/^\+?[0-9]{6,15}$/',
            'whatsapp_link' => 'required|url',
            'facebook_link' => 'required|url',
            'linkedin_link' => 'required|url',
            'instagram_link' => 'required|url',
            'address_en' => 'required',
            'address_ar' => 'required',
            'map_link' => 'required|url',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        ContactUs::create($request->all());
        return redirect()->route('contact-us.index', ['lang' => app()->getLocale()])->with('success',  __('messages.contact_created_successfully'));
    }

    // عرض نموذج تعديل البيانات
    public function edit($lang,$id)
    {
        $contactUs = ContactUs::findOrFail($id);
        return view('admin.contact_us.edit', compact('contactUs'));
    }

    // تحديث البيانات
    public function update($lang,Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'phone' => 'required',
            'whatsapp_link' => 'required|url',
            'facebook_link' => 'required|url',
            'linkedin_link' => 'required|url',
            'instagram_link' => 'required|url',
            'address_en' => 'required',
            'address_ar' => 'required',
            'address_fr' => 'required',
            'address_tr' => 'required',
            'address_zh' => 'required',
            'address_de' => 'required',
            'map_link' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $contactUs = ContactUs::findOrFail($id);
        $contactUs->update($request->all());
        return redirect()->route('contact-us.index', ['lang' => app()->getLocale()]) ->with('success',  __('messages.contact_updated_successfully'));
    }

    // حذف البيانات
    public function destroy($lang,$id)
    {
        $contactUs = ContactUs::findOrFail($id);
        $contactUs->delete();
        return redirect()->route('contact-us.index', ['lang' => app()->getLocale()]) ->with('success',  __('messages.contact_deleted_successfully'));
    }
}