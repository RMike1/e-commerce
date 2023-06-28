<div
class="page-content">
    <div class="cart">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <table class="table table-cart table-mobile">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @forelse ($carts as $cart)
                            <tr>
                                <td>{{$i++}}.</td>
                                <td class="product-col">
                                    <div class="product">
                                        <figure class="product-media">
                                            <a href="{{route('user.product',$cart->product->id)}}">
                                                <img src="{{asset($cart->product->product_image)}}" alt="Product image">
                                            </a>
                                        </figure>
                                        <h3 class="product-title">
                                            <a href="{{route('user.product',$cart->product->id)}}">{{$cart->product->product_name}}</a>
                                        </h3><!-- End .product-title -->
                                    </div><!-- End .product -->
                                </td>
                                <td class="price-col" style="width:20%">
                                    @php
                                    $user_currency=App\Models\User::where('id',Auth::user()->id)->first()->currency_id;
                                    $currency_value=App\Models\User::where('currency_id',$user_currency)->first()->currency()->first();
                                    @endphp
                                    @if ($currency_value->code=='RWF')
                                    <span>{{number_format($cart->product->product_price/$currency_value->normal_val)}} Frw</span>
                                    @else
                                    {{$currency_value->symbol}}{{number_format($cart->product->product_price/$currency_value->normal_val,2)}}
                                    @endif
                                <td class="quantity-col">
                                    <div class="cart-product-quantity">
                                        <input type="hidden" class="form-control" id="cart_id" name="cart_id" value="{{$cart->id}}">
                                        <input type="hidden" class="form-control" id="cart_quantity" name="cart_id" value="{{$cart->id}}">
                                        <input type="number" class="form-control" id="cart_quantity_data" onchange="cartId(this);event.preventDefault()"  data-CartQty="{{$cart->quantity}}" name="quantity_cart" data-CartId="{{$cart->id}}" value="{{$cart->quantity}}" min="1"  step="1" data-decimals="0" required>
                                    </div><!-- End .cart-product-quantity -->
                                </td>
                                <td class="total-col" id="tot_amount_data" style="width:20%">
                                    @if ($currency_value->code=='RWF')
                                    <span>{{number_format($cart->tot_amount/$currency_value->normal_val,2)}} Frw</span>
                                    @else
                                    {{$currency_value->symbol}}{{number_format($cart->tot_amount/$currency_value->normal_val,2)}}
                                    @endif
                                </td>
                                <td class="remove-col"><button class="btn-remove" value="{{$cart->id}}" id="cart-remove-btn"><i class="icon-close"></i></button></td>
                            </tr>
                            </form>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <p>there is no pending product!!</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table><!-- End .table table-wishlist -->
                    <div class="cart-bottom">
                        <div class="cart-discount">
                            <form action="#">
                                <div class="input-group">
                                    <input type="text" class="form-control" required placeholder="coupon code">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
                                    </div><!-- .End .input-group-append -->
                                </div><!-- End .input-group -->
                        </div><!-- End .cart-discount -->

                        <a href="" class="btn btn-outline-dark-2">
                            <span>UPDATE CART</span>
                            <i class="icon-refresh"></i>
                        </a>
                    </div><!-- End .cart-bottom -->
                </div><!-- End .col-lg-9 -->
                <aside class="col-lg-3">
                    <div class="summary summary-cart">
                        <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                        <table class="table table-summary">
                            <tbody>
                                <tr class="summary-subtotal">
                                    <td>Subtotal:</td>
                                    @php
                                    $user_currency=App\Models\User::where('id',Auth::user()->id)->first()->currency_id;
                                    $currency_value=App\Models\User::where('currency_id',$user_currency)->first()->currency()->first();
                                    @endphp
                                    @if ($currency_value->code=='RWF')
                                    <td>
                                        <span>{{number_format($subtotcart/$currency_value->normal_val,2)}}Frw </span>
                                    </td>
                                    @else
                                    <td>
                                        {{$currency_value->symbol}}{{number_format($subtotcart/$currency_value->normal_val,2)}}
                                    </td>
                                    @endif
                                </tr><!-- End .summary-subtotal -->
                                <tr class="summary-shipping">
                                    <td>Shipping:</td>
                                    <td>&nbsp;</td>
                                </tr>
                                @php

                                $shipping_methodss=App\Models\Shipping::all();

                                $user_shipping=App\Models\User::where('id',Auth::user()->id)->first()->shipping_id;
                                $shipping_val=App\Models\User::where('shipping_id',$user_shipping)->first()->shipping()->first();

                                @endphp

                                @foreach ($shipping_methodss as $shipping_methodss)
                                    <tr class="summary-shipping-row">
                                        <td>
                                            <div class="custom-control custom-radio">
                                                @if ($shipping_methodss->id==$user_shipping)
                                                <input type="radio" id="{{$shipping_methodss->shipping_method}}" value="{{$shipping_methodss->id}}" name="shipping" class="custom-control-input shipping_val" checked>
                                                <label class="custom-control-label" for="{{$shipping_methodss->shipping_method}}">{{$shipping_methodss->shipping_method}}:</label>
                                                @else
                                                <input type="radio" id="{{$shipping_methodss->shipping_method}}" value="{{$shipping_methodss->id}}" name="shipping" class="custom-control-input shipping_val">
                                                <label class="custom-control-label" for="{{$shipping_methodss->shipping_method}}">{{$shipping_methodss->shipping_method}}:</label>
                                                @endif
                                            </div><!-- End .custom-control -->
                                        </td>
                                        @if ($currency_value->code=='RWF')
                                        <td>
                                            <span>{{number_format($shipping_methodss->value/$currency_value->normal_val,2)}} Frw </span>
                                        </td>
                                        @else
                                        <td>
                                            {{$currency_value->symbol}}{{number_format($shipping_methodss->value/$currency_value->normal_val,2)}}
                                        </td>
                                        @endif
                                    </tr><!-- End .summary-shipping-row -->

                                @endforeach

                                <tr class="summary-shipping-estimate">
                                    <td>Estimate for Your Country<br> <a href="#">Change address</a></td>
                                    <td>&nbsp;</td>
                                </tr><!-- End .summary-shipping-estimate -->

                                <tr class="summary-total">
                                    <td>Grand Total:</td>
                                    @if ($currency_value->code=='RWF')
                                    <td>
                                        <span class="final_tot">{{number_format(($final_tot/$currency_value->normal_val),2)}}Frw</span><span class="currency_v"></span>
                                    </td>
                                    @else
                                    <td>
                                        {{$currency_value->symbol}}<span class="final_tot">{{number_format(($final_tot/$currency_value->normal_val),2)}}</span>
                                    </td>
                                    @endif
                                </tr><!-- End .summary-total -->
                            </tbody>
                        </table><!-- End .table table-summary -->

                        <a href="{{route('checkout')}}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                    </div><!-- End .summary -->

                    <a href="{{route('product.category')}}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cart -->
</div><!-- End .page-content -->
