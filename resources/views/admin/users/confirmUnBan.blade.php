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
                        {{ __('Un-Ban User') }}
                    </h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.unBan', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="un_ban_reason">
                                {{ __('Reason for un-ban this user: ') }}
                            </label>
                            <div class="col-md-6">
                                <textarea rows="10" id="un_ban_reason" class="form-control @error('un_ban_reason') is-invalid @enderror" name="un_ban_reason" value="{{ old('un_ban_reason') }}" required autocomplete="un_ban_reason" autofocus></textarea>
                                @error('un_ban_reason')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button class="btn btn-danger" type="submit">
                                    {{ __('Un-Ban user') }}
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
