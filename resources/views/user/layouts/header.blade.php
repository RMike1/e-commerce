<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <div class="header-dropdown">
                    @php
                        $currency=App\Models\Currency::where('fr_use_status','1')->where('user_id',Auth::user()->id)->first()->code;
                    @endphp
                    <a href="#" id="currency">{{$currency}}</a>
                    <div class="header-menu">
                        <ul>
                            @foreach (App\Models\Currency::where('status','1')->where('user_id',Auth::user()->id)->oldest()->take(4)->get() as $currency)
                            <li class="convert-currency-header">
                                <button type="button" value="{{$currency->id}}" class="bg-transparent border-0 text-muted curre" id="currency_btn">{{$currency->code}}</button>
                            </li>
                            @endforeach
                            
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropdown -->

                <div class="header-dropdown">
                    <a href="#">Eng</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">English</a></li>
                            <li><a href="#">French</a></li>
                            <li><a href="#">Spanish</a></li>
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropdown -->
            </div><!-- End .header-left -->

            <div class="header-right">
                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li><a href="tel:#"><i class="icon-phone"></i>Call: +(250) 788 888 888</a></li>
                            <li><a href="{{route('cart')}}"><i class="icon-shopping-cart"></i>My Cart
                                @auth
                                <span>({{App\Models\Cart::where('user_id',Auth::user()->id)->count()}})</span>
                                @endauth
                                @guest
                                <span>(0)</span>
                                @endguest
                            </a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                            @guest
                            @if (Route::has('login'))
                            <li><a href="#signin-modal" data-toggle="modal" ><i class="icon-user"></i>{{ __('Login') }}</a></li>
                            @else
                            @endif
                            @else
                            @if (Route::has('logout'))
                            <li>
                                <div class="header-dropdown">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault()"><i class="icon-user"></i> {{Auth::user()->name}}</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                            </li>
                                        </ul>
                                    </div><!-- End .header-menu -->
                                </div><!-- End .header-dropdown -->
                            </li>
                            @endif
                            @endguest
                        </ul>
                    </li>
                </ul><!-- End .top-menu -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-top -->

    <div class="header-middle sticky-header">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="{{route('home')}}" class="logo" >
                    <h3 class="font-weight-bold text-muted h2" style="font-family:Arial, Helvetica, sans-serif">MK <span style="color:#c96;">Store</span></h3>
                </a>

                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class="megamenu-container {{Request::routeIs('home') ? 'active' : ''}}">
                            <a href="{{route('home')}}" class="">Home</a>
                        </li>
                        <li class="megamenu-container {{Request::routeIs('product.category') ? 'active' : ''}}">
                            <a href="{{route('user.products')}}" class="sf-with-ul">Product</a>

                            <div class="megamenu megamenu-sm">
                                <div class="row no-gutters">
                                    <div class="col-md-6">
                                        <div class="menu-col">
                                            <div class="menu-title">Product</div><!-- End .menu-title -->
                                            <ul>
                                            @foreach (App\Models\Product::where('product_publish','1')->get() as $product)
                                            @if ($product->product_status=='1')
                                            <li><a href="{{route('user.product',$product->id)}}"><span>{{$product->product_name}}<span class="tip tip-new">New</span></span></a></li>
                                            @else
                                            <li><a href="{{route('user.product',$product->id)}}">{{$product->product_name}}</a></li>
                                            @endif
                                            @endforeach
                                            </ul>
                                        </div><!-- End .menu-col -->
                                    </div><!-- End .col-md-6 -->
                                    @foreach (App\Models\Category::where('category_status','1')->latest()->take(1)->get() as $best_category)

                                    <div class="col-md-6">
                                        <div class="banner banner-overlay">
                                            <a href="#" onclick="event.preventDefault();document.getElementById('best_h_cat').submit()">
                                                @if($best_category->image)
                                                <img src="{{asset($best_category->category_image)}}" alt="Banner">
                                                @else
                                                <img src="{{asset($best_category->category_image)}}" alt="Banner">
                                                @endif
                                                <div class="banner-content banner-content-bottom">
                                                    <div class="banner-title text-white">New Trends<br><span><strong>{{$best_category->name}} {{Carbon\Carbon::now()->format('Y')}}</strong></span></div><!-- End .banner-title -->
                                                </div><!-- End .banner-content -->
                                            </a>
                                            <form action="{{route('product.category')}}" id="best_h_cat" method="post" class="d-none">
                                                @csrf
                                                <input type="hidden" name="category_val" value="{{$best_category->name}}">
                                            </form>
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-md-6 -->
                                    @endforeach
                                </div><!-- End .row -->
                            </div><!-- End .megamenu megamenu-sm -->
                        </li>
                        <li class="{{Request::routeIs('cart') ? 'active' : ''}}">
                            <a href="{{route('cart')}}">Cart</a>
                        </li>
                        <li class="{{Request::routeIs('checkout') ? 'active' : ''}}">
                            <a href="{{route('checkout')}}">Checkout</a>
                        </li>
                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
            </div><!-- End .header-left -->

            <div class="header-right">
                <div class="header-search">
                    <a href="#" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
                    <form action="{{route('search.product')}}" method="get">
                        <div class="header-search-wrapper">
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="product" id="q" placeholder="Search in..." required>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->
                <div class="dropdown compare-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Compare Products" aria-label="Compare Products">
                        <i class="icon-random"></i>
                    </a>

                </div><!-- End .compare-dropdown -->
                   <div class="appendCartHeader">
                        @include('user.includes.cartheader')
                   </div>
                </div><!-- End .cart-dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->
</header><!-- End .header -->
@if(Session::has('warning'))
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="alert alert-danger  text-center" role="alert">
            <button type="button" class="close mt-1" data-dismiss="alert">&times;</button>
            {{Session::get('warning')}}
        </div>
    </div>
</div>
@endif