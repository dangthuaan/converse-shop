@extends('layouts.shop')

@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content text-center">
                <h2>Shopping page</h2>
                <div class="page_link">
                    <a href="{{ route('client.index') }}">Home</a>
                    <a href="">Products</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Category Product Area =================-->
<section class="cat_product_area section_gap" style="margin-top: -200px;">
    <div class="container-fluid">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="latest_product_inner row">
                    @foreach ($products as $product)
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="f_p_item">
                            <div class="f_p_img">
                                <img class="img-fluid product-image" src="{{ url($product->first_image) }}" alt="">
                                <div class="p_icon">
                                    <a href="#" class="add-to-cart" data-product-id="{{ $product->id }}">
                                        <i class="lnr lnr-cart"></i>
                                    </a>
                                    @if (in_array($product->id, $favoriteProducts))
                                    <a href="#" class="text-center remove-from-favorite" data-product-id="{{ $product->id }}">
                                        <i class="lnr lnr-heart"></i>
                                    </a>
                                    @else
                                    <a href="#" class="add-to-favorite" data-product-id="{{ $product->id }}">
                                        <i class="lnr lnr-heart"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route('client.products.show', $product->id) }}">
                                <h4>{{ $product->name }}</h4>
                            </a>
                            <h5 class="product-currency">{{ $product->price }}</h5>
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
                        @foreach ($parentCategories as $parentCategory)
                        <div class="widgets_inner">
                            <h4>{{ $parentCategory->name }}</h4>
                            @if ($parentCategory->name == 'Size' || $parentCategory->name == 'Color')
                            <ul class="list">
                                <p class="@if ($parentCategory->name == 'Size') size-desc @elseif ($parentCategory->name == 'Color') color-desc @endif">
                                    @foreach ($parentCategory->children as $childCategory)
                                    <a href="#" class="@if ($parentCategory->name == 'Size')size @elseif ($parentCategory->name == 'Color') color @endif categories" style=" @if ($parentCategory->name == 'Color') background-color:{{$childCategory->name}} @endif">
                                        <span @if ($parentCategory->name == 'Color') class="hide" @endif>{{$childCategory->name}}</span>
                                    </a>
                                    @endforeach
                                </p>
                            </ul>
                            @else
                            <ul class="list list-desc">
                                @foreach ($parentCategory->children as $childCategory)
                                <li>
                                    <a href="#" class="list categories"><span>{{$childCategory->name}}</span></a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                        @endforeach
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Category Product Area =================-->
@endsection
