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
                    <a class="hot_deal_link" href="#"></a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hot_deal_box">
                    <img class="img-fluid" src="{{ asset('/images/color-yellow.jpg') }}" alt="">
                    <div class="content">
                        <h2 style="font-weight: 700;">Start your year with new colors</h2>
                        <p>shop now</p>
                    </div>
                    <a class="hot_deal_link" href="#"></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Hot Deals Area =================-->

<!--================ Subscription Area ================-->
<section class="subscription-area section_gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center">
                    <h2>Subscribe for Our Newsletter</h2>
                    <span>We won’t send any kind of spam</span>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div id="mc_embed_signup">
                    <form target="_blank" novalidate action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&id=92a4423d01" method="get" class="subscription relative">
                        <input type="email" name="EMAIL" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required="">
                        <!-- <div style="position: absolute; left: -5000px;">
								<input type="text" name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="">
							</div> -->
                        <button type="submit" class="newsl-btn">Get Started</button>
                        <div class="info"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Subscription Area ================-->
@endsection
