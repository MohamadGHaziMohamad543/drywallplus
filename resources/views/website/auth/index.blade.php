@extends('website.layout.app')
@section('title','Login')
@section('content')

			<!-- banner of the page -->
			<section class="banner bg-full overlay" style="background-image: url({{ asset('images/bg/hero-bg-1.jpg') }});">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 text-center">
							<h1 class="main-heading3 text-uppercase">Log in</h1>
							<!-- breadcrumbs of the page -->
							<nav class="breadcrumbs text-center">
								<ul class="list-unstyled">
									<li><a href="home.html">Home</a></li>
									<li>></li>
									<li>Login</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</section>
			<!-- login sec of the page -->
			<section class="login-sec" style="background:#FFF;">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<form action="{{ route('login', app()->getLocale()) }}" method="POST" style="border: 1px solid #0c753d;" class="signup-form text-center">
							@csrf
							<fieldset>
								<h2>Sign in to <span class="clr">drywallplus-sy</span></h2>
								<p>Enter your details below.</p>
								@if ($errors->any())
									<div style="color:red;">
										<ul>
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								@endif
								<div class="form-group">
									<input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="EMAIL ADDRESS">
									<input type="password" name="password" class="form-control" placeholder="PASSWORD">
								</div>
								<button type="submit" class="btn text-center text-uppercase">SIGN IN</button>
								<a href="#">forgot your password?</a>
							</fieldset>
						</form>
						</div>
					</div>
				</div>
			</section>
@endsection