<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
        <div class="logo-header">
            <i class="fa fa-shopping-bag fa-3x " style="color: #6B0505"></i><span class="logo" style="color: #6B0505">Meat Store</span>
        </div>
        {{-- <ul class="top-links contact-info">
            <li><i class="fa fa-envelope-o"></i> <a href="mailto: pengawal20@gmail.com">pengawal20@gmail.com</a></li>
            <li><i class="fa fa-whatsapp"></i> <a href="https://api.whatsapp.com/send?phone=081295187428">081295187428</a></li>
        </ul> --}}
        <div class="col-lg-4 col-10 col-sm-6">
            <form action="{{ url('products') }}" method="GET" class="search">
                <div class="input-group w-100">
                    <input type="text" class="form-control" placeholder="Search" name="q" value="{{ isset($q) ? $q : null }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @auth   
        <a href="{{ url('favorites') }}"> Profile: {{ Auth::user()->first_name }}</a>
        @endauth
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active mt-2">
                    <a class="nav-link" href="{{ url('/') }}">Home </a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link" href="{{ url('products')}} ">Products</a>
                </li>
                @auth
                    <li class="nav-item mt-2">
                        <a class="nav-link" href="{{ url('favorites') }}">Order History</a>
                    </li>
                    {{-- <li>Hello: <a href="{{ url('favorites') }}">{{ Auth::user()->first_name }}</a></li> --}}
                @endauth
                <li class="nav-item mt-2 ml-2">
                    @include('themes.ecome.partials.mini_cart') 
                </li> 
                @guest
                    <li class="nav-item mt-2">
                        <a class="nav-link" href="{{ url('register') }}">Sign Up</a>
                    </li>
                    <li class="nav-item mt-2">
                        <a class="btn btn-success nav-link px-4 text-white" href="{{ url('login') }}">Sign In</a>
                    </li>
                @endguest
                @auth
                    <!-- Desktop Menu -->
					<a class="mt-4" href="{{ route('logout') }}"
							onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">
							{{ __('Logout') }}
					</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none; ">
						@csrf
					</form>
                    {{-- <li class="nav-item">
                        <a href="{{ route('cart.index') }}" class="nav-link d-inline-block mt-2">
                            @php
                                $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                            @endphp
                            @if ($carts > 0)
                                <a class="nav-link d-inline-block mt-2" href="{{ route('cart.index')}}">
                                    <img src="{{ asset('frontend/images/icon-cart-filled.svg') }}" alt="" />
                                    <div class="cart-badge">{{ $carts }}</div>
                                </a>
                            @else
                                <img src="{{ asset('frontend/images/icon-cart-empty.svg') }}" alt="" />
                            @endif
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item dropdown">
                        {{-- <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('themes/ecome/assetsfrontend/images/icon-user.png') }}" alt=""
                                class="rounded-circle mr-2 profile-picture" />
                            Hi, {{ Auth::user()->name }}
                        </a> --}}
                        {{-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->roles == 'ADMIN')
                            <a class="dropdown-item" href="{{ route('dashboard')}}">Dashboard</a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <form action="{{route('logout')}}" method="post">
                            @csrf
                                <button type="submit" class="dropdown-item""> Logout </button>
                            </form>
                        </div> --}}
                    {{-- </li> --}}
                </ul>

                <!-- Mobile Menu -->
                <ul class="navbar-nav d-block d-lg-none">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Hi, {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-inline-block" href="#">
                            Cart
                        </a>
                    </li>
                </ul>
            @endauth
            </ul>
        </div>
    </div>
</nav>
