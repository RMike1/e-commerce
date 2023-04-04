<div class="dropdown cart-dropdown">
    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
        <i class="icon-shopping-cart"></i>
        @auth
        <span class="cart-count">{{App\Models\Cart::where('user_id',Auth::user()->id)->count()}}</span>
        @endauth
    </a>
<div class="dropdown-menu dropdown-menu-right">
    <div class="dropdown-cart-products">
   @auth
        @forelse (App\Models\Cart::where('user_id',Auth::user()->id)->latest()->take(3)->get() as $cart)
            <div class="product">
                <div class="product-cart-details">
                    <h4 class="product-title">
                        <a href="{{route('user.product',$cart->product->id)}}">{{$cart->product->product_name}}</a>
                    </h4>
                    <span class="cart-product-info">
                        <span class="cart-product-qty">{{$cart->quantity}}</span>
                        x ${{number_format($cart->product->product_price)}}
                    </span>
                </div><!-- End .product-cart-details -->

                <figure class="product-image-container">
                    <a href="{{route('user.product',$cart->product->id)}}" class="product-image">
                        <img src="{{asset($cart->product->product_image)}}" alt="product">
                    </a>
                </figure>
                <button href="#" type="button" value="{{$cart->id}}" class="btn-remove remove-cart-btn" title="Remove Product"><i class="icon-close"></i></button>
            </div><!-- End .product -->
            @empty
            <div class="product">
                <div class="product-cart-details">
                    <span class="cart-product-info">
                            no pendings in your cart..
                    </span>
                </div><!-- End .product-cart-details -->
            </div><!-- End .product -->
        @endforelse
    @endauth
    </div><!-- End .cart-product -->
    @auth
    <div class="dropdown-cart-total">
        <span>Total</span>
        @php
        $subtotcart=App\Models\Cart::where('user_id',Auth::user()->id)->sum('tot_amount');
        $shipping_val=App\Models\Shipping::where('status','1')->where('user_id',Auth::user()->id)->firstOrfail()->value;
        $final_tot=$subtotcart+$shipping_val;
        @endphp
      <span class="cart-total-price">$<span class="final_tot">{{number_format(($final_tot),2)}}</span></span>
    </div><!-- End .dropdown-cart-total -->
    @endauth
    <div class="dropdown-cart-action">
        <a href="{{route('cart')}}" class="btn btn-primary">View Cart</a>
        <a href="{{route('checkout')}}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
    </div><!-- End .dropdown-cart-total -->
</div><!-- End .dropdown-menu -->