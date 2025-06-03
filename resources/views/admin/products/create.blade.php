@extends('admin.layout.app')
@section('title', 'Create Product')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-box-open"></i> Create New Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store', ['lang' => app()->getLocale()]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Product Names --}}
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="name_en"><i class="fas fa-tag"></i> Product Name (English)</label>
                        <input type="text" name="name_en" class="form-control" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="name_ar"><i class="fas fa-tag"></i> Product Name (Arabic)</label>
                        <input type="text" name="name_ar" class="form-control" required>
                    </div>
                </div>

                {{-- Descriptions --}}
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="description_en"><i class="fas fa-align-left"></i> Description (English)</label>
                        <textarea name="description_en" id="desc_de" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="description_ar"><i class="fas fa-align-left"></i> Description (Arabic)</label>
                        <textarea name="description_ar" id="desc_nl" class="form-control" rows="3" required></textarea>
                    </div>
                </div>

                {{-- Overview --}}
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="overview_en"><i class="fas fa-eye"></i> Overview (English)</label>
                        <textarea name="overview_en" id="desc_fr" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="overview_ar"><i class="fas fa-eye"></i> Overview (Arabic)</label>
                        <textarea name="overview_ar" id="desc_zh" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                {{-- Details --}}
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="details_en"><i class="fas fa-info-circle"></i> More Details (English)</label>
                        <textarea name="details_en" id="desc_en" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="details_ar"><i class="fas fa-info-circle"></i> More Details (Arabic)</label>
                        <textarea name="details_ar" id="desc_ar" class="form-control" rows="4"></textarea>
                    </div>
                </div>

                {{-- Sub-subcategory --}}
                <div class="form-group">
                    <label for="sub_sub_category_id"><i class="fas fa-layer-group"></i> Sub Subcategory</label>
                    <select name="sub_sub_category_id" class="form-control" required>
                        <option value="">Select</option>
                        @foreach ($subsubcategories as $sub)
                            <option value="{{ $sub->id }}">{{ $sub->name_en }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Main Image --}}
                <div class="form-group">
                    <label for="image"><i class="fas fa-image"></i> Main Image</label>
                    <input type="file" name="image" class="form-control-file">
                </div>
                    <br>
                    <hr>
                    <br>

                {{-- Additional Images --}}
                <div class="form-group">
                    <label for="images"><i class="fas fa-images"></i> Additional Product Images</label>
                    <input type="file" name="images[]" class="form-control-file" multiple>
                </div>
                    <br>
                    <hr>
                    <br>

                {{-- Multiple Files --}}
                <div class="row">
                    @php
                        $fileFields = [
                            'catalogs' => 'Catalogs',
                            'safety_data_sheets' => 'Safety Data Sheets',
                            'product_catalogs' => 'Product Catalogs',
                            'installation_guides' => 'Installation Guides',
                            'product_files' => 'Product Files',
                            'warranties' => 'Warranties',
                            'company_files' => 'Company Files'
                        ];
                    @endphp

                    @foreach ($fileFields as $field => $label)
                    <div class="col-md-6 form-group">
                        <label for="{{ $field }}"><i class="fas fa-file-upload"></i> {{ $label }}</label>
                        <input type="file" name="{{ $field }}[]" class="form-control-file" multiple>
                    </div>
                    <br>
                    <hr>
                    <br>
                    @endforeach
                </div>

                {{-- Submit Button --}}
                <div class="text-right mt-4">
                    <button type="submit" class="btn btn-success px-4 py-2">
                        <i class="fas fa-save"></i> Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/editor.init.js')}}"></script>
<script src="{{asset('assets/js/tinymce/tinymce.min.js')}}"></script>
@endsection
