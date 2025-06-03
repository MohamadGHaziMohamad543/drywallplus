@extends('admin.layout.app')
@section('title','Dashboard')
@section('content_header')
<h4 class="page-title mb-1">Welcome, {{ Auth::user()->name }}</h4>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Welcome Admin</a></li>
                                    </ol>
@endsection
@section('content')
<div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
            
                                            <h4 class="header-title">Welcome, {{ Auth::user()->name }}</h4>
                                            <p class="card-title-desc">
                                                
                                            </p>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
@endsection