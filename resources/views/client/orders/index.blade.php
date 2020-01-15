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
                    <a href="index.html">
                        Home
                    </a>
                    <a href="cart.html">
                        Cart
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->
<!--================Cart Area =================-->
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">
                                {{ __('Product') }}
                            </th>
                            <th scope="col">
                                Price
                            </th>
                            <th scope="col">
                                Quantity
                            </th>
                            <th scope="col">
                                Total
                            </th>
                            <th scope="col">
                                Remove
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($product_data)
                        @foreach ($product_data as $id => $product)
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
                                            <p>
                                                {{ $product_data[$id]['name'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>
                                    {{ $product_data[$id]['price'] }}
                                </h5>
                            </td>
                            <td>
                                <div class="product_count">
                                    <input class="input-text qty" id="sst" maxlength="12" name="qty" title="Quantity:" type="text" value="{{ $product_data[$id]['quantity'] }}">
                                    <button class="increase items-count" onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" type="button">
                                        <i data-product-id="{{ $id }}" class="lnr lnr-chevron-up">
                                        </i>
                                    </button>
                                    <button class="reduced items-count" onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) && sst > 1 ) result.value--;return false;" type="button">
                                        <i data-product-id="{{ $id }}" class="lnr lnr-chevron-down">
                                        </i>
                                    </button>
                                    </input>
                                </div>
                            </td>
                            <td>
                                <h5>
                                    {{ $product_data[$id]['price'] * $product_data[$id]['quantity']  }}
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
                        @endif
                        <tr class="bottom_button">
                            <td>
                                <a class="gray_btn" href="#">
                                    Update Cart
                                </a>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                                <div class="cupon_text">
                                    <input placeholder="Coupon Code" type="text">
                                    <a class="main_btn" href="#">
                                        Apply
                                    </a>
                                    <a class="gray_btn" href="#">
                                        Close Coupon
                                    </a>
                                    </input>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                                <h5>
                                    Subtotal
                                </h5>
                            </td>
                            <td>
                                <h5>
                                    ${{ $order_data['total_price'] }}
                                </h5>
                            </td>
                        </tr>
                        <tr class="shipping_area">
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                                <h5>
                                    Shipping
                                </h5>
                            </td>
                            <td>
                                <div class="shipping_box">
                                    <ul class="list">
                                        <li>
                                            <a href="#">
                                                Flat Rate: $5.00
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Free Shipping
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Flat Rate: $10.00
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a href="#">
                                                Local Delivery: $2.00
                                            </a>
                                        </li>
                                    </ul>
                                    <h6>
                                        Calculate Shipping
                                        <i aria-hidden="true" class="fa fa-caret-down">
                                        </i>
                                    </h6>
                                    <select class="shipping_select">
                                        <option value="1">
                                            Bangladesh
                                        </option>
                                        <option value="2">
                                            India
                                        </option>
                                        <option value="4">
                                            Pakistan
                                        </option>
                                    </select>
                                    <select class="shipping_select">
                                        <option value="1">
                                            Select a State
                                        </option>
                                        <option value="2">
                                            Select a State
                                        </option>
                                        <option value="4">
                                            Select a State
                                        </option>
                                    </select>
                                    <input placeholder="Postcode/Zipcode" type="text">
                                    <a class="gray_btn" href="#">
                                        Update Details
                                    </a>
                                    </input>
                                </div>
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
                                    <a class="gray_btn" href="#">
                                        Continue Shopping
                                    </a>
                                    <a class="main_btn" href="{{ route('client.orders.checkout') }}">
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
<!--================End Cart Area =================-->
@endsection
