@extends('layouts.app')

@section('content')

<section class="section">
    <div class="top-slider-wrap">
        <div class="top_slick_slider home" id="top_slick_slider">
            <div class="item">
                <?php if(app()->getLocale() === 'ch') { ?>
                <img src="{{ asset('images/slider/home_slider_1_ch.jpg') }}" />
                <?php } else { ?>
                <img src="{{ asset('images/slider/home_slider_1_en.jpg') }}" />
                <?php } ?>
            </div>
            <div class="item">
                <?php if(app()->getLocale() === 'ch') { ?>
                <img src="{{ asset('images/slider/home_slider_2_ch.jpg') }}" />
                <?php } else { ?>
                <img src="{{ asset('images/slider/home_slider_2_en.jpg') }}" />
                <?php } ?>
            </div>
            <div class="item">
                <?php if(app()->getLocale() === 'ch') { ?>
                <img src="{{ asset('images/slider/home_slider_3_ch.jpg') }}" />
                <?php } else { ?>
                <img src="{{ asset('images/slider/home_slider_3_en.jpg') }}" />
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<section class="section bottom_slider_section bottom_slider_section-home">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="contact_card">
                    <div class="contact_card-headline">
                        <p>@lang('common.home.app.headline')</p>
                    </div>
                    <div class="contact_card-body">
                        <div>
                            <p>@lang('common.home.app.p1')</p>
                            <p>@lang('common.home.app.p2')</p>
                            <p>@lang('common.home.app.p3')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="bottom_slick_slider" id="bottom_slick_slider">
                    <div class="item">
                        <img src="{{ asset('images/slider/home/yawei-1.jpg') }}" />
                        <p>
                            <a href="http://www.yawei.cc" target="_blank">@lang('common.home.app.l4')</a>
                        </p>
                    </div>
                    <div class="item">
                        <img src="{{ asset('images/slider/home/yawei-2.jpg') }}" />
                        <p>
                            <a href="http://www.yawei.cc" target="_blank">@lang('common.home.app.l4')</a>
                        </p>
                    </div>
                    <div class="item">
                        <img src="{{ asset('images/slider/home/nangaochi.jpg') }}" />
                        <p>
                            <a href="http://www.ngctransmission.com/zh/home.html" target="_blank">@lang('common.home.app.l1')</a>
                        </p>
                    </div>
                    <div class="item">
                        <img src="{{ asset('images/slider/home/xugong.jpg') }}" />
                        <p>
                            <a href="http://www.xcmg.com/" target="_blank">@lang('common.home.app.l2')</a>
                        </p>
                    </div>
                    <div class="item">
                        <img src="{{ asset('images/slider/home/guomao.jpg') }}" />
                        <p>
                            <a href="http://www.jsgmjsj.cn/" target="_blank">@lang('common.home.app.l3')</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-clients">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="headline">
                    <p>@lang('common.home.clients.title')</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <div class="testimonial testimonial-thumb-side v-animation" data-animation="fade-from-bottom" data-delay="0">
                    <div class="testimonial_author">
                        <div class="testimonial_author-thumb">
                            <img src="{{ asset('images/team/team_8.jpg') }}" />
                        </div>
                    </div>
                    <div class="testimonial_info">
                        <p class="testimonial_info-excerpt">@lang('common.home.clients.c1.excerpt')</p>
                        <p class="testimonial_info-user">
                            - Victor Polyakov <span>CEO, Tibbo Systems</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="testimonial testimonial-thumb-side v-animation" data-animation="fade-from-bottom" data-delay="200">
                    <div class="testimonial_author">
                        <div class="testimonial_author-thumb">
                            <img src="{{ asset('images/team/team_7.jpg') }}" />
                        </div>
                    </div>
                    <div class="testimonial_info">
                        <p class="testimonial_info-excerpt">@lang('common.home.clients.c2.excerpt')</p>
                        <p class="testimonial_info-user">
                            - Louis Columbus <span>Forbes Contributor</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="testimonial testimonial-thumb-side v-animation" data-animation="fade-from-bottom" data-delay="400">
                    <div class="testimonial_author">
                        <div class="testimonial_author-thumb">
                            <img src="{{ asset('images/team/team_6.jpg') }}" />
                        </div>
                    </div>
                    <div class="testimonial_info">
                        <p class="testimonial_info-excerpt">@lang('common.home.clients.c3.excerpt')</p>
                        <p class="testimonial_info-user">
                            - Siegfried Dais, <span>Deputy Chairman, Robert Bosch GmbH</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection