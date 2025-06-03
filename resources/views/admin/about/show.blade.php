@extends('admin.layout.app')
@section('title', __('messages.about_details'))
@section('header')
    <link rel="stylesheet" href="{{url('https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{url('https://cdn.datatables.net/1.13.4/css/dataTables.material.min.css')}}">
    <link rel="stylesheet" href="{{url('https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css')}}" />
    <style>
        /* Custom styles */
        .image-preview {
            max-width: 100px;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
<div class="main-panel" style="width: 100%;">
    <div class="content-wrapper">
        <div class="row">
            <div class="col grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ __('messages.about_details') }}</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>{{ __('messages.name') }} :</strong> {{ $about->{$name} ?? $about->name_en  }} <br>
                            </div>
                            <div class="col-md-6">
                                <strong>{{ __('messages.image') }}:</strong> 
                                @if($about->image)
                                    <a href="{{ asset($about->image) }}" target="_blank" data-fancybox="gallery">
                                        <img src="{{ asset($about->image) }}" class="image-preview" alt="Event Image" />
                                    </a>
                                @else
                                    {{ __('messages.no_image') }}
                                @endif
                                <br>
                                <strong>{{ __('messages.description') }}:</strong>
                                {!! $about->{$desc} ?? $about->desc_en!!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                

                            @if(!empty($about->images))
                                            @php
                                                $images = is_array($about->images) ? $about->images : json_decode($about->images, true);
                                            @endphp

                                            @foreach($images as $image)
                                                        <img src="{{ asset($image) }}" width="100" class="image-preview" alt="About Image" />
                                                @endforeach
                                            @endif
                            </div>
                        </div>
                        <br>
                        <a href="{{ route('abouts.index', ['lang' => app()->getLocale()]) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> ~
                        </a>
                        <form id="delete-form-{{ $about->id }}" action="{{ route('abouts.destroy', ['about' => $about->id, 'lang' => app()->getLocale()]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $about->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{url('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
<script>
    function confirmDelete(eventId) {
        const messages = {
            'en': "Are you sure you want to delete this event?",
            'ar': "هل أنت متأكد أنك تريد حذف هذا الحدث؟",
            'de': "Sind Sie sicher, dass Sie dieses Event löschen möchten?",
            'tr': "Bu etkinliği silmek istediğinizden emin misiniz?",
            'zh': "您确定要删除此事件吗？",
            'fr': "Êtes-vous sûr de vouloir supprimer cet événement ?",
            'nl': "Weet u zeker dat u dit evenement wilt verwijderen?"
        };

        let currentLang = "{{ app()->getLocale() }}";
        let confirmMessage = messages[currentLang] || messages['en'];

        Swal.fire({
            title: confirmMessage,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + eventId).submit(); // Delete the event
            }
        });
    }
</script>
@endsection
