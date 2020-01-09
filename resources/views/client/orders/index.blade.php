@extends('layouts.shop')

@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content text-center">
                <h2>Shopping Cart</h2>
                <div class="page_link">
                    <a href="index.html">Home</a>
                    <a href="cart.html">Cart</a>
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
                                Product
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
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        <img alt="" src="img/product/single-product/cart-1.jpg">
                                        </img>
                                    </div>
                                    <div class="media-body">
                                        <p>
                                            Minimalistic shop for multipurpose use
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>
                                    $360.00
                                </h5>
                            </td>
                            <td>
                                <div class="product_count">
                                    <input class="input-text qty" id="sst" maxlength="12" name="qty" title="Quantity:" type="text" value="1">
                                        <button class="increase items-count" onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" type="button">
                                            <i class="lnr lnr-chevron-up">
                                            </i>
                                        </button>
                                        <button class="reduced items-count" onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) && sst > 1 ) result.value--;return false;" type="button">
                                            <i class="lnr lnr-chevron-down">
                                            </i>
                                        </button>
                                    </input>
                                </div>
                            </td>
                            <td>
                                <h5>
                                    $720.00
                                </h5>
                            </td>
                            <td>
                                <div class="product_remove">
                                    <button class="remove" type="button">
                                        <i class="lnr lnr-cross">
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        <img alt="" src="img/product/single-product/cart-1.jpg">
                                        </img>
                                    </div>
                                    <div class="media-body">
                                        <p>
                                            Minimalistic shop for multipurpose use
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>
                                    $360.00
                                </h5>
                            </td>
                            <td>
                                <div class="product_count">
                                    <input class="input-text qty" id="sst" maxlength="12" name="qty" title="Quantity:" type="text" value="1">
                                        <button class="increase items-count" onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" type="button">
                                            <i class="lnr lnr-chevron-up">
                                            </i>
                                        </button>
                                        <button class="reduced items-count" onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) && sst > 0 ) result.value--;return false;" type="button">
                                            <i class="lnr lnr-chevron-down">
                                            </i>
                                        </button>
                                    </input>
                                </div>
                            </td>
                            <td>
                                <h5>
                                    $720.00
                                </h5>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        <img alt="" src="img/product/single-product/cart-1.jpg">
                                        </img>
                                    </div>
                                    <div class="media-body">
                                        <p>
                                            Minimalistic shop for multipurpose use
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>
                                    $360.00
                                </h5>
                            </td>
                            <td>
                                <div class="product_count">
                                    <input class="input-text qty" id="sst" maxlength="12" name="qty" title="Quantity:" type="text" value="1">
                                        <button class="increase items-count" onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" type="button">
                                            <i class="lnr lnr-chevron-up">
                                            </i>
                                        </button>
                                        <button class="reduced items-count" onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) && sst > 0 ) result.value--;return false;" type="button">
                                            <i class="lnr lnr-chevron-down">
                                            </i>
                                        </button>
                                    </input>
                                </div>
                            </td>
                            <td>
                                <h5>
                                    $720.00
                                </h5>
                            </td>
                        </tr>
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
                                    $2160.00
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
                                    <a class="main_btn" href="#">
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
