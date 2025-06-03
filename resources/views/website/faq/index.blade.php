@extends('website.layout.app')
@section('title','Faq')
@section('content')

			<!-- banner of the page -->
			<section class="banner bg-full overlay" style="background-image: url({{ asset('images/bg/hero-bg-1.jpg') }});">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 text-center">
							<h1 class="main-heading3 text-uppercase">Faq</h1>
							<!-- breadcrumbs of the page -->
							<nav class="breadcrumbs text-center">
								<ul class="list-unstyled">
									<li><a href="home.html">Home</a></li>
									<li>></li>
									<li>Faq</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</section>
			<!-- faq sec of the page -->
			<div class="faq-sec container">
				<div class="row">
					<div class="col-xs-12">
						<!-- accordion of the page -->
						<ul class="accordion list-unstyled">
							<li class="active">
								<a class="opener" href="#">How do I become an author? <i class="ti-minus"></i> <i class="ti-plus"></i></a>
								<div class="slide">
									<p>The graphical control element accordion is a vertically stacked list of items, such as labels or thumbnails. Each item can be "expanded" or "stretched" to reveal the content associated with that item. There can be zero expanded items, exactly one, or more than one item expanded at a time, depending on the configuration.</p>
								</div>
							</li>
							<li>
								<a class="opener" href="#">Is my license transferable? <i class="ti-minus"></i> <i class="ti-plus"></i></a>
								<div class="slide">
									<p>The graphical control element accordion is a vertically stacked list of items, such as labels or thumbnails. Each item can be "expanded" or "stretched" to reveal the content associated with that item. There can be zero expanded items, exactly one, or more than one item expanded at a time, depending on the configuration.</p>
								</div>
							</li>
							<li>
								<a class="opener" href="#">What do you mean by item and end product? <i class="ti-minus"></i> <i class="ti-plus"></i></a>
								<div class="slide">
									<p>The graphical control element accordion is a vertically stacked list of items, such as labels or thumbnails. Each item can be "expanded" or "stretched" to reveal the content associated with that item. There can be zero expanded items, exactly one, or more than one item expanded at a time, depending on the configuration.</p>
								</div>
							</li>
							<li>
								<a class="opener" href="#">Am I allowed to modify the item that I purchased? <i class="ti-minus"></i> <i class="ti-plus"></i></a>
								<div class="slide">
									<p>The graphical control element accordion is a vertically stacked list of items, such as labels or thumbnails. Each item can be "expanded" or "stretched" to reveal the content associated with that item. There can be zero expanded items, exactly one, or more than one item expanded at a time, depending on the configuration.</p>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
@endsection