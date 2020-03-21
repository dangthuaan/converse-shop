@extends('admin.dashboard')

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
                <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-form-label text-md-right" for="name">
                                {{ __('Product image') }} <strong class="required-field">*</strong>
                            </label>
                            <div class="dropzone" id="dropzone">
                                <input required type="file" class="form-control @error('image') is-invalid @enderror" name="image[]" multiple>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="name">
                                {{ __('Product name') }} <strong class="required-field">*</strong>
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
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="gender">
                                {{ __('Gender') }} <strong class="required-field">*</strong>
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
                        @foreach ($parentCategories as $parentCategory)
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="category">
                                {{ $parentCategory->name }} <strong class="required-field">*</strong>
                            </label>
                            <div class="col-md-6">
                                <select class="form-control @error('category') is-invalid @enderror" id="category" name="category[]">
                                    <option disabled="" selected="">
                                        Choose Size
                                    </option>
                                    @foreach ($parentCategory->children as $childCategory)
                                    <option id="child" value="{{ $childCategory->id }}">
                                        {{$childCategory->name}}
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
                                {{ __('Description') }} <strong class="required-field">*</strong>
                            </label>
                            <div class="col-md-6">
                                <textarea rows="10" autocomplete="description" class="form-control @error('description') is-invalid @enderror" id="description" name="description" required="" value="{{ old('description') }}"></textarea>
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
                                {{ __('Publish date') }} <strong class="required-field">*</strong>
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
                            {{ __('Price') }}(VNĐ) <strong class="required-field">*</strong>
                        </label>
                        <div class="col-md-6">
                            <input autocomplete="price" class="form-control product-currency" id="currency" name="price" placeholder="VNĐ" required="" type="text" value="{{ old('price') }}">
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
                            {{ __('Sale') }}(%)
                        </label>
                        <div class="col-md-6">
                            <input autocomplete="sale" class="form-control" id="currency" max="90" min="0" name="sale" placeholder="%" step="5" type="number" value="{{ old('sale') }}">
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
                            <button class="btn btn-primary" type="submit" style="margin-bottom: 20px;">
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
