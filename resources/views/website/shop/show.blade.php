@extends('website.layout.app')
@section('title','Product')
@section('content')

			<!-- banner of the page -->
			<section class="banner bg-full overlay" style="background-image: url({{ asset('images/bg/hero-bg-1.jpg') }});">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 text-center">
							<h1 class="main-heading3 text-uppercase">Shop</h1>
							<!-- breadcrumbs of the page -->
							<nav class="breadcrumbs text-center">
								<ul class="list-unstyled">
									<li><a href="home.html">Home</a></li>
									<li>></li>
									<li><a href="shop.html">Shop</a></li>
									<li>></li>
									<li>Name</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</section>
			<!-- shop detail of the page -->
			<section class="shop-detail container">
				<div class="row">
					<div class="col-xs-12 col-md-9">
						<div class="holder">
							<div class="img-holder">
								<img src="{{ asset('images/product/allure.webp') }}" alt="image description" class="img-responsive">
							</div>
							<div class="txt-holder">
								<h4>Name</h4>
								<strong class="price">SP 460.00</strong>
								<ul class="list-unstyled rating-list">
									<li><a href="#" class="active"><i class="ti-star"></i></a></li>
									<li><a href="#" class="active"><i class="ti-star"></i></a></li>
									<li><a href="#" class="active"><i class="ti-star"></i></a></li>
									<li><a href="#" class="active"><i class="ti-star"></i></a></li>
									<li><a href="#"><i class="ti-star"></i></a></li>
								</ul>
								<p>Consequatuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
								<form action="#" class="cart-form">
									<fieldset>
										<select>
											<option value="0">0</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
										</select>
									</fieldset>
								</form>
								<a href="#" class="btn text-center text-uppercase">Add to Cart</a>
							</div>
						</div>
						<ul class="tabset list-unstyled">
							<li><a href="#tab1" class="active">Description</a></li>
							<li><a href="#tab2">Reviews (2)</a></li>
						</ul>
						<div class="tab-content">
							<div id="tab1" class="active">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
								<p>Nemquia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
							</div>
							<div id="tab2">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
								<p>Nemquia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
							</div>
						</div>
						<h3>Related Products</h3>
						<div class="shop text-center">
							<div class="img-holder">
								<img src="{{ asset('images/product/allure.webp') }}" alt="image description" class="img-responsive">
								<a href="#" class="cart text-center text-uppercase"> Add to Cart</a>
							</div>
							<strong class="price">SP 360.00</strong>
							<span class="txt"><a href="shop-detail.html">Name</a></span>
						</div>
						<div class="shop text-center">
							<div class="img-holder">
								<img src="{{ asset('images/product/allure.webp') }}" alt="image description" class="img-responsive">
								<span class="offer text-uppercase text-center">NEW</span>
								<a href="#" class="cart text-center text-uppercase"> Add to Cart</a>
							</div>
							<strong class="price">SP 271.00</strong>
							<span class="txt"><a href="shop-detail.html">Combination Hammer</a></span>
						</div>
						<div class="shop text-center">
							<div class="img-holder">
								<img src="{{ asset('images/product/allure.webp') }}" alt="image description" class="img-responsive">
								<a href="#" class="cart text-center text-uppercase"> Add to Cart</a>
							</div>
							<strong class="price">SP 199.00</strong>
							<span class="txt"><a href="shop-detail.html">Combination Hammer</a></span>
						</div>
					</div>
					<div class="col-xs-12 col-md-3">
						<section class="widget">
							<h3>Top Rated Products</h3>
							<ul class="list-unstyled pro-list">
								<li>
									<div class="img-holder">
										<a href="#"><img src="{{ asset('images/product/allure.webp') }}" alt="image description" class="img-responsive"></a>
									</div>
									<div class="txt-holder">
										<div class="header">
											<span class="name"><a href="#">Consequatuis</a></span>
											<strong class="price">SP 460.00</strong>
										</div>
										<ul class="list-unstyled rating-list">
											<li><a href="#" class="active"><i class="ti-star"></i></a></li>
											<li><a href="#" class="active"><i class="ti-star"></i></a></li>
											<li><a href="#" class="active"><i class="ti-star"></i></a></li>
											<li><a href="#"><i class="ti-star"></i></a></li>
											<li><a href="#"><i class="ti-star"></i></a></li>
										</ul>
									</div>
								</li>
								<li>
									<div class="img-holder">
										<a href="#"><img src="{{ asset('images/product/allure.webp') }}" alt="image description" class="img-responsive"></a>
									</div>
									<div class="txt-holder">
										<div class="header">
											<span class="name"><a href="#">Consequatuis</a></span>
											<strong class="price">SP 360.00</strong>
										</div>
										<ul class="list-unstyled rating-list">
											<li><a href="#" class="active"><i class="ti-star"></i></a></li>
											<li><a href="#" class="active"><i class="ti-star"></i></a></li>
											<li><a href="#" class="active"><i class="ti-star"></i></a></li>
											<li><a href="#"><i class="ti-star"></i></a></li>
											<li><a href="#"><i class="ti-star"></i></a></li>
										</ul>
									</div>
								</li>
								<li>
									<div class="img-holder">
										<a href="#"><img src="{{ asset('images/product/allure.webp') }}" alt="image description" class="img-responsive"></a>
									</div>
									<div class="txt-holder">
										<div class="header">
											<span class="name"><a href="#">Consequatuis</a></span>
											<strong class="price">SP 260.00</strong>
										</div>
										<ul class="list-unstyled rating-list">
											<li><a href="#" class="active"><i class="ti-star"></i></a></li>
											<li><a href="#" class="active"><i class="ti-star"></i></a></li>
											<li><a href="#" class="active"><i class="ti-star"></i></a></li>
											<li><a href="#"><i class="ti-star"></i></a></li>
											<li><a href="#"><i class="ti-star"></i></a></li>
										</ul>
									</div>
								</li>
							</ul>
						</section>
					</div>
				</div>
			</section>
@endsection