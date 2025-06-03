@extends('website.layout.app')
@section('title','Category')
@section('content')

			<!-- banner of the page -->
			<section class="banner bg-full overlay" style="background-image: url({{ asset('images/bg/hero-bg-1.jpg') }});">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 text-center">
							<h1 class="main-heading3 text-uppercase">{{ __('messages.shop') }}</h1>
							<!-- breadcrumbs of the page -->
							<nav class="breadcrumbs text-center">
								<ul class="list-unstyled">
									<li><a href="home.html">{{ __('messages.home') }}</a></li>
									<li>></li>
									<li>{{ __('messages.shop') }}</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</section>
			<!-- Shop list of the page -->
			<div class="shop-list container">
				<div class="row holder">
					<div class="col-xs-6">
						<ul class="list-unstyled drop-down">
							<li>
								<a href="#">Category <i class="fa fa-angle-down"></i></a>
								<ul class="list-unstyled drop-down2">
									<li><a href="#">{{ __('messages.cat1') }}</a></li>
								</ul>
							</li>
						</ul>
						{{-- <span class="txt2 text-uppercase">SHOWING 1–12 OF 36 RESULTS</span> --}}
					</div>
					<div class="col-xs-6">
						<ul class="list-unstyled drop-down">
							<li>
								<a href="#">Category <i class="fa fa-angle-down"></i></a>
								<ul class="list-unstyled drop-down2">
									<li><a href="#">{{ __('messages.sub1') }}</a></li>
									<li><a href="#">{{ __('messages.sub2') }}</a></li>
								</ul>
							</li>
						</ul>
						{{-- <span class="txt2 text-uppercase">SHOWING 1–12 OF 36 RESULTS</span> --}}
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-3">
						<!-- Shop of the page -->
						<div class="shop text-center">
							<div class="img-holder">
								<img src="{{ asset('images/product/2341.webp') }}" alt="image description" class="img-responsive">
								<a href="#" class="cart text-center text-uppercase"> Add to Cart</a>
							</div>
							<strong class="price">SP 460.00</strong>
							<span class="txt"><a href="shop-detail.html">Name</a></span>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<!-- Shop of the page -->
						<div class="shop text-center">
							<div class="img-holder">
								<img src="{{ asset('images/product/allure.webp') }}" alt="image description" class="img-responsive">
								<a href="#" class="cart text-center text-uppercase"> Add to Cart</a>
							</div>
							<strong class="price">SP 460.00</strong>
							<span class="txt"><a href="shop-detail.html">Name</a></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<!-- Pagination of the page -->
						<ul class="nav-pagination list-unstyled text-center">
							<li class="prev"><a href="#">Prev</a></li>
							<li class="active"><a href="#">1</a></li>
							<li class="next"><a href="#">Next</a></li>
						</ul>
					</div>
				</div>
			</div>
@endsection