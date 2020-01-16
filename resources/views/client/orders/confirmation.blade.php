@extends('layouts.shop')

@section('content')
<!--================Order Details Area =================-->
<section class="order_details p_120">
    <div class="container">
        <h3 class="title_confirmation">Thank you. Your order has been received.</h3>
        <div class="confirmation_btn_inner">
            <a class="main_btn" href="#">Continue Shopping</a>
        </div>
        <div class="order_details_table">
            <h2>Order Details</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($order)
                        @foreach ($order->products as $orderProduct)
                        <tr>
                            <td>
                                <p>{{ $orderProduct->name }}</p>
                            </td>
                            <td>
                                <h5>{{ $orderProduct->pivot->quantity }}</h5>
                            </td>
                            <td>
                                <p>{{ $orderProduct->price }}</p>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td>
                                <h4>Total</h4>
                            </td>
                            <td>
                                <h5></h5>
                            </td>
                            <td>
                                <p>{{ $order->total_price }}</p>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--================End Order Details Area =================-->
@endsection
