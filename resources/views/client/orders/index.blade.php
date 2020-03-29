@extends('layouts.shop')

@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content">
                <h2>
                    Shopping Cart
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
@if (!empty($product_session))
<section class="cart_area" style="margin-top: -100px">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">
                                {{ __('Product') }}
                            </th>
                            <th scope="col" style="width: 150px;">
                                Price (VNĐ)
                            </th>
                            <th scope="col" style="width: 150px;">
                                Quantity
                            </th>
                            <th scope="col" style="width: 150px;">
                                Total (VNĐ)
                            </th>
                            <th scope="col">
                                Remove
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product_session as $id => $product)
                        @if (isset($productImage[$id]))
                        <tr class="product-{{ $id }}">
                            <td>
                                <div class="d-flex">
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <img alt="" class="img-fluid" src="{{ url( $productImage[$id]) }}">
                                        </img>
                                    </div>
                                    <div class="media">
                                        <div class="media-body">
                                            <a href="{{ route('client.products.show', $id) }}" style="color: #222222;">
                                                <h4>
                                                    {{ $product_session[$id]['name'] }}
                                                </h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>
                                    @if ($product_session[$id]['sale'] != 0)
                                    <strike class="currency">
                                        {{ $product_session[$id]['price'] }}
                                    </strike> | -{{$product_session[$id]['sale']}}%
                                    <span class="currency" style="color:red">{{ $product_session[$id]['price'] - $product_session[$id]['price'] * ($product_session[$id]['sale'] / 100) }}</span>
                                    @else
                                    <span class="currency">{{ $product_session[$id]['price'] }}</span>
                                    @endif
                                </h5>
                            </td>
                            <td>
                                <div class="product_count">
                                    <input class="input-text qty" id="sst" maxlength="12" name="qty" title="Quantity:" type="text" value="{{ $product_session[$id]['quantity'] }}">
                                    <button class="increase items-count" type="button" data-product-id="{{ $id }}">
                                        <i class="lnr lnr-chevron-up">
                                        </i>
                                    </button>
                                    <button class="reduced items-count" type="button" data-product-id="{{ $id }}">
                                        <i class="lnr lnr-chevron-down">
                                        </i>
                                    </button>
                                    </input>
                                </div>
                            </td>
                            <td>
                                <h5 class="currency">
                                    {{ ($product_session[$id]['price'] - $product_session[$id]['price'] * $product_session[$id]['sale']/ 100) * $product_session[$id]['quantity']  }}
                                </h5>
                            </td>
                            <td>
                                <div class="product_remove">
                                    <button data-product-id="{{ $id }}" class="product-remove" type="button">
                                        <i class="lnr lnr-cross">
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        <tr>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                                <h3>
                                    Total
                                </h3>
                            </td>
                            <td style="width: 130px;">
                                <h5 class="product-currency">
                                    ${{ $order_session['total_price'] }}
                            </td>
                        </tr>
                        <tr class="out_button_area">
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                                <div class="checkout_btn_inner">
                                    <a class="main_btn" href="{{ route('client.products.index') }}">
                                        Continue Shopping
                                    </a>
                                    <a class="main_btn" href="{{ route('client.orders.confirmation') }}">
                                        Proceed to checkout
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@else
<section class="order_details" style="margin-top: -50px">
    <div class="container">
        <h3 class="title_confirmation">
            Sorry. You have no order yet.
        </h3>
        <div class="confirmation_btn_inner">
            <a class="main_btn" href="{{ asset('/products') }}">Continue Shopping</a>
        </div>
    </div>
</section>
@endif
<!--================End Cart Area =================-->
@endsection
