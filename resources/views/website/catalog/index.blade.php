@extends('website.layout.app')
@section('title','Catalog')
@section('content')

<!-- banner of the page -->
<section class="banner bg-full overlay" style="background-image: url({{ asset('images/bg/hero-bg-1.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1 class="main-heading3 text-uppercase">Catalog</h1>
                <!-- breadcrumbs of the page -->
                <nav class="breadcrumbs text-center">
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>></li>
                        <li>Catalog</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Catalog Slider -->
<div class="container my-5">
    <h2 class="text-center mb-4">Our Catalog</h2>

    <!-- Slider Container -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper" id="pdf-slider">
            <!-- PDF Pages will appear here -->
        </div>
        <!-- Navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <!-- Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>

@endsection

@section('scripts')
<!-- PDF.js CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

<!-- Swiper CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
    const url = "{{ asset('catalogs/catalog.pdf') }}";

    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    async function renderPDFSlider(url) {
        const pdf = await pdfjsLib.getDocument(url).promise;
        const container = document.getElementById('pdf-slider');

        for (let pageNumber = 1; pageNumber <= pdf.numPages; pageNumber++) {
            const page = await pdf.getPage(pageNumber);
            const viewport = page.getViewport({ scale: 1.5 });

            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            await page.render({ canvasContext: context, viewport: viewport }).promise;

            const slide = document.createElement('div');
            slide.className = 'swiper-slide';
            slide.appendChild(canvas);

            container.appendChild(slide);
        }

        // Initialize Swiper after rendering all PDF pages
        new Swiper(".mySwiper", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    }

    renderPDFSlider(url);
</script>
@endsection
