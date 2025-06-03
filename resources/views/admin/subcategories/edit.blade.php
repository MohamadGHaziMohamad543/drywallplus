@extends('admin.layout.app')
@section('title', 'Edit SubCategory')

@section('header')
@endsection

@section('content')
<div class="main-panel" style="width: 100%; overflow: scroll;">
    <div class="content-wrapper">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1>{{ __('messages.edit_subcategory') }}</h1>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('subcategories.update', ['subcategory' => $subcategory->id, 'lang' => app()->getLocale()]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="category_id">{{ __('messages.category') }}</label>
                            <select class="form-control" name="category_id" id="category_id">
                                <option value="">{{ __('messages.select_category') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name_en }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        @foreach (['en', 'ar'] as $lang)
                            <div class="form-group">
                                <label for="name_{{ $lang }}">{{ __('messages.name') }} ({{ strtoupper($lang) }}):</label>
                                <input type="text" class="form-control" name="name_{{ $lang }}" id="name_{{ $lang }}" value="{{ old('name_' . $lang, $subcategory->{'name_' . $lang} ) }}">
                                @error('name_' . $lang)
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach

                        @foreach (['en', 'ar'] as $lang)
                            <div class="form-group">
                                <label for="desc_{{ $lang }}">{{ __('messages.discription') }} ({{ strtoupper($lang) }}):</label>
                                <textarea class="form-control" name="desc_{{ $lang }}" id="desc_{{ $lang }}">{!! old('desc_' . $lang, $subcategory->{'desc_' . $lang} ) !!}</textarea>
                                @error('desc_' . $lang)
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-success mr-2">
                            <i class="fas fa-save"></i> {{ __('messages.update_subcategory') }}
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
