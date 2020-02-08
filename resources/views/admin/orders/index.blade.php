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

<h1>Order list:</h1>
<a href="#" class="btn btn-success">Deliver all</a>
<hr>

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#all-orders" role="tab" aria-controls="home" aria-selected="true">All Order</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#in-progress" role="tab" aria-controls="profile" aria-selected="false">In Progress</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#delivered" role="tab" aria-controls="contact" aria-selected="false">Delivered</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="all-orders" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-striped table-bordered example" style="width:100%">
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
                @foreach ($orders as $order)
                <tr v-pre>
                    <td> {{$order->id}} </td>
                    <td>{{$order->user ? $order->user->name : ''}}</td>
                    <td>{{$order->user ? $order->user->email : ''}}</td>
                    <td class="currency-data">{{$order->total_price}}</td>
                    @if ($order->isInProgressOrder())
                    <td style="color: orange;"><i class="fas fa-sync-alt"></i><strong> In progress</strong></td>
                    @else
                    <td style="color: green;"><i class="fas fa-clipboard-check"></i><strong> Delivered</strong></td>
                    @endif
                    <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                    <td>
                        <form action="{{ route('admin.orders.deliver', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        {{ __('Delivery') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        {{ __('Delete') }}
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
    </div>
    <div class="tab-pane fade" id="in-progress" role="in-progress" aria-labelledby="profile-tab">
        <table class="table table-striped table-bordered example" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ordered By (Customer)</th>
                    <th>Customer's email</th>
                    <th>Total Price</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                @if ($order->isInProgressOrder())
                <tr v-pre>
                    <td> {{$order->id}} </td>
                    <td>{{$order->user ? $order->user->name : ''}}</td>
                    <td>{{$order->user ? $order->user->email : ''}}</td>
                    <td class="currency-data">{{$order->total_price}}</td>
                    <td> {{$order->description}} </td>
                    <td style="color: orange;"><i class="fas fa-sync-alt"></i><strong> In progress</strong></td>
                    <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                    <td>
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        {{ __('Delivery') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Ordered By</th>
                    <th>Customer's email</th>
                    <th>Total Price</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="tab-pane fade" id="delivered" role="delivered" aria-labelledby="contact-tab">
        <table class="table table-striped table-bordered example" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ordered By (Customer)</th>
                    <th>Customer's email</th>
                    <th>Total Price</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                @if ($order->isInProgressOrder())
                <tr v-pre>
                    <td> {{$order->id}} </td>
                    <td>{{$order->user ? $order->user->name : ''}}</td>
                    <td>{{$order->user ? $order->user->email : ''}}</td>
                    <td class="currency-data">{{$order->total_price}}</td>
                    <td> {{$order->description}} </td>
                    <td style="color: green;"><i class="fas fa-clipboard-check"></i><strong> Delivered</strong></td>
                    <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                    <td>
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        {{ __('Delivery') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Ordered By</th>
                    <th>Customer's email</th>
                    <th>Total Price</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@endsection
