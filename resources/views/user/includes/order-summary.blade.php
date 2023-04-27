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
                $currency_value=App\Models\Currency::where('fr_use_status','1')->where('user_id',Auth::user()->id)->first();
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
                $currency_value=App\Models\Currency::where('fr_use_status','1')->where('user_id',Auth::user()->id)->first();
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

        <div class="card cash-paymemt">
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

        <div class="card card-paymemt">
            <div class="card-header" id="heading-5">
                <h2 class="card-title">
                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                        Credit Card (Stripe)
                        <img src="{{asset('user/assets/images/payments-summary.png')}}" alt="payments cards">
                    </a>
                </h2>
            </div><!-- End .card-header -->
            <div id="collapse-5" class="collapse" aria-labelledby="heading-5" data-parent="#accordion-payment">
                <div class="card-body"> Donec nec justo eget felis facilisis fermentum.Lorem ipsum dolor sit amet.
                </div><!-- End .card-body -->
                <div class="container">

                    <h1>E-shop Payment</h1>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="panel panel-default credit-card-box">

                                <div class="panel-heading display-table" >

                                    <div class="row display-tr" >

                                        <h3 class="panel-title display-td" >Payment Details</h3>

                                        <div class="display-td" >

                                            <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">

                                        </div>

                                    </div>

                                </div>

                                <div class="panel-body">

                                    @if (Session::has('success'))

                                        <div class="alert alert-success text-center">

                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

                                            <p>{{ Session::get('success') }}</p>

                                        </div>

                                    @endif



                                    <form

                                            role="form"

                                            action="{{ route('stripe.post') }}"

                                            method="post"

                                            class="require-validation"

                                            data-cc-on-file="false"

                                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"

                                            id="payment-form">

                                        @csrf



                                        <div class='form-row row'>

                                            <div class='col-xs-12 form-group required'>

                                                <label class='control-label'>Name on Card</label> <input

                                                    class='form-control' size='4' type='text'>

                                            </div>

                                        </div>



                                        <div class='form-row row'>

                                            <div class='col-xs-12 form-group card required'>

                                                <label class='control-label'>Card Number</label> <input

                                                    autocomplete='off' class='form-control card-number' size='20'

                                                    type='text'>

                                            </div>

                                        </div>



                                        <div class='form-row row'>

                                            <div class='col-xs-12 col-md-4 form-group cvc required'>

                                                <label class='control-label'>CVC</label> <input autocomplete='off'

                                                    class='form-control card-cvc' placeholder='ex. 311' size='4'

                                                    type='text'>

                                            </div>

                                            <div class='col-xs-12 col-md-4 form-group expiration required'>

                                                <label class='control-label'>Expiration Month</label> <input

                                                    class='form-control card-expiry-month' placeholder='MM' size='2'

                                                    type='text'>

                                            </div>

                                            <div class='col-xs-12 col-md-4 form-group expiration required'>

                                                <label class='control-label'>Expiration Year</label> <input

                                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'

                                                    type='text'>

                                            </div>

                                        </div>



                                        <div class='form-row row'>

                                            <div class='col-md-12 error form-group hide'>

                                                <div class='alert-danger alert'>Please correct the errors and try

                                                    again.</div>

                                            </div>

                                        </div>



                                        <div class="row">

                                            <div class="col-xs-12">

                                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now ($100)</button>

                                            </div>

                                        </div>



                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>



                </div>
            </div><!-- End .collapse -->
        </div><!-- End .card -->
    </div><!-- End .accordion -->
    <div class="payment-option">
        <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block cash-payment-btn">
            <span class="btn-text place-order">Place Order</span>
            <span class="btn-hover-text proceed">Proceed to Checkout</span>
        </button>

    </div>
</div><!-- End .summary -->
