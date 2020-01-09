@extends('layouts.shop')

@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content text-center">
                <h2>Shop Category Page</h2>
                <div class="page_link">
                    <a href="index.html">Home</a>
                    <a href="category.html">Category</a>
                    <a href="category.html">Women Fashion</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Category Product Area =================-->
<section class="cat_product_area section_gap">
    <div class="container-fluid">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="product_top_bar">
                    {{ $products->links('vendor.pagination.product-top') }}
                </div>
                <div class="latest_product_inner row">
                    @foreach ($products as $product)
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="f_p_item">
                            <div class="f_p_img">
                                <img class="img-fluid" src="{{ url($product->first_image) }}" alt="">
                                <div class="p_icon">
                                    <a href="#" class="add-to-cart" data-product-id="{{ $product->id }}">
                                        <i class="lnr lnr-cart"></i>
                                    </a>
                                    <a href="#">
                                        <i class="add-to-favorite lnr lnr-heart"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="{{ route('client.products.show', $product->id) }}">
                                <h4>{{ $product->name }}</h4>
                            </a>
                            <h5>{{ $product->price }}</h5>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3">
                <div class="left_sidebar_area">
                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Product Filters</h3>
                        </div>
                        <div class="widgets_inner">
                            <h4>Size</h4>
                            <ul class="list">
                                <p class="size-desc">
                                    <a href="#" class="size size-1">xs</a>
                                    <a href="#" class="size size-2">s</a>
                                    <a href="#" class="size size-3">m</a>
                                    <a href="#" class="size size-4">l</a>
                                    <a href="#" class="size size-5">xl</a>
                                    <a href="#" class="size size-6">xxl</a>
                                </p>
                            </ul>
                        </div>
                        <div class="widgets_inner">
                            <h4>Style</h4>
                            <ul class="list list-desc">
                                <li>
                                    <a href="#" class="list">High top</a>
                                </li>
                                <li>
                                    <a href="#" class="list">Mid top</a>
                                </li>
                                <li>
                                    <a href="#" class="list">Low top</a>
                                </li>
                            </ul>
                        </div>
                        <div class="widgets_inner">
                            <h4>Color</h4>
                            <ul class="list">
                                <p class="color-desc">
                                    <a href="#" class="color color-1"></a>
                                    <a href="#" class="color color-2"></a>
                                    <a href="#" class="color color-3"></a>
                                    <a href="#" class="color color-4"></a>
                                </p>
                            </ul>
                        </div>
                        <div class="widgets_inner">
                            <h4>Collection</h4>
                            <ul class="list list-desc">
                                <li>
                                    <a href="#" class="list">Classic Chuck</a>
                                </li>
                                <li>
                                    <a href="#" class="list">Chuck '70</a>
                                </li>
                                <li>
                                    <a href="#" class="list">One Star</a>
                                </li>
                                <li>
                                    <a href="#" class="list">Limited Edition</a>
                                </li>
                            </ul>
                        </div>
                        <div class="widgets_inner">
                            <h4>Material</h4>
                            <ul class="list list-desc">
                                <li>
                                    <a href="#" class="list">Canvas</a>
                                </li>
                                <li>
                                    <a href="#" class="list">Leather</a>
                                </li>
                                <li>
                                    <a href="#" class="list">Cotton</a>
                                </li>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
        {{ $products->links('vendor.pagination.product-bottom') }}
    </div>
</section>
<!--================End Category Product Area =================-->
@endsection
