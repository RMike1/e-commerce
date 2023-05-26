@auth
<div class="product-price">
        @php
        $user_currency=App\Models\User::where('id',Auth::user()->id)->first()->currency_id;
        $currency_value=App\Models\User::where('currency_id',$user_currency)->first()->currency()->first();
        @endphp
        @if ($currency_value->code=='RWF')
        {{number_format($product->product_price/$currency_value->normal_val,2)}} Frw
        @else
        {{$currency_value->symbol}}{{number_format($product->product_price/$currency_value->normal_val,2)}}
        @endif
    </div><!-- End .product-price -->
@endauth
@guest
<div class="product-price">
    @php
    $currency_value=App\Models\Currency::where('code','RWF')->first();
    @endphp
    {{number_format($product->product_price/$currency_value->normal_val,2)}} Frw
</div><!-- End .product-price -->
@endguest
