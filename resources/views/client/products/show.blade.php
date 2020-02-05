@extends('layouts.shop')

@section('content')
<!--================Single Product Area =================-->
<div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <div class="s_product_img">
                    <div class="carousel slide" data-ride="carousel" id="carouselExampleIndicators">
                        <ol class="carousel-indicators">
                            <li class="active" data-slide-to="0" data-target="#carouselExampleIndicators">
                                <img alt="" src="img/product/single-product/s-product-s-2.jpg">
                                </img>
                            </li>
                            <li data-slide-to="1" data-target="#carouselExampleIndicators">
                                <img alt="" src="img/product/single-product/s-product-s-3.jpg">
                                </img>
                            </li>
                            <li data-slide-to="2" data-target="#carouselExampleIndicators">
                                <img alt="" src="img/product/single-product/s-product-s-4.jpg">
                                </img>
                            </li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img alt="First slide" class="d-block w-100" src="img/product/single-product/s-product-1.jpg">
                                </img>
                            </div>
                            <div class="carousel-item">
                                <img alt="Second slide" class="d-block w-100" src="img/product/single-product/s-product-1.jpg">
                                </img>
                            </div>
                            <div class="carousel-item">
                                <img alt="Third slide" class="d-block w-100" src="img/product/single-product/s-product-1.jpg">
                                </img>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <h3>
                        {{ $product->name }}
                    </h3>
                    <h2>
                        {{ $product->price }}
                    </h2>
                    <ul class="list">
                        <li>
                            <a class="active" href="#">
                                <span>
                                    Category
                                </span>
                                : Household
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span>
                                    Availibility
                                </span>
                                : In Stock
                            </a>
                        </li>
                    </ul>
                    <p>
                        Mill Oil is an innovative oil filled radiator with the most modern technology. If you are looking for something that
                        can make your interior look awesome, and at the same time give you the pleasant warm feeling during the winter.
                    </p>
                    <div class="product_count">
                        <label for="qty">
                            Quantity:
                        </label>
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
                    <div class="card_area">
                        <a class="main_btn" href="#">
                            Add to Cart
                        </a>
                        <a class="icon_btn" href="#">
                            <i class="lnr lnr lnr-diamond">
                            </i>
                        </a>
                        <a class="icon_btn" href="#">
                            <i class="lnr lnr lnr-heart">
                            </i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================End Single Product Area =================-->
<!--================Product Description Area =================-->
<section class="product_description_area">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a aria-controls="home" aria-selected="true" class="nav-link" data-toggle="tab" href="#home" id="home-tab" role="tab">
                    Description
                </a>
            </li>
            <li class="nav-item">
                <a aria-controls="profile" aria-selected="false" class="nav-link" data-toggle="tab" href="#profile" id="profile-tab" role="tab">
                    Specification
                </a>
            </li>
            <li class="nav-item">
                <a aria-controls="contact" aria-selected="false" class="nav-link" data-toggle="tab" href="#contact" id="contact-tab" role="tab">
                    Comments
                </a>
            </li>
            <li class="nav-item">
                <a aria-controls="review" aria-selected="false" class="nav-link active" data-toggle="tab" href="#review" id="review-tab" role="tab">
                    Reviews
                </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div aria-labelledby="home-tab" class="tab-pane fade" id="home" role="tabpanel">
                <p>{{ $product->description }}</p>
            </div>
            <div aria-labelledby="profile-tab" class="tab-pane fade" id="profile" role="tabpanel">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <h5>
                                        Width
                                    </h5>
                                </td>
                                <td>
                                    <h5>
                                        128mm
                                    </h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>
                                        Height
                                    </h5>
                                </td>
                                <td>
                                    <h5>
                                        508mm
                                    </h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>
                                        Depth
                                    </h5>
                                </td>
                                <td>
                                    <h5>
                                        85mm
                                    </h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>
                                        Weight
                                    </h5>
                                </td>
                                <td>
                                    <h5>
                                        52gm
                                    </h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>
                                        Quality checking
                                    </h5>
                                </td>
                                <td>
                                    <h5>
                                        yes
                                    </h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>
                                        Freshness Duration
                                    </h5>
                                </td>
                                <td>
                                    <h5>
                                        03days
                                    </h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>
                                        When packeting
                                    </h5>
                                </td>
                                <td>
                                    <h5>
                                        Without touch of hand
                                    </h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>
                                        Each Box contains
                                    </h5>
                                </td>
                                <td>
                                    <h5>
                                        60pcs
                                    </h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <div class="col-lg-12" id="comment">
                        @include('client.products.comments.comment', ['comments' => $product->comments, 'product_id' => $product->id])
                    </div>
                    <div class="col-lg-12 margin_top">
                        <div class="review_box">
                            <h4>
                                Post a comment
                            </h4>
                            <form class="row contact_form" id="comment_form">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control @error('message') is-invalid @enderror content" name="content" placeholder="Message" rows="1" required></textarea>
                                    </div>
                                    @error('content')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 text-right">
                                    <button data-product-id="{{ $product->id }}" class="submit_comment btn submit_btn" type="submit">
                                        Submit Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div aria-labelledby="review-tab" class="tab-pane fade show active" id="review" role="tabpanel">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row total_rate">
                            <div class="col-6">
                                <div class="box_total">
                                    <h5>
                                        Overall
                                    </h5>
                                    <h4>
                                        4.0
                                    </h4>
                                    <h6>
                                        (03 Reviews)
                                    </h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="rating_list">
                                    <h3>
                                        Based on 3 Reviews
                                    </h3>
                                    <ul class="list">
                                        <li>
                                            <a href="#">
                                                5 Star
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                01
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                4 Star
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                01
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                3 Star
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                01
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                2 Star
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                01
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                1 Star
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                <i class="fa fa-star">
                                                </i>
                                                01
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="review_list">
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex">
                                        <img alt="" src="img/product/single-product/review-1.png">
                                        </img>
                                    </div>
                                    <div class="media-body">
                                        <h4>
                                            Blake Ruiz
                                        </h4>
                                        <i class="fa fa-star">
                                        </i>
                                        <i class="fa fa-star">
                                        </i>
                                        <i class="fa fa-star">
                                        </i>
                                        <i class="fa fa-star">
                                        </i>
                                        <i class="fa fa-star">
                                        </i>
                                    </div>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                </p>
                            </div>
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex">
                                        <img alt="" src="img/product/single-product/review-2.png">
                                        </img>
                                    </div>
                                    <div class="media-body">
                                        <h4>
                                            Blake Ruiz
                                        </h4>
                                        <i class="fa fa-star">
                                        </i>
                                        <i class="fa fa-star">
                                        </i>
                                        <i class="fa fa-star">
                                        </i>
                                        <i class="fa fa-star">
                                        </i>
                                        <i class="fa fa-star">
                                        </i>
                                    </div>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                </p>
                            </div>
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex">
                                        <img alt="" src="img/product/single-product/review-3.png">
                                        </img>
                                    </div>
                                    <div class="media-body">
                                        <h4>
                                            Blake Ruiz
                                        </h4>
                                        <i class="fa fa-star">
                                        </i>
                                        <i class="fa fa-star">
                                        </i>
                                        <i class="fa fa-star">
                                        </i>
                                        <i class="fa fa-star">
                                        </i>
                                        <i class="fa fa-star">
                                        </i>
                                    </div>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>
                                Add a Review
                            </h4>
                            <p>
                                Your Rating:
                            </p>
                            <ul class="list">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-star">
                                        </i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-star">
                                        </i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-star">
                                        </i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-star">
                                        </i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-star">
                                        </i>
                                    </a>
                                </li>
                            </ul>
                            <p>
                                Outstanding
                            </p>
                            <form action="contact_process.php" class="row contact_form" id="contactForm" method="post" novalidate="novalidate">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" id="name" name="name" placeholder="Your Full name" type="text">
                                        </input>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" id="email" name="email" placeholder="Email Address" type="email">
                                        </input>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" id="number" name="number" placeholder="Phone Number" type="text">
                                        </input>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" id="message" name="message" placeholder="Review" rows="1">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button class="btn submit_btn" type="submit" value="submit">
                                        Submit Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--================End Product Description Area =================-->
@endsection
