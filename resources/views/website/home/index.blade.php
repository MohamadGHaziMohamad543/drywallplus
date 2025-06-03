@extends('website.layout.app')
@section('title', __('messages.title'))
@section('content')

<!-- main slider of the page -->
<section class="main-slider slider2">
    @foreach([1,2,3] as $i)
        <div class="slide bg-full overlay" style="background-image: url({{ asset('images/bg/hero-bg-' . $i . '.jpg') }});">
            <div class="caption text-center">
                <span class="title text-uppercase">{{ __('messages.fast_reliable') }}</span>
                <h1 class="text-uppercase">{{ __('messages.roofing_services') }}</h1>
                <div class="btn-holder">
                    <a href="#" class="btn active text-center text-uppercase">{{ __('messages.our_project') }}</a>
                    <a href="#" class="btn text-center text-uppercase">{{ __('messages.get_quote') }}</a>
                </div>
            </div>
        </div>
    @endforeach
</section>

<!-- about section -->
<section class="abt-sec container">
    <div class="row" style="padding:40px;">
        <div class="col-xs-12 col-sm-8 col-md-6">
            <h2 class="main-heading text-uppercase">{!! __('messages.about_title') !!}</h2>
            <p>{{ __('messages.about_description') }}</p>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-6">
            <div class="img-holder">
                <img src="{{ asset('images/about.jpg') }}" alt="image description" class="img-responsive">
            </div>
        </div>
    </div>
</section>

<!-- service section -->
<section class="service-sec service2 bg-full overlay" style="background-image: url({{ asset('images/bg/service-bg.jpg') }});">
    <div class="container">
        <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <div class="service text-center">
                        <div class="img">
                            <img src="{{ asset('images/service/Fast Execution.png') }}" alt="icon" class="img-responsive">
                        </div>
                        <h2 class="text-uppercase">
                            <a href="">{{ app()->getLocale() == 'ar' ? 'سرعة التنفيذ' : 'Fast Execution' }}</a>
                        </h2>
                        <p>{{ app()->getLocale() == 'ar' ? 'نلتزم بإنهاء المشاريع في الوقت المحدد مع الحفاظ على أعلى جودة.' : 'We deliver projects on time while maintaining top quality.' }}
</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="service text-center">
                        <div class="img">
                            <img src="{{ asset('images/service/Professional Team.png') }}" alt="icon" class="img-responsive">
                        </div>
                        <h2 class="text-uppercase">
                            <a href="">            {{ app()->getLocale() == 'ar' ? 'احترافية فريق العمل' : 'Professional Team' }}
</a>
                        </h2>
                        <p> {{ app()->getLocale() == 'ar' ? 'فريقنا يتكون من خبراء متمرسين في مجال البناء والتشطيبات.' : 'Our team consists of experienced experts in construction and finishing.' }}
</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="service text-center">
                        <div class="img">
                            <img src="{{ asset('images/service/High-Quality Materials.png') }}" alt="icon" class="img-responsive">
                        </div>
                        <h2 class="text-uppercase">
                            <a href="">{{ app()->getLocale() == 'ar' ? 'جودة المواد' : 'High-Quality Materials' }}</a>
                        </h2>
                        <p>{{ app()->getLocale() == 'ar' ? 'نستخدم أفضل المواد والمواصفات العالمية لتحقيق نتائج تدوم طويلاً.' : 'We use premium materials to ensure long-lasting results.' }}
</p>
                    </div>
                </div>
        </div>
    </div>
</section>

<!-- why choose us -->
<section class="choose-sec container style2">
    <div class="row">
        <div class="col-xs-12 text-center">
            <h3 class="main-heading">{{ __('messages.why_choose_us') }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="img-holder">
                <img src="{{ asset('images/product/WHY1.jpg') }}" alt="image desciption" class="img-responsive">
            </div>
            <div class="img-holder">
                <div class="img-col">
                    <img src="{{ asset('images/product/WHY2.jpg') }}" alt="image description" class="img-responsive">
                </div>
                <div class="img-col">
                    <img src="{{ asset('images/product/WHY3.jpg') }}" alt="image description" class="img-responsive">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <ul class="list-unstyled choose-list">
                @foreach(['reliability', 'expertise', 'quality'] as $feature)
                    <li>
                        <span class="icon"><i class="fa fa-{{ $feature == 'reliability' ? 'thumbs-o-up' : ($feature == 'expertise' ? 'clock-o' : 'diamond') }}"></i></span>
                        <div class="txt-holder">
                            <h4 class="text-uppercase">{{ __('messages.' . $feature) }}</h4>
                            <p>{{ __('messages.feature_description') }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

<!-- testimonial section -->
<div class="testimonail-sec bg-full overlay" style="background-image: url({{ asset('images/product/WHY1.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="testimonail-slider">
                    @foreach(range(1,3) as $t)
                        <blockquote class="slide text-center">
                            <q>{{ __('messages.testimonial_text') }}</q>
                            <cite class="text-uppercase">{{ __('messages.testimonial_author') }}</cite>
                            <span>{{ __('messages.testimonial_position') }}</span>
                        </blockquote>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- help section -->
<section class="help-sec bg-full" style="background-image: url({{ asset('images/Banner.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="holder">
                    <h3 class="main-heading text-uppercase">{!! __('messages.help_title') !!}</h3>
                    <p>{{ __('messages.help_description') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
