<div class="product-price">
    @php
    $currency_value=App\Models\Currency::where('fr_use_status','1')->where('user_id',Auth::user()->id)->first();
    @endphp
    @if ($currency_value->code=='RWF')
    {{number_format($product->product_price/$currency_value->normal_val,2)}} Frw
    @else
    {{$currency_value->symbol}}{{number_format($product->product_price/$currency_value->normal_val,2)}}
    @endif
</div><!-- End .product-price -->