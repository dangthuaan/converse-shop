@extends('layouts.shop')

@section('content')
<!--================Order Details Area =================-->
<section class="order_details p_120 margin_top">
    <div class="container">
        <h3 class="title_confirmation">
            @if (session('order_session'))
            Thank you. Your order has been received.
            @else
            Sorry. You have no order yet.
            @endif
        </h3>
        <div class="confirmation_btn_inner">
            <a class="main_btn" href="{{ asset('/products') }}">Continue Shopping</a>
        </div>
    </div>
</section>
<!--================End Order Details Area =================-->
@endsection
