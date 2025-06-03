@extends('admin.layout.app')
@section('title','Create Slider')
@section('header')
@endsection
@section('content')
<div class="main-panel" style="width: 100%;overflow:scroll;">
    <div class="content-wrapper">
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  <h1>{{ __('messages.create_slider') }}</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                  <form action="{{ route('sliders.store', ['lang' => app()->getLocale()]) }}" method="POST" enctype="multipart/form-data">
                       @csrf
                           <!-- name Fields -->
                           @foreach (['en', 'ar'] as $lang)
                                <div class="form-group">
                                    <label for="title_{{ $lang }}">{{ __('messages.name') }} ({{ strtoupper($lang) }}):</label>
                                    <input type="text" class="form-control" name="title_{{ $lang }}" id="title_{{ $lang }}" value="{{ old('title_' . $lang) }}" >
                                    @error('title_' . $lang)
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach
                            <!-- description Fields -->
                            @foreach (['en', 'ar'] as $lang)
                            <div class="form-group">
                                <label for="description_{{ $lang }}">{{ __('messages.description') }} ({{ strtoupper($lang) }}):</label>
                                <textarea class="form-control" name="description_{{ $lang }}" id="desc_{{ $lang }}" >{!! old('description_' . $lang) !!}</textarea>
                                @error('description_' . $lang)
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                            <div class="mb-3">
                                <label for="image">{{ __('messages.image') }}</label>
                                <div id="drop-area-image" class="drop-area">
                                    <p>{{ __('messages.drag_drop_image') }}</p>
                                    <input type="file" class="form-control" id="image" name="image" style="display: none;">
                                    <img id="image-preview" src="" alt="Image Preview" style="display: block; margin-top: 10px; max-width: 100%;">
                                </div>
                            </div>
                                 @error('image')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                        
                            
                      <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-plus-circle"></i> {{ __('messages.create_slider') }}</button>
                    </form>
                  </div>
                </div>
              </div>
                </div>
              </div>
    
@endsection
@section('script')
<style>
    .drop-area {
        border: 2px dashed #ccc;
        border-radius: 5px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        margin-top: 10px;
        transition: border-color 0.3s;
    }
    .drop-area.hover {
        border-color: #333;
    }
</style>

<script>
    // Handle the image upload drop area
    const dropAreaImage = document.getElementById('drop-area-image');
    const fileInputImage = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');


    // Prevent default behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropAreaImage.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Highlight drop areas when an item is dragged over them
    ['dragenter', 'dragover'].forEach(eventName => {
        dropAreaImage.addEventListener(eventName, () => dropAreaImage.classList.add('hover'), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropAreaImage.addEventListener(eventName, () => dropAreaImage.classList.remove('hover'), false);
    });

    // Handle dropped files for image
    dropAreaImage.addEventListener('drop', handleImageDrop, false);
    dropAreaImage.addEventListener('click', () => fileInputImage.click());

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function handleImageDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleImageFiles(files);
    }


    function handleImageFiles(files) {
        if (files.length) {
            const file = files[0];
            fileInputImage.files = files;
            displayImage(file);
        }
    }

    function displayImage(file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }

    fileInputImage.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            displayImage(file);
        }
    });

</script>
    <script src="{{asset('assets/js/editor.init.js')}}"></script>
    <script src="{{asset('assets/js/tinymce/tinymce.min.js')}}"></script>
@endsection
