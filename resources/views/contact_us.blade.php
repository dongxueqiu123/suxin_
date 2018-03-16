@extends('layouts.app')

@section('content')
<section class="section bottom_slider_section bottom_slider_section-contactus">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="contact_card contact_card-contactus">
                    <div class="contact_card-headline">
                        <p>@lang('common.contact.headline')</p>
                    </div>
                    <div class="contact_card-body">
                        <div>
                            <p><span>@lang('common.contact.sales_hotline')</span>: <span>+86 400-700-9141</span></p>
                            <p><span>@lang('common.contact.hq')</span>: <span>@lang('common.contact.hq_address')</span></p>
                            <p><span>@lang('common.contact.zip')</span>: <span>210012</span></p>
                            <p><span>@lang('common.contact.phone'):</span> <span>+86 025-84653149; 84653463; 84658394</span></p>
                            <p><span>@lang('common.contact.fax')</span>: <span>+86 025-84652134</span></p>
                            <p><span>@lang('common.contact.email')</span>: <span>suxiniot@gmail.com</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection