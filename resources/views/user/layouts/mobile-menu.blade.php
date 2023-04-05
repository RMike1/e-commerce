<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="{{route('search.product')}}" method="get" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="product" id="mobile-search" placeholder="Search in..." required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>
        
        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li class="{{Request::routeIs('home') ? 'active' : ''}}">
                    <a href="{{route('home')}}">Home</a>
                </li>
                
                <li class="{{Request::routeIs('product.category') ? 'active' : ''}}">
                    <a href="{{route('user.products')}}" class="sf-with-ul">Product</a>
                    <ul>
                        @foreach (App\Models\Product::where('product_publish','1')->get() as $product)
                        @if ($product->product_status=='1')
                        <li><a href="{{route('user.product',$product->id)}}"><span>{{$product->product_name}}<span class="tip tip-new">New</span></span></a></li>
                        @else
                        <li><a href="{{route('user.product',$product->id)}}">{{$product->product_name}}</a></li>
                        @endif
                        @endforeach
                    </ul>
                </li>
                <li class="{{Request::routeIs('cart') ? 'active' : ''}}">
                    <a href="{{route('cart')}}">Cart</a>
                </li>
                <li class="{{Request::routeIs('checkout') ? 'active' : ''}}">
                    <a href="{{route('checkout')}}">Checkout</a>
                </li>
            </ul>
        </nav><!-- End .mobile-nav -->

        <div class="social-icons">
            <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->