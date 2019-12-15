@extends('layouts.shop')

@section('content')
<!--================Login Box Area =================-->
<section class="login_box_area p_120">
    @if (session('status'))
    <div class="alert alert-success" role="alert" style="text-align: center;">
        {{ session('status') }}
    </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="login_form_inner reg_form">
                    <h3>Account Profile</h3>
                    <form class="row login_form" action="{{ route('client.user.update', $user->id) }}" method="post" id="contactForm" novalidate="novalidate">
                        @csrf
                        @method('put')
                        <div class="col-md-12 form-group">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name }}" required autocomplete="name" placeholder="Name">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email }}" required autocomplete="email" placeholder="Email Address">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <a href="{{ route('client.user.showPassword', $user->id) }}" id="change_password" class="btn submit_btn" style="padding: 0px; font-size: 0.9em; margin-top: 0; color: #222222">Change Password</a>
                        </div>
                        <div class="col-md-6 form-group">
                            <button type="submit" value="submit" class="btn submit_btn" style="padding: 0px; font-size: 0.9em;">{{ __('Update Profile') }}</button>
                        </div>
                    </form>
                    <div class="col-md-12">
                            <a href="{{ route('client.user.confirmDestroy', $user->id) }}" id="delete_user" class="genric-btn danger" style="padding: 0 20px; font-size: 0.9em; margin-top: 0; text-transform: uppercase;">Delete Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Login Box Area =================-->
@endsection
