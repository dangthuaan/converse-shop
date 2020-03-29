@extends('admin.dashboard')

@section('content')
@if (session('error'))
<div class="alert alert-danger" role="alert" style="text-align: center;">
    {{ session('error') }}
</div>
@endif
@if (session('success'))
<div class="alert alert-success" role="alert" style="text-align: center;">
    {{ session('success') }}
</div>
@endif

<h1>Order List</h1>
<hr>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#new" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-cart-plus" style="color: blue;"></i> New</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#in-progress" role="tab" aria-controls="contact" aria-selected="false"><i style="color: orange;" class="fas fa-sync-alt"></i> In Progress</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#delivered" role="tab" aria-controls="contact" aria-selected="false"><i style="color: green;" class="fas fa-clipboard-check"></i> Delivered</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#closed" role="tab" aria-controls="contact" aria-selected="false"><i style="color: red;" class="fas fa-times-circle"></i> Closed</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <!-- New Order -->
    <div class="tab-pane show active" id="new" role="new" aria-labelledby="profile-tab">
        <table class="order-table table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Checkout Date</th>
                    <th>Ordered By (Customer)</th>
                    <th>Customer's email</th>
                    <th>Total Price</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($newOrders as $key => $order)
                <tr v-pre>
                    <td>{{ $newOrders->firstItem() + $key }}</td>
                    <td>{{$order->created_at->toDateString()}}</td>
                    <td>{{$order->user ? $order->user->name : ''}}</td>
                    <td>{{$order->user ? $order->user->email : ''}}</td>
                    <td class="product-currency">{{$order->total_price}}</td>
                    <td><button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#orderDetail{{ $order->id }}" data-order-id="{{ $order->id }}">Detail</button>
                        <!-- Modal -->
                        <div class="modal fade" id="orderDetail{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="orderDetailLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orderDetailLabel">Order Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product Name</th>
                                                    <th>Gender</th>
                                                    <th>Publish date</th>
                                                    <th>Price(VNĐ)</th>
                                                    <th>Sale(%)</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->products as $orderProduct)
                                                <tr v-pre>
                                                    <td class="counterCell"></td>
                                                    <td><a href="{{ route('client.products.show', $orderProduct->id) }}">{{ $orderProduct->name }}</a></td>
                                                    <td> {{ $orderProduct->gender }} </td>
                                                    <td> {{ $orderProduct->publish_date }} </td>
                                                    <td class="product-currency">{{ $orderProduct->price }}</td>
                                                    <td>{{ $orderProduct->sale }}%</td>
                                                    <td>{{ $orderProduct->pivot->quantity }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <table id="example" class="model-table table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Delivery Address</th>
                                                    <td>{{ $order->address }}</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-pre>
                                                    <th>Customer's phone number</th>
                                                    <td>{{ $order->phone_number }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group row">
                            <form action="{{ route('admin.orders.deliver', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-6">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            {{ __('Delivery') }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <form action="{{ route('admin.orders.confirmClose', $order->id) }}" method="GET">
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-10">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            {{ __('Close') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Checkout Date</th>
                    <th>Ordered By</th>
                    <th>Customer's email</th>
                    <th>Total Price</th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- In Progress Order -->
    <div class="tab-pane fade" id="in-progress" role="in-progress" aria-labelledby="contact-tab">
        <table class="order-table-extend table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ordered By (Customer)</th>
                    <th>Customer's email</th>
                    <th>Total Price</th>
                    <th>Deliver Date</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inProgressOrders as $key => $order)
                <tr v-pre>
                    <td>{{ $inProgressOrders->firstItem() + $key }}</td>
                    <td>{{$order->user ? $order->user->name : ''}}</td>
                    <td>{{$order->user ? $order->user->email : ''}}</td>
                    <td class="product-currency">{{$order->total_price}}</td>
                    <td>{{$order->updated_at->toDateString()}}</td>
                    <td><button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#orderDetail{{ $order->id }}" data-order-id="{{ $order->id }}">Detail</button>
                        <!-- Modal -->
                        <div class="modal fade" id="orderDetail{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="orderDetailLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orderDetailLabel">Order Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product Name</th>
                                                    <th>Gender</th>
                                                    <th>Publish date</th>
                                                    <th>Price(VNĐ)</th>
                                                    <th>Sale(%)</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->products as $orderProduct)
                                                <tr v-pre>
                                                    <td class="counterCell"></td>
                                                    <td><a href="{{ route('client.products.show', $orderProduct->id) }}">{{ $orderProduct->name }}</a></td>
                                                    <td> {{ $orderProduct->gender }} </td>
                                                    <td> {{ $orderProduct->publish_date }} </td>
                                                    <td class="product-currency">{{ $orderProduct->price }}</td>
                                                    <td>{{ $orderProduct->sale }}%</td>
                                                    <td>{{ $orderProduct->pivot->quantity }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <table id="example" class="model-table table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Delivery Address</th>
                                                    <td>{{ $order->address }}</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-pre>
                                                    <th>Customer's phone number</th>
                                                    <td>{{ $order->phone_number }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row" style="margin-left: 20px;">
                            <form action="{{ route('admin.orders.confirmDeliver', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-success">
                                    {{ __('Delivered') }}
                                </button>
                            </form>

                            <form action="{{ route('admin.orders.confirmClose', $order->id) }}" method="GET" style="margin-left: 20px;">
                                <button type="submit" class="btn btn-sm btn-danger">
                                    {{ __('Close') }}
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Ordered By</th>
                    <th>Customer's email</th>
                    <th>Total Price</th>
                    <th>Deliver Date</th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Delivered Orders -->
    <div class="tab-pane fade" id="delivered" role="delivered" aria-labelledby="contact-tab">
        <table class="order-table-extend table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ordered By (Customer)</th>
                    <th>Customer's email</th>
                    <th>Total Price</th>
                    <th>Ordered Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deliveredOrders as $key => $order)
                <tr v-pre>
                    <td>{{ $deliveredOrders->firstItem() + $key }}</td>
                    <td>{{$order->user ? $order->user->name : ''}}</td>
                    <td>{{$order->user ? $order->user->email : ''}}</td>
                    <td class="product-currency">{{$order->total_price}}</td>
                    <td>{{$order->updated_at->toDateString()}}</td>
                    <td><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#orderDetail{{ $order->id }}" data-order-id="{{ $order->id }}">Detail</button>
                        <!-- Modal -->
                        <div class="modal fade" id="orderDetail{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="orderDetailLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orderDetailLabel">Order Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product Name</th>
                                                    <th>Gender</th>
                                                    <th>Publish date</th>
                                                    <th>Price(VNĐ)</th>
                                                    <th>Sale(%)</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->products as $orderProduct)
                                                <tr v-pre>
                                                    <td class="counterCell"></td>
                                                    <td><a href="{{ route('client.products.show', $orderProduct->id) }}">{{ $orderProduct->name }}</a></td>
                                                    <td> {{ $orderProduct->gender }} </td>
                                                    <td> {{ $orderProduct->publish_date }} </td>
                                                    <td class="product-currency">{{ $orderProduct->price }}</td>
                                                    <td>{{ $orderProduct->sale }}%</td>
                                                    <td>{{ $orderProduct->pivot->quantity }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <table id="example" class="model-table table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Delivery Address</th>
                                                    <td>{{ $order->address }}</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-pre>
                                                    <th>Customer's phone number</th>
                                                    <td>{{ $order->phone_number }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Ordered By</th>
                    <th>Customer's email</th>
                    <th>Total Price</th>
                    <th>Ordered Date</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="tab-pane fade" id="closed" role="closed" aria-labelledby="contact-tab">
        <table class="order-table-extend table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ordered By (Customer)</th>
                    <th>Customer's email</th>
                    <th>Total Price</th>
                    <th>Closed Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($closedOrders as $key => $order)
                <tr v-pre>
                    <td>{{ $closedOrders->firstItem() + $key }}</td>
                    <td>{{$order->user ? $order->user->name : ''}}</td>
                    <td>{{$order->user ? $order->user->email : ''}}</td>
                    <td class="product-currency">{{$order->total_price}}</td>
                    <td>{{$order->updated_at->toDateString()}}</td>
                    <td><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#orderDetail{{ $order->id }}" data-order-id="{{ $order->id }}">Detail</button>
                        <!-- Modal -->
                        <div class="modal fade" id="orderDetail{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="orderDetailLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orderDetailLabel">Order Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product Name</th>
                                                    <th>Gender</th>
                                                    <th>Publish date</th>
                                                    <th>Price(VNĐ)</th>
                                                    <th>Sale(%)</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->products as $orderProduct)
                                                <tr v-pre>
                                                    <td class="counterCell"></td>
                                                    <td><a href="{{ route('client.products.show', $orderProduct->id) }}">{{ $orderProduct->name }}</a></td>
                                                    <td> {{ $orderProduct->gender }} </td>
                                                    <td> {{ $orderProduct->publish_date }} </td>
                                                    <td class="product-currency">{{ $orderProduct->price }}</td>
                                                    <td>{{ $orderProduct->sale }}%</td>
                                                    <td>{{ $orderProduct->pivot->quantity }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <table id="example" class="model-table table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Delivery Address</th>
                                                    <td>{{ $order->address }}</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-pre>
                                                    <th>Customer's phone number</th>
                                                    <td>{{ $order->phone_number }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Ordered By</th>
                    <th>Customer's email</th>
                    <th>Total Price</th>
                    <th>Closed Date</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    @endsection
