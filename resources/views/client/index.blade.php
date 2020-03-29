@extends('layouts.shop')

@section('content')
<!--================Home Banner Area =================-->
<section class="home_banner_area">
    <div class="overlay"></div>
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content row">
                <div class="offset-lg-2 col-lg-8">
                    <h3 style="font-weight: 700;">STAY WARM.
                        <br />STAY DRY.</h3>
                    <p style="font-size: 2em;">Winter is not over, and we still have boots to get through it.</p>
                    <a class="white_bg_btn" href="{{ route('client.products.index') }}">View Collection</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Hot Deals Area =================-->
<section class="hot_deals_area section_gap">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="hot_deal_box">
                    <img class="img-fluid" src="{{ asset('/images/color-red.jpg') }}" alt="">
                    <div class="content">
                        <h2 style="font-weight: 700;">Color of the Month</h2>
                        <p>shop now</p>
                    </div>
                    <a class="hot_deal_link" href="{{ asset('/products?categories=red') }}"></a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hot_deal_box">
                    <img class="img-fluid" src="{{ asset('/images/color-black.jpg') }}" alt="">
                    <div class="content">
                        <h2 style="font-weight: 700;">Start your year with new colors</h2>
                        <p>shop now</p>
                    </div>
                    <a class="hot_deal_link" href="{{ asset('/products?categories=black') }}"></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Hot Deals Area =================-->
@endsection
