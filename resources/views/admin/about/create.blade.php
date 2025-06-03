@extends('admin.layout.app')
@section('title', 'Create About')
@section('header')
@endsection
@section('content')
<div class="main-panel" style="width: 100%; overflow: scroll;">
    <div class="content-wrapper">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1>{{ __('messages.create_about') }}</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('abouts.store', ['lang' => app()->getLocale()]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @foreach (['en','ar'] as $lang)
                            <div class="form-group">
                                <label for="name_{{ $lang }}">{{ __('messages.name') }} ({{ strtoupper($lang) }}):</label>
                                <input type="text" class="form-control" name="name_{{ $lang }}" id="name_{{ $lang }}" value="{{ old('name_' . $lang) }}" >
                                @error('name_' . $lang)
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                        
                        @foreach (['en','ar'] as $lang)
                            <div class="form-group">
                                <label for="description_{{ $lang }}">{{ __('messages.description') }} ({{ strtoupper($lang) }}):</label>
                                <textarea class="form-control" name="desc_{{ $lang }}" id="desc_{{ $lang }}" >{!! old('desc_' . $lang) !!}</textarea>
                                @error('description_' . $lang)
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                        <div class="form-group">
                            <label for="image">{{ __('messages.image') }}</label>
                            <div id="drop-area" class="drop-area">
                                <p>{{ __('messages.drag_drop_image') }}</p>
                                <input type="file" name="image" id="image" class="form-control"  style="display: none;">
                                <img id="image-preview" src="#" alt="Image Preview" style="display: none; margin-top: 10px; max-width: 100%;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gallery_images">{{ __('messages.gallery_images') }}</label>
                            <div id="gallery-drop-area" class="drop-area">
                                <p>{{ __('messages.drag_drop_gallery_images') }}</p>
                                <input type="file" name="images[]" id="gallery_images" class="form-control" multiple style="display: none;">
                                <div id="gallery-preview" style="margin-top: 10px;"></div>
                            </div>
                        </div>

                        @error('images')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror

                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="fas fa-plus-circle"></i> {{ __('messages.create_about') }}
                        </button>
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
    }
    .drop-area.hover {
        border-color: #333;
    }
    .gallery-image {
        display: inline-block;
        margin: 5px;
        max-width: 100px;
        max-height: 100px;
    }
</style>

<script>
    // Handle single image upload
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Highlight drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, () => dropArea.classList.add('hover'), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, () => dropArea.classList.remove('hover'), false);
    });

    // Handle dropped files
    dropArea.addEventListener('drop', handleDrop, false);
    dropArea.addEventListener('click', () => fileInput.click());

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    function handleFiles(files) {
        if (files.length) {
            const file = files[0];
            // Update the file input with the dropped file
            fileInput.files = files; // This line ensures the dropped file is set
            displayImage(file);
        }
    }

    fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            displayImage(file);
        }
    });

    function displayImage(file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block'; // Show the image
        }
        reader.readAsDataURL(file);
    }

    // Handle gallery images upload
    const galleryDropArea = document.getElementById('gallery-drop-area');
    const galleryFileInput = document.getElementById('gallery_images');
    const galleryPreview = document.getElementById('gallery-preview');

    galleryDropArea.addEventListener('drop', handleGalleryDrop, false);
    galleryDropArea.addEventListener('click', () => galleryFileInput.click());

    function handleGalleryDrop(e) {
        preventDefaults(e); // Prevent default behavior
        const dt = e.dataTransfer;
        const files = dt.files;
        handleGalleryFiles(files);
    }

    galleryFileInput.addEventListener('change', (e) => {
        const files = e.target.files;
        if (files.length) {
            handleGalleryFiles(files);
        }
    });

    function handleGalleryFiles(files) {
        galleryPreview.innerHTML = ''; // Clear previous images
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('gallery-image');
                galleryPreview.appendChild(img);
            }
            reader.readAsDataURL(file);
        });

        // Update the file input with the dropped files
        galleryFileInput.files = files; // This line ensures the dropped files are set
    }
</script>

<script src="{{asset('assets/js/editor.init.js')}}"></script>
<script src="{{asset('assets/js/tinymce/tinymce.min.js')}}"></script>
@endsection
