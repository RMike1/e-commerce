<div class="summary">
    <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

    <table class="table table-summary">
        <thead>
            <tr>
                <th>Product</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($carts as $cart)
            <tr>
                <td><a href="{{route('user.product',$cart->product->id)}}">{{$cart->product->product_name}}</a></td>
                @php
                $currency_value=App\Models\Currency::where('fr_use_status','1')->first();
                @endphp
                @if ($currency_value->code=='RWF')
                <td>
                    {{number_format($cart->tot_amount/$currency_value->normal_val,2)}} Frw
                </td>
                @else
                <td>
                    {{$currency_value->symbol}}{{number_format($cart->tot_amount/$currency_value->normal_val,2)}}
                </td>
                @endif
            </tr>
            @endforeach
            <tr class="summary-subtotal">
                <td>Subtotal:</td>
                @php
                $currency_value=App\Models\Currency::where('fr_use_status','1')->first();
                @endphp
                @if ($currency_value->code=='RWF')
                <td>
                    {{number_format($subtotcart/$currency_value->normal_val,2)}} Frw
                </td>
                @else
                <td>
                    {{$currency_value->symbol}}{{number_format($subtotcart/$currency_value->normal_val,2)}} 
                </td>
                @endif
            </tr><!-- End .summary-subtotal -->
            <tr>
                <td>Shipping:</td>

                <td>{{$shipping_method ? $shipping_method : '-'}}</td>
            </tr>
            <tr class="summary-total">
                <td>Total:</td>
                @if ($currency_value->code=='RWF')
                <td>
                    {{number_format($final_tot/$currency_value->normal_val,2)}} Frw
                </td>
               @else
               <td>
                    {{$currency_value->symbol}}{{number_format($final_tot/$currency_value->normal_val,2)}}
                </td>
                @endif
            </tr><!-- End .summary-total -->
        </tbody>
    </table><!-- End .table table-summary -->

    <div class="accordion-summary" id="accordion-payment">

        <div class="card">
            <div class="card-header" id="heading-3">
                <h2 class="card-title">
                    <a role="button" data-toggle="collapse" href="#collapse-3" aria-expanded="true" aria-controls="collapse-3">
                        Cash on delivery
                    </a>
                </h2>
            </div><!-- End .card-header -->
            <div id="collapse-3" class="collapse show" aria-labelledby="heading-3" data-parent="#accordion-payment">
                <div class="card-body">Quisque volutpat mattis eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.
                </div><!-- End .card-body -->
            </div><!-- End .collapse -->
        </div><!-- End .card -->

        <div class="card">
            <div class="card-header" id="heading-5">
                <h2 class="card-title">
                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                        Credit Card (Stripe)
                        <img src="{{asset('user/assets/images/payments-summary.png')}}" alt="payments cards">
                    </a>
                </h2>
            </div><!-- End .card-header -->
            <div id="collapse-5" class="collapse" aria-labelledby="heading-5" data-parent="#accordion-payment">
                <div class="card-body"> Donec nec justo eget felis facilisis fermentum.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Lorem ipsum dolor sit ame.
                </div><!-- End .card-body -->
            </div><!-- End .collapse -->
        </div><!-- End .card -->
    </div><!-- End .accordion -->

    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
        <span class="btn-text">Place Order</span>
        <span class="btn-hover-text">Proceed to Checkout</span>
    </button>
</div><!-- End .summary -->