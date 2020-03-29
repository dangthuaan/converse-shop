@extends('layouts.shop')

@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content">
                <h2>
                    Contact
                </h2>
                <div class="page_link">
                    <a href="{{ route('client.index') }}">
                        Home
                    </a>
                    <a href="">
                        Contact
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->
<!--================Contact Area =================-->
<section class="contact_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="contact_info">
                    <div class="info_item">
                        <i class="lnr lnr-home"></i>
                        <h6>Hà Nội, Việt Nam</h6>
                        <p>403 Cầu Giấy</p>
                    </div>
                    <div class="info_item">
                        <i class="lnr lnr-phone-handset"></i>
                        <h6>
                            <a href="#">00 (440) 9865 562</a>
                        </h6>
                        <br>
                    </div>
                    <div class="info_item">
                        <i class="lnr lnr-envelope"></i>
                        <h6>
                            <a href="#">support@converse.com</a>
                        </h6>
                        <p>Send us your query anytime!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <form class="row contact_form" method="GET" action="{{ route('client.contact.send') }}" id="contactForm">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" autocomplete="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" autocomplete="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email address" value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" autocomplete="subject" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Enter Subject" value="{{ old('subject') }}">
                            @error('subject')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" rows="1" placeholder="Enter Message"></textarea>
                            @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <button type="submit" value="submit" class="btn submit_btn">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--================Contact Area =================-->
@endsection
