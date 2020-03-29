@extends('layouts.shop')

@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content">
                <h2>
                    Shopping Complete
                </h2>
                <div class="page_link">
                    <a href="{{ route('client.index') }}">
                        Home
                    </a>
                    <a href="{{ route('client.orders.index') }}">
                        Cart
                    </a>
                    <a href="">
                        Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Order Details Area =================-->
<section class="order_details" style="margin-top: -50px;">
    <div class="container">
        <h3 class="title_confirmation">
            Thank you. Your order has been received.
        </h3>
        <div class="confirmation_btn_inner">
            <a class="main_btn" href="{{ asset('/products') }}">Continue Shopping</a>
        </div>
    </div>
</section>
<!--================End Order Details Area =================-->
@endsection
