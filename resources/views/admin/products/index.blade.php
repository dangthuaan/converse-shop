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
<h1>Product list:</h1>
<a href="{{ route('admin.products.create') }}" class="btn btn-primary">Create</a>
<hr>

<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Gender</th>
            <th>Category</th>
            <th>Description</th>
            <th>Publish date</th>
            <th>Price(VNĐ)</th>
            <th>Sale(%)</th>
            <th>Created by</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr v-pre>
            <td> {{ $product->id }} </td>
            <td>
                @foreach(explode('|', $product->image) as $images)
                <img src="{{ url($images) }}" alt="{{$images}}" style="width: 120px; height: 189.5px;">
                @endforeach
            </td>
            <td> {{ $product->name }} </td>
            <td> {{ $product->gender }} </td>
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
            <td> {{ $product->description }} </td>
            <td> {{ $product->publish_date }} </td>
            <td class="currency-data">{{ $product->price }}</td>
            <td class="currency-data">{{ $product->sale }}</td>
            <td>{{ $product->createdBy ? $product->createdBy->email : '' }}</td>
            <td>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>

                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
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
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Gender</th>
            <th>Category</th>
            <th>Description</th>
            <th>Publish date</th>
            <th>Price(VNĐ)</th>
            <th>Sale(%)</th>
            <th>Created by</th>
            <th></th>
        </tr>
    </tfoot>
</table>
@endsection

@section('css')
<style type="text/css">
#categories_table {
    table-layout: fixed;
    border-collapse: collapse;
    width: 100%;
}
</style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@stop
</hr>
