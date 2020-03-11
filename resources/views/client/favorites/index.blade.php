@extends('layouts.shop')

@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content">
                <h2>
                    My Favorites
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
                                Remove
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($favoriteProducts)
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
                                    <strike>
                                        {{ $favoriteProduct->price }}
                                    </strike> | - {{$favoriteProduct->sale}}% {{ $favoriteProduct->price - $favoriteProduct->price * ($favoriteProduct->sale / 100) }}
                                    @else
                                    {{ $favoriteProduct->price }}
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
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->
@endsection
