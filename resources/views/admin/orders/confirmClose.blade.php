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
                        {{ __('Closing order') }}
                    </h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.orders.close', $order->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="close_reason">
                                {{ __('Reason for closing the order: ') }}
                            </label>
                            <div class="col-md-6">
                                <textarea rows="10" id="close_reason" class="form-control @error('close_reason') is-invalid @enderror" name="close_reason" value="{{ old('close_reason') }}" required autocomplete="close_reason" autofocus></textarea>
                                @error('close_reason')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button class="btn btn-danger" type="submit">
                                    {{ __('Submit') }}
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
