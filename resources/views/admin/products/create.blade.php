@extends('admin.layout.app')
@section('title', 'Create Product')

@section('content')
<div class="container mt-5">
    <h2>إنشاء منتج جديد</h2>
<form action="{{ route('products.store', ['lang' => app()->getLocale()]) }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- الاسم --}}
        <div class="form-group">
            <label for="name_ar">اسم المنتج (عربي)</label>
            <input type="text" name="name_ar" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="name_en">اسم المنتج (إنجليزي)</label>
            <input type="text" name="name_en" class="form-control" required>
        </div>

        {{-- الوصف --}}
        <div class="form-group">
            <label for="description_ar">الوصف (عربي)</label>
            <textarea name="description_ar" class="form-control" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="description_en">الوصف (إنجليزي)</label>
            <textarea name="description_en" class="form-control" rows="3" required></textarea>
        </div>

        {{-- نظرة عامة --}}
        <div class="form-group">
            <label for="overview_ar">نظرة عامة (عربي)</label>
            <textarea name="overview_ar" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="overview_en">نظرة عامة (إنجليزي)</label>
            <textarea name="overview_en" class="form-control" rows="3"></textarea>
        </div>

        {{-- تفاصيل أكثر --}}
        <div class="form-group">
            <label for="details_ar">تفاصيل أكثر (عربي)</label>
            <textarea name="details_ar" class="form-control" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="details_en">تفاصيل أكثر (إنجليزي)</label>
            <textarea name="details_en" class="form-control" rows="4"></textarea>
        </div>

        {{-- الفئة الفرعية الفرعية --}}
        <div class="form-group">
            <label for="sub_sub_category_id">الفئة الفرعية الفرعية</label>
            <select name="sub_sub_category_id" class="form-control" required>
                <option value="">اختر</option>
                @foreach ($subsubcategories as $sub)
                    <option value="{{ $sub->id }}">{{ $sub->name_ar }}</option>
                @endforeach
            </select>
        </div>

        {{-- الصورة --}}
        <div class="form-group">
            <label for="image">الصورة</label>
            <input type="file" name="image" class="form-control-file">
        </div>
<div class="form-group">
    <label for="images">صور إضافية للمنتج</label>
    <input type="file" name="images[]" class="form-control-file" multiple>
</div>
        {{-- الملفات المتعددة --}}
        @php
            $fileFields = [
                'catalogs' => 'الكتالوجات',
                'safety_data_sheets' => 'بيانات السلامة',
                'product_catalogs' => 'كتالوج المنتجات',
                'installation_guides' => 'أدلة التركيب',
                'product_files' => 'ملفات المنتجات',
                'warranties' => 'ملفات الضمان',
                'company_files' => 'ملفات الشركة'
            ];
        @endphp

        @foreach ($fileFields as $field => $label)
        <div class="form-group">
            <label for="{{ $field }}">{{ $label }}</label>
            <input type="file" name="{{ $field }}[]" class="form-control-file" multiple>
        </div>
        @endforeach

        <button type="submit" class="btn btn-primary mt-3">حفظ المنتج</button>
    </form>
</div>
@endsection

