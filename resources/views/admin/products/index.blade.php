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
<h1>Product List</h1>
<a href="{{ route('admin.products.create') }}" class="btn btn-primary">Create new product</a>
<hr>

<table id="example" class="table data-table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Gender</th>
            <th>Publish date</th>
            <th>Price(VNĐ)</th>
            <th>Sale(%)</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $key => $product)
        <tr v-pre>
            <td> {{ $products->firstItem() + $key }} </td>
            <td><strong> {{ $product->name }} </strong></td>
            <td class="gender"> {{ $product->gender }} </td>
            <td class="date publish-date"> {{ $product->publish_date }} </td>
            <td class="product-currency price">{{ $product->price }}</td>
            <td class="currency sale">{{ $product->sale }}%</td>
            <td class="detail"><button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#orderDetail{{ $product->id }}" data-order-id="{{ $product->id }}">Detail</button>
                <!-- Modal -->
                <div class="modal fade" id="orderDetail{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="orderDetailLabel" aria-hidden="true">
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
                                    <tbody>
                                        <tr v-pre>
                                            <th>Product Name</th>
                                            <td style="color: #007bff;"><strong>{{ $product->name }}</strong></td>
                                        </tr>
                                        <tr v-pre>
                                            <th>Product Image</th>
                                            <td>
                                                @foreach(explode('|', $product->image) as $images)
                                                <img src="{{ url($images) }}" alt="{{$images}}" style="width: 192px; height: 179px;">
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr v-pre>
                                            <th>Gender</th>
                                            <td>{{ $product->gender }}</td>
                                        </tr>
                                        <tr v-pre>
                                            <th>Category</th>
                                            <td>
                                                <table id="categories_table">
                                                    @foreach ($product->categories as $category)
                                                    <tr>
                                                        <th>{{ $parentCategory[$category->id] }}</th>
                                                        <td>{{ $category->name ?? '' }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                        <tr v-pre>
                                            <th>Description</th>
                                            <td>{{ $product->description }}</td>
                                        </tr>
                                        <tr v-pre>
                                            <th>Publish Date</th>
                                            <td>{{ $product->publish_date }}</td>
                                        </tr>
                                        <tr v-pre>
                                            <th>Price</th>
                                            <td class="product-currency">{{ $product->price }}</td>
                                        </tr>
                                        <tr v-pre>
                                            <th>Sale</th>
                                            <td>{{ $product->sale }}%</td>
                                        </tr>
                                        <tr v-pre>
                                            <th>Created By</th>
                                            <td>{{ $product->user ? $product->user->email : '' }}</td>
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
            <td style="text-align: center;">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>

                <form class="action-form" action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="col-md-6 offset-md-1">
                        <button type="submit" class="btn btn-sm btn-danger">
                            {{ __('Delete') }}
                        </button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Gender</th>
            <th>Publish date</th>
            <th>Price(VNĐ)</th>
            <th>Sale(%)</th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>
<div class="float-right">{{ $products->links('vendor.pagination.product-bottom') }}
</div>
@endsection
