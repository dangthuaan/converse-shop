@extends('adminlte::page')

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>
                        {{ __('Delete product') }}
                    </h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label text-md-center">
                                {{ __('Are you sure deleting this product?') }}
                            </label>
                            <div class="form-group row mb-0" style="width: 50%; margin: 0 auto;">
                                <button class="btn btn-danger" style="width: 50%; margin: 0 auto;" type="submit">
                                    {{ __('Confirm delete') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
