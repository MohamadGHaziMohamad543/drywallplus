@extends('admin.layout.app')

@section('title', 'Edit Contact Us')

@section('header')
    <link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.13.4/css/dataTables.material.min.css') }}">
    <link rel="stylesheet" href="{{ url('https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css') }}">
    <style>
        .form-group label {
            font-weight: bold;
        }
        .form-group input, .form-group textarea {
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="main-panel" style="width: 100%;overflow: scroll;">
        <div class="content-wrapper">
            <div class="row">
                <div class="col grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h1>{{ __('messages.edit_contact_us') }}</h1>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('contact-us.update', ['lang' => app()->getLocale(), 'contact_u' => $contactUs->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="email">{{ __('messages.email') }}</label>
                                    <input type="email" name="email" id="email" value="{{ $contactUs->email }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">{{ __('messages.phone') }}</label>
                                    <input type="number" name="phone" id="phone_number" value="{{ $contactUs->phone }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="whatsapp_account">{{ __('messages.whatsapp_link') }}</label>
                                    <input type="url" name="whatsapp_link" id="whatsapp_account" value="{{ $contactUs->whatsapp_link }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="facebook_page">{{ __('messages.facebook_link') }}</label>
                                    <input type="url" name="facebook_link" id="facebook_page" value="{{ $contactUs->facebook_link }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="linkedin_page">{{ __('messages.linkedin_link') }}</label>
                                    <input type="url" name="linkedin_link" id="linkedin_page" value="{{ $contactUs->linkedin_link }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="instagram_page">{{ __('messages.instagram_link') }}</label>
                                    <input type="url" name="instagram_link" id="instagram_page" value="{{ $contactUs->instagram_link }}" class="form-control">
                                </div>
                                @foreach(['en', 'ar'] as $lang)
                                    <div class="form-group">
                                        <label for="address_{{ $lang }}">{{__('messages.address')}} ({{strtoupper($lang)}}):</label>
                                        <textarea name="address_{{ $lang }}" id="address_{{ $lang }}" class="form-control" required>{{ $contactUs->{'address_'.$lang} }}</textarea>
                                    </div>
                                @endforeach
                                <div class="form-group">
                                    <label for="map_location">{{ __('messages.map') }}</label>
                                    <input type="url" name="map_link" id="map_location" value="{{ $contactUs->map_link }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ __('messages.save_changes') }}</button>
                                    <a href="{{ route('contact-us.index', ['lang' => app()->getLocale()]) }}" class="btn btn-secondary">{{ __('messages.Cancel') }}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
