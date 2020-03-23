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
                        {{ __('Edit product') }}
                    </h1>
                </div>
                <form id="form" action="{{ route('admin.products.update', $product->id) }}" role="form" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="image">
                                {{ __('Product image') }} <strong class="required-field">*</strong>
                            </label>
                            <div class="col-md-6">
                                <input type="file" required id="upload-image" name="image[]" multiple>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="name">
                                {{ __('Product name') }} <strong class="required-field">*</strong>
                            </label>
                            <div class="col-md-6">
                                <input autocomplete="name" autofocus="" class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" value="{{ old('name') ?? $product->name }}">
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
                                    <option value="male" {{ $product->gender == 'male' ? 'selected' : '' }}>
                                        Male
                                    </option>
                                    <option value="female" {{ $product->gender == 'female' ? 'selected' : '' }}>
                                        Female
                                    </option>
                                    <option value="kid" {{ $product->gender == 'kid' ? 'selected' : '' }}>
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
                                    @foreach ($parentCategory->children as $childCategory)
                                    <option id="child" value="{{ $childCategory->id }}" @foreach ($product->categories as $category)
                                        {{ $childCategory->name == $category->name ? 'selected' : '' }}
                                        @endforeach>
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
                                {{ __('Description') }}
                            </label>
                            <div class="col-md-6">
                                <textarea rows="10" class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description') ?? $product->description }}</textarea>
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
                                <input autocomplete="publish_date" class="form-control @error('publish_date') is-invalid @enderror" id="datepicker" name="publish_date" type="text" placeholder="dd/mm/yyyy" value="{{ old('publish_date') ?? $product->publish_date }}">
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
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="price">
                            {{ __('Price') }}(VNĐ) <strong class="required-field">*</strong>
                        </label>
                        <div class="col-md-6">
                            <input autocomplete="price" class="form-control @error('price') is-invalid @enderror" id="datepicker" name="price" placeholder="VNĐ" type="text" value="{{ old('price') ?? $product->price }}">
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
                            {{ __('Sale') }} (%)
                        </label>
                        <div class="col-md-6">
                            <input autocomplete="sale" class="form-control product-sale" max="90" min="0" name="sale" placeholder="%" step="5" type="number" value="{{ old('sale') ?? $product->sale }}">
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4" style="margin-bottom: 20px;">
                            <button class="btn btn-primary" id="submit-form" type="submit">
                                {{ __('Update') }}
                            </button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="noImage" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <strong ">You need to upload product images first!</strong>
                                    </div>
                                    <div class=" modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
