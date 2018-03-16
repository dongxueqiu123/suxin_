@extends('layouts.app')

@section('content')
<section class="section">
    <div class="top-slider-wrap">
        <div class="top_slick_slider" id="top_slick_slider">
            <div class="item">
                <?php if(app()->getLocale() === 'ch') { ?>
                <img src="{{ asset('images/slider/analytics_slider_1_ch.jpg') }}" />
                <?php } else { ?>
                <img src="{{ asset('images/slider/analytics_slider_1_en.jpg') }}" />
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<section class="section bottom_slider_section bottom_slider_section-analytics">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="headline">
                    <p>@lang('common.sliders.analysis.title')</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="bottom_slick_slider" id="bottom_slick_slider">
                    <div class="item">
                        <img src="{{ asset('images/slider/analysis/1.jpg') }}" />
                        <p>@lang('common.sliders.analysis.1')</p>
                    </div>
                    <div class="item">
                        <img src="{{ asset('images/slider/analysis/2.jpg') }}" />
                        <p>@lang('common.sliders.analysis.2')</p>
                    </div>
                    <div class="item">
                        <?php if(app()->getLocale() === 'ch') { ?>
                        <img src="{{ asset('images/slider/analysis/3_ch.png') }}" />
                        <?php } else { ?>
                        <img src="{{ asset('images/slider/analysis/3_en.png') }}" />
                        <?php } ?>
                        <p>@lang('common.sliders.analysis.3')</p>
                    </div>
                    <div class="item">
                        <img src="{{ asset('images/slider/analysis/4.jpg') }}" />
                        <p>@lang('common.sliders.analysis.4')</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection