@extends('layouts.shop')

@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content">
                <h2>
                    My Favorite products
                </h2>
                <div class="page_link">
                    <a href="{{ route('client.index') }}">
                        Home
                    </a>
                    <a href="">
                        Cart
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->
<!--================Cart Area =================-->
@if ($favoriteProducts->count() > 0)
<section class="cart_area" style="margin-top: -50px;">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">
                                {{ __('Product') }}
                            </th>
                            <th scope="col" style="width: 200px;">
                                Price (VNĐ)
                            </th>
                            <th scope="col">
                                Remove
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($favoriteProducts as $favoriteProduct)
                        <tr>
                            <td>
                                <div class="d-flex">
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <img alt="" class="img-fluid" src="{{ url($productImage[$favoriteProduct->id]) }}">
                                        </img>
                                    </div>
                                    <div class="media">
                                        <div class="media-body">
                                            <p>
                                                {{ $favoriteProduct->name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>
                                    @if ($favoriteProduct->sale != 0)
                                    <strike class="currency">
                                        {{ $favoriteProduct->price }}
                                    </strike> | - {{$favoriteProduct->sale}}%
                                    <span class="currency" style="color:red">{{ $favoriteProduct->price - $favoriteProduct->price * ($favoriteProduct->sale / 100) }}</span>
                                    @else
                                    <span class="currency">{{ $favoriteProduct->price }}</span>
                                    @endif
                                </h5>
                            </td>
                            <td>
                                <div class="product_remove">
                                    <button class="remove-from-favorite" data-product-id="{{ $favoriteProduct->id }}" type="button">
                                        <i class="lnr lnr-cross">
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@else
<section class="order_details" style="margin-top: -50px">
    <div class="container">
        <h3 class="title_confirmation" style="color: red">
            Favorite list is empty.
        </h3>
        <div class="confirmation_btn_inner">
            <a class="main_btn" href="{{ asset('/products') }}">Continue Shopping</a>
        </div>
    </div>
</section>
@endif
<!--================End Cart Area =================-->
@endsection
