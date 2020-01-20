<!--================Header Menu Area =================-->
<header class="header_area">
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
    <div class="top_menu row m0">
        <div class="container-fluid">
            <div class="float-left">
                <p>{{ __('<<Phan quyen nguoi dung>>') }}</p>
            </div>
            <div class="float-right">
                <ul class="right_side">
                    @guest
                    <li>
                        <a href="{{ route('login') }}">
                            Login/Register
                        </a>
                    </li>
                    @else
                    <li>
                        <a href="#">
                            <strong>{{ Auth::user()->name }}</strong>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    <li>
                        <a href="{{ route('client.user.show', auth()->id()) }}">
                            My Profile
                        </a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="{{ route('client.index') }}">
                    <img src="{{ asset('fashiop/img/logo-2.png') }}" alt="" style="width: 102px; height: 63px;">
                </a>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <div class="row w-100">
                        <div class="col-lg-7 pr-0">
                            <ul class="nav navbar-nav center_nav pull-right">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('client.index') }}">Home</a>
                                </li>
                                <li class="nav-item submenu dropdown">
                                <li class="nav-item">
                                    <a href="{{ route('client.products.index') }}" class="nav-link">Shop</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html">Contact</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-5">
                            <ul class="nav navbar-nav navbar-right right_nav pull-right">
                                <hr>
                                <li class="nav-item">
                                    <a href="#" class="icons">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </a>
                                </li>

                                <hr>

                                <li class="nav-item">
                                    <a href="#" class="icons">
                                        <i class="fa fa-heart-o" aria-hidden="true"> [0] </i>
                                    </a>
                                </li>

                                <hr>

                                <li class="nav-item">
                                    <a href="{{ route('client.orders.index') }}" class="icons">
                                        <i class="cart-number lnr lnr lnr-cart"> [{{ cartQuantity() }}] </i>
                                    </a>
                                </li>

                                <hr>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
<!--================Header Menu Area =================-->
