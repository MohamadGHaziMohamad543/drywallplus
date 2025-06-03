<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" >
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title')</title>
	<link href="{{ url('https://fonts.googleapis.com/css?family=Arizonia%7COpen+Sans:300,300i,400,400i,600,700,800%7CRoboto:300,400,500,700') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('css/plugins.css') }}">
	<link rel="stylesheet" href="{{ asset('css/icofont.css') }}">
	<link rel="stylesheet" href="{{ asset('style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/colors.css') }}">
	<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
	<script src="{{ url('https://mozilla.github.io/pdf.js/build/pdf.js') }}"></script>
	<link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css') }}" />
	<script src="{{ url('https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js') }}"></script>
</head>
<body>
<style>
	.lightbox:hover { color:#0c753d; }
	#nav ul > li { margin:0; }
	.header-holder { background:#fff; border-top:1px dotted #0c753d; }
</style>

<div id="wrapper">
	<header id="header" class="style2">
		<div class="header-area">
			<div class="container">
				<div class="row">
					<div class="col-xs-12" style="display: flex; justify-content: space-around; align-items:center;">
						<ul class="contact-list list-unstyled">
							<div class="logo">
								<a href="{{ route('home.page', app()->getLocale()) }}">
									<img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="img-responsive">
								</a>
							</div>
						</ul>
						<div class="language">
							<a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), 'en') }}" class="lightbox">En</a>
							|
							<a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), 'ar') }}" class="lightbox">Ar</a>
						</div>
						{{-- <ul class="sign-up list-unstyled">
							<li><a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), 'en') }}" class="lightbox">En</a></li>
							<li>|</li>
							<li><a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), 'ar') }}" class="lightbox">Ar</a></li>
						</ul> --}}
					</div>
				</div>
			</div>
		</div>

		<div class="header-holder">
			<div class="container">
				<div class="row" style="padding:0;width:100%;">
					<div class="col-xs-12" style="padding:0;width:100%;">
						<a href="#" class="nav-opener text-center md-round"><i class="fa fa-bars"></i></a>
						<nav id="nav" style="padding:0;width:100%;padding-top:20px;">
							<ul class="list-unstyled" style="display:flex;justify-content:space-between;padding:0;width:100%;">
								<li><a href="{{ route('home.page', app()->getLocale()) }}">{{ __('messages.home') }}</a></li>
								@foreach ($global_categories as $category)
								<li><a href="{{ route('category.page', app()->getLocale()) }}">{{ $category->name_en }}</a></li>
								@endforeach
								
								<li><a href="{{ route('category.page', app()->getLocale()) }}">{{ __('messages.faq_section') }}</a></li>
								<li><a href="{{ route('catalog.page', app()->getLocale()) }}">{{ __('messages.catalog') }}</a></li>
								<li><a href="{{ route('faq.page', app()->getLocale()) }}">{{ __('messages.faq') }}</a></li>
								<li><a href="{{ route('contact.page', app()->getLocale()) }}">{{ __('messages.contact_us') }}</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</header>

	<main id="main">
		@yield('content')
	</main>

	<footer id="footer">
		<div class="footer-holder">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-3">
						<h3 class="text-uppercase">{{ __('messages.about_us') }}</h3>
						<p>{{ __('messages.about_us_description') }}</p>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<h3 class="text-uppercase">{{ __('messages.get_in_touch') }}</h3>
						<ul class="list-unstyled contact-list">
							<li>
								<span class="icon ti-location-pin"></span>
								<address>{{ __('messages.address') }}</address>
							</li>
							<li>
								<span class="icon ti-email"></span>
								<a href="mailto:info@drywallplus-sy.com">info@drywallplus-sy.com</a>
							</li>
							<li>
								<span class="icon ti-headphone-alt"></span>
								<a href="tel:18005596580">+1 800 559 6580</a>
							</li>
						</ul>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<h3 class="text-uppercase">{{ __('messages.opening_hours') }}</h3>
						<ul class="list-unstyled hour-list">
							<li>{{ __('messages.support_24_7') }}</li>
							<li>{{ __('messages.monday_friday') }}</li>
							<li>{{ __('messages.saturday') }}</li>
							<li>{{ __('messages.sunday') }}</li>
						</ul>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<h3 class="text-uppercase">{{ __('messages.subscribe') }}</h3>
						<p>{{ __('messages.subscribe_description') }}</p>
						<form action="#" class="subscribe-form">
							<fieldset>
								<input type="email" class="form-control" placeholder="{{ __('messages.your_email_here') }}">
								<button type="submit"><i class="fa fa-paper-plane-o"></i></button>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-area">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<p>{{ __('messages.copyright') }}</p>
					</div>
					<div class="col-xs-12 col-sm-6">
						<ul class="socail-network list-unstyled">
							<li><a href="#" class="social_facebook"></a></li>
							<li><a href="#" class="social_linkedin"></a></li>
							<li><a href="#" class="social_twitter"></a></li>
							<li><a href="#" class="fa fa-google-plus"></a></li>
							<li><a href="#" class="social_pinterest"></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<span id="back-top" class="text-center md-round fa fa-caret-up"></span>
	<div id="loader" class="loader-holder">
		<div class="block"><img src="{{ asset('images/svg/hearts.svg') }}" width="100" alt="loader"></div>
	</div>
</div>

<script src="{{ url('https://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.22&key=AIzaSyDfI624nPMEKE1g3DBAHiiFOD5pb2NB5Sk') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/plugins.js') }}"></script>
<script src="{{ asset('js/jquery.main.js') }}"></script>
@yield('scripts')
</body>
</html>
