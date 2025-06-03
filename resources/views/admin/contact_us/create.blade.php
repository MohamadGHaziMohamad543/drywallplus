@extends('admin.layout.app')

@section('title', 'Create Contact Us')

@section('header')
    <link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.13.4/css/dataTables.material.min.css') }}">
    <link rel="stylesheet" href="{{ url('https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css') }}">
    <style>
        .create {
            margin-bottom: 20px;
        }
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
                            <h1>{{ __('messages.create_contact_us') }}</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                            <form method="POST" action="{{ route('contact-us.store', ['lang' => app()->getLocale()]) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">{{ __('messages.email') }}</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required>
                                </div>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="phone_number">{{ __('messages.phone') }}</label>
                                    <input type="number" name="phone" id="phone_number" value="{{ old('phone') }}" class="form-control" required>
                                </div>
                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="whatsapp_account">{{ __('messages.whatsapp_link') }}</label>
                                    <input type="url" name="whatsapp_link" id="whatsapp_account" value="{{ old('whatsapp_link') }}" class="form-control">
                                </div>
                                @error('whatsapp_link')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="facebook_page">{{ __('messages.facebook_link') }}</label>
                                    <input type="url" name="facebook_link" id="facebook_page" value="{{ old('facebook_link') }}" class="form-control">
                                </div>
                                @error('facebook_link')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="linkedin_page">{{ __('messages.linkedin_link') }}</label>
                                    <input type="url" name="linkedin_link" id="linkedin_page" value="{{ old('linkedin_link') }}" class="form-control">
                                </div>
                                @error('linkedin_link')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="instagram_page">{{ __('messages.instagram_link') }}</label>
                                    <input type="url" name="instagram_link" id="instagram_page" value="{{ old('instagram_link') }}" class="form-control">
                                </div>
                                @error('instagram_link')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="address_en">{{ __('messages.address') }}(EN)</label>
                                    <textarea name="address_en" id="address_en" class="form-control" required>{{ old('address_en') }}</textarea>
                                </div>
                                @error('address_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="address_ar">{{ __('messages.address') }}(AR)</label>
                                    <textarea name="address_ar" id="address_ar" class="form-control" required>{{ old('address_ar') }}</textarea>
                                </div>
                                @error('address_ar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="map_location">{{ __('messages.map') }}</label>
                                    <input type="url" name="map_link" id="map_location" value="{{ old('map_link') }}" class="form-control">
                                </div>
                                @error('map_link')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
