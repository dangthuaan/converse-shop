@extends('layouts.shop')

@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content text-center">
                <h2>Shop Product Page</h2>
                <div class="page_link">
                    <a href="{{ route('client.index') }}">Home</a>
                    <a href="{{ route('client.products.index') }}">Product</a>
                    <a href="">{{ $product->name }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Single Product Area =================-->
<div class="product_image_area" style="margin-top: -50px;">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <div class="s_product_img">
                    <div class="carousel slide" data-ride="carousel" id="carouselExampleIndicators">
                        <ol class="carousel-indicators">
                            <li class="active" data-slide-to="0" data-target="#carouselExampleIndicators">
                                <img alt="" src="{{ url($images[0]) }}" style="width: 60px; height: 60px;">
                                </img>
                            </li>
                            <li data-slide-to="1" data-target="#carouselExampleIndicators">
                                <img alt="" src="{{ url($images[1]) }}" style="width: 60px; height: 60px;">
                                </img>
                            </li>
                            <li data-slide-to="2" data-target="#carouselExampleIndicators">
                                <img alt="" src="{{ url($images[2]) }}" style="width: 60px; height: 60px;">
                                </img>
                            </li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img alt="First slide" class="d-block w-100" src="{{ url($images[0]) }}" style="width: 555px; height: 500px;">
                                </img>
                            </div>
                            <div class="carousel-item">
                                <img alt="Second slide" class="d-block w-100" src="{{ url($images[1]) }}" style="width: 555px; height: 500px;">
                                </img>
                            </div>
                            <div class="carousel-item">
                                <img alt="Third slide" class="d-block w-100" src="{{ url($images[2]) }}" style="width: 555px; height: 500px;">
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
                    <h2 class="product-currency">
                        {{ $product->price }}
                    </h2>
                    <p>
                        {{ $product->description }}
                    </p>
                    <div class="product_count spinner">
                        <label for="qty">
                            Quantity:
                        </label>
                        <input class="input-text qty" id="sst" maxlength="12" name="qty" type="text" value="{{ $product_session ? $product_session[$product->id]['quantity'] : 1 }}">
                        <button class="up items-count" type="button">
                            <i class="lnr lnr-chevron-up">
                            </i>
                        </button>
                        <button class="down items-count" type="button">
                            <i class="lnr lnr-chevron-down">
                            </i>
                        </button>
                        </input>
                    </div>
                    <div class="card_area">
                        <a class="main_btn add-to-cart-single" data-product-id="{{ $product->id }}">
                            Add to Cart
                        </a>
                        @if (in_array($product->id, $favoriteProducts))
                        <a href="#" class="icon_btn remove-from-favorite" data-product-id="{{ $product->id }}">
                            <i class="lnr lnr-heart"></i>
                        </a>
                        @else
                        <a href="#" class="icon_btn add-to-favorite" data-product-id="{{ $product->id }}">
                            <i class="lnr lnr-heart"></i>
                        </a>
                        @endif
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
                <a aria-controls="profile" aria-selected="false" class="nav-link active" data-toggle="tab" href="#profile" id="profile-tab" role="tab">
                    Specification
                </a>
            </li>
            <li class="nav-item">
                <a aria-controls="contact" aria-selected="false" class="nav-link" data-toggle="tab" href="#contact" id="contact-tab" role="tab">
                    Comments
                </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div aria-labelledby="profile-tab" class="tab-pane fade show active" id="profile" role="tabpanel">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            @foreach ($product->categories as $category)
                            <tr>
                                <td>
                                    <h5>
                                        {{ $parentCategory[$category->id] }}
                                    </h5>
                                </td>
                                <td>
                                    <h5>
                                        {{ $category->name ?? '' }}
                                    </h5>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <div class="col-lg-12" id="comment">
                        <div class="fb-comments" data-order-by="reverse_time" data-href="{{ asset('/comments#configurator') }}" data-width="1078" data-numposts="5"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--================End Product Description Area =================-->
@endsection
