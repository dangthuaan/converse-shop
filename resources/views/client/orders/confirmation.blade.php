@extends('layouts.shop')

@section('content')
<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">
        @if (session('error'))
        <div class="alert alert-danger" role="alert" style="text-align: center;">
            {{ session('error') }}
        </div>
        @endif

        @if ($productSession)
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
                                <a href="#">{{ $productSession[$id]['name'] }}
                                    <span class="middle">x{{ $productSession[$id]['quantity'] }}</span>
                                    <span class="last currency">{{ $productSession[$id]['price'] * $productSession[$id]['quantity'] }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        <ul class="list list_2">
                            <li>
                                <a href="#">Total
                                    <span class="currency">{{ $orderSession['total_price'] }}</span>(VNĐ)
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12" style="text-align: center;">
                    <a class="main_btn" href="{{  route('client.orders.checkout') }}" style="margin-top: 50px;">Proceed to Checkout</a>
                </div>
            </div>
        </div>
        @else
        @include('client.orders.checkout')
        @endif
    </div>
</section>
<!--================End Checkout Area =================-->
@endsection
