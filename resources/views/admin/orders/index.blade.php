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
        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#in-progress" role="tab" aria-controls="profile" aria-selected="false">In Progress</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#delivered" role="tab" aria-controls="contact" aria-selected="false">Delivered</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#closed" role="tab" aria-controls="contact" aria-selected="false">Closed</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <!-- In Progress Order -->
    <div class="tab-pane show active" id="in-progress" role="in-progress" aria-labelledby="profile-tab">
        <table class="table table-striped table-bordered data-table" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ordered By (Customer)</th>
                    <th>Customer's email</th>
                    <th>Total Price</th>
                    <th>Status</th>
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
                    <td style="color: orange;"><i class="fas fa-sync-alt"></i><strong> In progress</strong></td>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->products as $orderProduct)
                                                <tr v-pre>
                                                    <td class="counterCell"></td>
                                                    <td><a href="#">{{ $orderProduct->name }}</a></td>
                                                    <td> {{ $orderProduct->gender }} </td>
                                                    <td> {{ $orderProduct->publish_date }} </td>
                                                    <td class="product-currency">{{ $orderProduct->price }}</td>
                                                    <td>{{ $orderProduct->sale }}%</td>
                                                </tr>
                                                @endforeach
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
                        <form action="{{ route('admin.orders.deliver', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        {{ __('Delivery') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <form action="{{ route('admin.orders.close', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        {{ __('Close') }}
                                    </button>
                                </div>
                            </div>
                        </form>
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
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        <div class="float-right">{{ $inProgressOrders->appends(array_except(Request::query(), 'in-progress'))->fragment('in-progress')->links('vendor.pagination.product-bottom') }}</div>
    </div>

    <!-- Delivered Orders -->
    <div class="tab-pane fade" id="delivered" role="delivered" aria-labelledby="contact-tab">
        <table class="table table-striped table-bordered data-table" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ordered By (Customer)</th>
                    <th>Customer's email</th>
                    <th>Total Price</th>
                    <th>Status</th>
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
                    <td style="color: green;"><i class="fas fa-clipboard-check"></i><strong> Delivered</strong></td>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->products as $orderProduct)
                                                <tr v-pre>
                                                    <td class="counterCell"></td>
                                                    <td><a href="#">{{ $orderProduct->name }}</a></td>
                                                    <td> {{ $orderProduct->gender }} </td>
                                                    <td> {{ $orderProduct->publish_date }} </td>
                                                    <td class="product-currency">{{ $orderProduct->price }}</td>
                                                    <td>{{ $orderProduct->sale }}%</td>
                                                </tr>
                                                @endforeach
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
                    <th>Status</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        <div class="float-right">{{ $deliveredOrders->appends(array_except(Request::query(), 'delivered'))->fragment('delivered')->links('vendor.pagination.product-bottom') }}
        </div>
    </div>
    <div class="tab-pane fade" id="closed" role="closed" aria-labelledby="contact-tab">
        <table class="table table-striped table-bordered data-table" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ordered By (Customer)</th>
                    <th>Customer's email</th>
                    <th>Total Price</th>
                    <th>Status</th>
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
                    <td style="color: red;"><i class="fas fa-times-circle"></i><strong> Closed</strong></td>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->products as $orderProduct)
                                                <tr v-pre>
                                                    <td class="counterCell"></td>
                                                    <td><a href="#">{{ $orderProduct->name }}</a></td>
                                                    <td> {{ $orderProduct->gender }} </td>
                                                    <td> {{ $orderProduct->publish_date }} </td>
                                                    <td class="product-currency">{{ $orderProduct->price }}</td>
                                                    <td>{{ $orderProduct->sale }}%</td>
                                                </tr>
                                                @endforeach
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
                    <th>Status</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        <div class="float-right">{{ $closedOrders->appends(array_except(Request::query(), 'closed'))->fragment('closed')->links('vendor.pagination.product-bottom') }}</div>
    </div>
</div>
@endsection
