@extends('adminlte::page')

@section('content')
<div class="container">
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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>
                        {{ __('Create product') }}
                    </h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.store') }}" role="form" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-group row col-md-10">
                            <input required type="file" class="form-control" name="image[]" placeholder="address" multiple>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </input>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="name">
                            {{ __('Product name') }}
                        </label>
                        <div class="col-md-6">
                            <input autocomplete="name" autofocus="" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required="" type="text" value="{{ old('name') }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </input>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="gender">
                        {{ __('Gender') }}
                    </label>
                    <div class="col-md-6">
                        <select autocomplete="gender" autofocus="" class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                            <option disabled="" selected="">
                                Choose gender
                            </option>
                            <option value="male">
                                Male
                            </option>
                            <option value="female">
                                Female
                            </option>
                            <option value="kid">
                                Kid
                            </option>
                        </select>
                        @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>
                                {{ $message }}
                            </strong>
                        </span>
                        @enderror
                    </div>
                </div>
                @foreach ($categories as $category)
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="category">
                        {{ $category->name }}
                    </label>
                    <div class="col-md-6">
                        <select class="form-control @error('category') is-invalid @enderror" id="category" name="category[]">
                            <option disabled="" selected="">
                                Choose Size
                            </option>
                            @foreach ($category->children as $child_category)
                            <option id="child" value="{{ $child_category->id }}">
                                {{$child_category->name}}
                            </option>
                            @endforeach
                        </select>
                        @error('category')
                        <span class="invalid-feedback" role="alert">
                            <strong>
                                {{ $message }}
                            </strong>
                        </span>
                        @enderror
                    </div>
                </div>
                @endforeach
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="description">
                        {{ __('Description') }}
                    </label>
                    <div class="col-md-6">
                        <textarea autocomplete="description" class="form-control @error('description') is-invalid @enderror" id="description" name="description" required="" value="{{ old('description') }}">
                        </textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>
                                {{ $message }}
                            </strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="publish_date">
                        {{ __('Publish date') }}
                    </label>
                    <div class="col-md-6">
                        <input autocomplete="publish_date" class="form-control" id="datepicker" name="publish_date" required="" type="text" value="{{ old('publish_date') }}">
                    </input>
                    @error('publish_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>
                            {{ $message }}
                        </strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right" for="price">
                    {{ __('Price') }}
                </label>
                <div class="col-md-6">
                    <input autocomplete="price" class="form-control" id="currency" name="price" placeholder="VNĐ" required="" type="text" value="{{ old('price') }}">
                </input>
                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="sale">
                {{ __('Sale') }}
            </label>
            <div class="col-md-6">
                <input autocomplete="sale" class="form-control" id="currency" max="90" min="0" name="sale" placeholder="%" required="" step="10" type="number" value="{{ old('sale') }}">
            </input>
            @error('sale')
            <span class="invalid-feedback" role="alert">
                <strong>
                    {{ $message }}
                </strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button class="btn btn-primary" type="submit">
                {{ __('Create') }}
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
