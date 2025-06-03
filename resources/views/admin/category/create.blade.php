@extends('admin.layout.app')
@section('title', 'Create Category')
@section('header')
@endsection
@section('content')
<div class="main-panel" style="width: 100%; overflow: scroll;">
    <div class="content-wrapper">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1>{{ __('messages.create_category') }}</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('categories.store', ['lang' => app()->getLocale()]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @foreach (['en', 'ar',] as $lang)
                            <div class="form-group">
                                <label for="name_{{ $lang }}">{{ __('messages.name') }} ({{ strtoupper($lang) }}):</label>
                                <input type="text" class="form-control" name="name_{{ $lang }}" id="name_{{ $lang }}" value="{{ old('name_' . $lang) }}" >
                                @error('name_' . $lang)
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                        @foreach (['en', 'ar',] as $lang)
                            <div class="form-group">
                                <label for="description_{{ $lang }}">{{ __('messages.discription') }} ({{ strtoupper($lang) }}):</label>
                                <textarea class="form-control" name="desc_{{ $lang }}" id="desc_{{ $lang }}" >{!! old('desc_' . $lang) !!}</textarea>
                                @error('description_' . $lang)
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                        

                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="fas fa-plus-circle"></i> {{ __('messages.create_category') }}
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
