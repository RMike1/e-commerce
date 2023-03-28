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
                                <td class="price-col">${{number_format($cart->product->product_price,2)}}</td>
                                <td class="quantity-col">
                                    <div class="cart-product-quantity">
                                        <input type="hidden" class="form-control" id="cart_id" name="cart_id" value="{{$cart->id}}">
                                        <input type="hidden" class="form-control" id="cart_quantity" name="cart_id" value="{{$cart->id}}">
                                        <input type="number" class="form-control" id="cart_quantity_data" onchange="cartId(this);event.preventDefault()"  data-CartQty="{{$cart->quantity}}" name="quantity_cart" data-CartId="{{$cart->id}}" value="{{$cart->quantity}}" min="1"  step="1" data-decimals="0" required>
                                    </div><!-- End .cart-product-quantity -->
                                </td>
                                <td class="total-col" id="tot_amount_data">
                                    ${{number_format($cart->tot_amount,2)}}
                                </td>
                                <td class="remove-col"><button class="btn-remove" onclick="return confirm('remove this item from cart?')" value="{{$cart->id}}" id="cart-remove-btn"><i class="icon-close"></i></button></td>
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
                                    <td>${{number_format($subtotcart,2)}}</td>
                                </tr><!-- End .summary-subtotal -->
                                <tr class="summary-shipping">
                                    <td>Shipping:</td>
                                    <td>&nbsp;</td>
                                </tr>
                                @php
                                    $free_shipping=App\Models\Shipping::where('shipping_method','Free Shipping')->first();
                                    $standard_shipping=App\Models\Shipping::where('shipping_method','Standard')->first();
                                    $express_shipping=App\Models\Shipping::where('shipping_method','Express')->first();
                                @endphp

                                <tr class="summary-shipping-row">
                                    <td>
                                        <div class="custom-control custom-radio">
                                            @if ($free_shipping->status=='1')
                                            <input type="radio" id="free-shipping" value="{{$free_shipping->shipping_method}}" name="shipping" class="custom-control-input shipping_val" checked>
                                            @else
                                            <input type="radio" id="free-shipping" value="{{$free_shipping->shipping_method}}" name="shipping" class="custom-control-input shipping_val">
                                            @endif
                                            <label class="custom-control-label" for="free-shipping">Free Shipping</label>
                                        </div><!-- End .custom-control -->
                                    </td>
                                    <td>${{number_format($free_shipping->value,2)}}</td>
                                </tr><!-- End .summary-shipping-row -->

                                <tr class="summary-shipping-row">
                                    <td>
                                        <div class="custom-control custom-radio">
                                            @if ($standard_shipping->status=='1')
                                            <input type="radio" id="standart-shipping" value="{{$standard_shipping->shipping_method}}" name="shipping" class="custom-control-input shipping_val" checked>
                                            @else
                                            <input type="radio" id="standart-shipping" value="{{$standard_shipping->shipping_method}}" name="shipping" class="custom-control-input shipping_val">
                                            @endif
                                            <label class="custom-control-label" for="standart-shipping">Standard:</label>
                                        </div><!-- End .custom-control -->
                                    </td>
                                    <td>${{number_format($standard_shipping->value,2)}}</td>
                                </tr><!-- End .summary-shipping-row -->

                                <tr class="summary-shipping-estimate">
                                    <td>Estimate for Your Country<br> <a href="dashboard.html">Change address</a></td>
                                    <td>&nbsp;</td>
                                </tr><!-- End .summary-shipping-estimate -->

                                <tr class="summary-total">
                                    <td>Grand Total:</td>
                                    <td>$<span class="final_tot">{{number_format(($final_tot),2)}}</span></td>
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
