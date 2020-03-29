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
                        {{ __('Edit category') }}
                    </h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.categories.update', $categories->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="category_name">
                                {{ __('Category ') }}
                            </label>
                            <div class="col-md-6">
                                <select autocomplete="parent_id" class="form-control @error('parent_id') is-invalid @enderror" id="categories" name="parent_id">
                                    @if ($categories->parent_id == null)
                                    <option id="parent" style="font-weight:700;" value="0">
                                        {{$categories->name}}
                                    </option>
                                    @else
                                    <option id="child" value="{{$categories->parent_id}}">
                                        {{$categories->name}}
                                    </option>
                                    @endif
                                </select>
                                @error('parent_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="name">
                                {{ __('Edit Category name') }}
                            </label>
                            <div class="col-md-6">
                                <input autocomplete="name" class="form-control @error('name') is-invalid @enderror" id="category-text" name="name" type="text" value="{{$categories->name}}">
                                </input>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button class="btn btn-primary" type="submit">
                                    {{ __('Update') }}
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
