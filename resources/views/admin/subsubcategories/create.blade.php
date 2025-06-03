@extends('admin.layout.app')
@section('title', 'Create Sub-SubCategory')

@section('header')
@endsection

@section('content')
<div class="main-panel" style="width: 100%; overflow: scroll;">
    <div class="content-wrapper">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1>{{ __('messages.create_subsubcategory') }}</h1>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('subsubcategories.store', ['lang' => app()->getLocale()]) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- اختيار الفئة الرئيسية -->
                        <div class="form-group">
                            <label for="subcategory_id">{{ __('messages.subcategory') }}</label>
                            <select class="form-control" name="subcategory_id" id="subcategory_id">
                                <option value="">{{ __('messages.select_subcategory') }}</option>
                                @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->{'name_' . app()->getLocale()} }}</option>
                                @endforeach
                            </select>
                            @error('subcategory_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- حقول الاسم بعدة لغات -->
                        @foreach (['en', 'ar'] as $lang)
                            <div class="form-group">
                                <label for="name_{{ $lang }}">{{ __('messages.name') }} ({{ strtoupper($lang) }}):</label>
                                <input type="text" class="form-control" name="name_{{ $lang }}" id="name_{{ $lang }}" value="{{ old('name_' . $lang) }}">
                                @error('name_' . $lang)
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach

                        <!-- حقول الوصف بعدة لغات -->
                        @foreach (['en', 'ar'] as $lang)
                            <div class="form-group">
                                <label for="description_{{ $lang }}">{{ __('messages.discription') }} ({{ strtoupper($lang) }}):</label>
                                <textarea class="form-control" name="description_{{ $lang }}" id="desc_{{ $lang }}">{!! old('description_' . $lang) !!}</textarea>
                                @error('description_' . $lang)
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach


                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="fas fa-plus-circle"></i> {{ __('messages.create_subsubcategory') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/editor.init.js')}}"></script>
<script src="{{asset('assets/js/tinymce/tinymce.min.js')}}"></script>
@endsection
