@extends('layouts.shop')

@section('content')
<!--================Login Box Area =================-->
<section class="login_box_area p_120">
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
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="login_form_inner reg_form">
                    <h3>Account Profile - Change Password</h3>
                    <form class="row login_form" action="{{ route('client.user.updatePassword', $user->id) }}" method="post" id="contactForm" novalidate="novalidate">
                        @csrf
                        @method('put')
                        <div class="col-md-12 form-group">
                            <input id="current-password" type="password" class="form-control @error('current-password') is-invalid @enderror" name="current-password" placeholder="Current Password" required>

                            @error('current-password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <input id="new-password" type="password" class="form-control @error('new-password') is-invalid @enderror" name="new-password" placeholder="New Password" required>

                            @error('new-password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <input id="new-password-confirm" type="password" class="form-control @error('new-password-confirm') is-invalid @enderror" name="new-password_confirmation" placeholder="Confirm new Password" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="btn submit_btn" style="padding: 0px; font-size: 0.9em;">{{ __('Update Password') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Login Box Area =================-->
@endsection
