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
                        {{ __('Ban User') }}
                    </h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.ban', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="ban_reason">
                                {{ __('Reason for ban this user: ') }}
                            </label>
                            <div class="col-md-6">
                                <textarea rows="10" id="ban_reason" class="form-control @error('ban_reason') is-invalid @enderror" name="ban_reason" value="{{ old('ban_reason') }}" required autocomplete="ban_reason" autofocus></textarea>
                                @error('ban_reason')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button class="btn btn-danger" type="submit">
                                    {{ __('Ban user') }}
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
