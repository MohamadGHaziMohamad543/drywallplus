@extends('website.layout.app')
@section('title','Contact US')
@section('content')

			<!-- banner of the page -->
			<section class="banner bg-parallax overlay" style="background-image: url({{ asset('images/bg/hero-bg-1.jpg') }});">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 text-center">
							<h1 class="main-heading3 text-uppercase">Contact us</h1>
							<!-- breadcrumbs of the page -->
							<nav class="breadcrumbs text-center">
								<ul class="list-unstyled">
									<li><a href="home.html">Home</a></li>
									<li>></li>
									<li>Contact us</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</section>
			<!-- contact sec of the page -->
			<section class="contact-sec container">
				<div class="row">
					<div class="col-xs-12 col-sm-4">
						<h3>Contact Info</h3>
						<!-- Contact list of the page -->
						<ul class="list-unstyled contact-list">
							<li>
								<span class="icon ti-location-pin"></span>
								<address>1600 Amphitheatre Parkway <br>Mountain View CA 94043</address>
							</li>
							<li>
								<span class="icon ti-email"></span>
								<a href="mailto:&#105;&#110;&#102;&#111;&#046;&#100;&#101;&#101;&#114;&#099;&#114;&#101;&#097;&#116;&#105;&#118;&#101;&#064;&#103;&#109;&#097;&#105;&#108;&#046;&#099;&#111;&#109;">&#105;&#110;&#102;&#111;&#046;&#100;&#101;&#101;&#114;&#099;&#114;&#101;&#097;&#116;&#105;&#118;&#101;&#064;&#103;&#109;&#097;&#105;&#108;&#046;&#099;&#111;&#109;</a>
							</li>
							<li>
								<span class="icon ti-headphone-alt"></span>
								<a href="tel:18005596580">+1 800 559 6580</a>
							</li>
						</ul>
						<h3>Opening Hours</h3>
						<!-- Hour list of the page -->
						<ul class="list-unstyled hour-list">
							<li>Our support  24 / 7</li>
							<li>Monday – Friday: 9am-6pm</li>
							<li>Saturday: 10am-4pm</li>
							<li>Sunday: 10am-1pm</li>
						</ul>
					</div>
					<div class="col-xs-12 col-sm-8">
						<h3 class="marg">Get In Touch With Us</h3>
						<p>If you have any question, Please don’t hesitate to send us a message</p>
						<!-- Contact Form of the page -->
						<form action="#" class="contact-form">
							<fieldset>
								<div class="form-group">
									<div class="col">
										<input type="text" class="form-control" placeholder="Your Name">
									</div>
									<div class="col">
										<input type="email" class="form-control" placeholder="Your Email">
									</div>
								</div>
								<textarea class="form-control" placeholder="Your Message"></textarea>
								<button type="submit" class="btn text-uppercase text-center md-round">Send us</button>
							</fieldset>
						</form>
					</div>
				</div>
			</section>
			<!-- map sec of the page -->
			<section class="map-sec">
				<div class="map" data-lat="52.392363" data-lng="1.480408" data-zoom="8">
					<div class="map-info">
            			<h2 class="text-uppercase">VICIN</h2>
            			<address>1600 Amphitheatre Parkway <br>Mountain View CA 94043</address>
        			</div>
        		</div>
			</section>
@endsection