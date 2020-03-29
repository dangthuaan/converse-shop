@extends('layouts.shop')

@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content">
                <h2>
                    Shopping Confirmation
                </h2>
                <div class="page_link">
                    <a href="{{ route('client.index') }}">
                        Home
                    </a>
                    <a href="{{ route('client.orders.index') }}">
                        Cart
                    </a>
                    <a href="">
                        Confirmation
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Checkout Area =================-->
<section class="checkout_area section_gap" style="margin-top: -250px;">
    <div class="container">
        @if (session('error'))
        <div class="alert alert-danger" role="alert" style="text-align: center;">
            {{ session('error') }}
        </div>
        @endif

        @if (isset($productSession))
        <form method="GET" action="{{ route('client.orders.checkout') }}">
            <div class="billing_details margin_top">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li>
                                    <a href="#">Product
                                        <span>Product total</span>
                                    </a>
                                </li>
                                @foreach ($productSession as $id => $product)
                                <li>
                                    <a href="{{ route('client.products.show', $id)}}">{{ $productSession[$id]['name'] }}
                                        <span class="middle">x{{ $productSession[$id]['quantity'] }}</span>
                                        <span class="last product-currency">{{ ($productSession[$id]['price'] - $productSession[$id]['price'] * $productSession[$id]['sale'] / 100) * $productSession[$id]['quantity'] }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            <ul class="list list_2">
                                <li>
                                    <a href="#">Total
                                        <span class="product-currency">{{ $orderSession['total_price'] }}</span>(VNĐ)
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <label class="col-md-4 col-form-label" for="category" style="margin-top: 50px">
                        <h2>Your Address<strong class="required-field">*</strong></h2>
                    </label>
                    <div class="col-md-12 form-group">
                        <input id="address" type="text" autocomplete="address" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Your address">

                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <label class="col-md-4 col-form-label" for="category" style="margin-top: 50px">
                        <h2>Your Phone Number<strong class="required-field">*</strong></h2>
                    </label>
                    <div class="col-md-12 form-group">
                        <input id="phone_number" type="tel" autocomplete="phone_number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" placeholder="Your phone number">

                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-12" style="text-align: center;">
                        <button class="main_btn" style="margin-top: 50px;">Proceed to Checkout</button>
                    </div>
                </div>
            </div>
        </form>
        @else
        @include('client.orders.checkout')
        @endif
    </div>
</section>
<!--================End Checkout Area =================-->
@endsection
