@section('title','MK | Checkout')
@extends('user.layouts.master')

@section('styles')
<!-- Plugins CSS File -->
<link rel="stylesheet" href="{{asset('user/assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('user/assets/css/plugins/owl-carousel/owl.carousel.css')}}">
<link rel="stylesheet" href="{{asset('user/assets/css/plugins/magnific-popup/magnific-popup.css')}}">
<!-- Main CSS File -->

<link rel="stylesheet" href="{{asset('user/assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('user/assets/css/plugins/nouislider/nouislider.css')}}">
<link rel="stylesheet" href="{{asset('user/assets/vendor/css/toastr.css')}}">
@endsection

@section('content')

@include('user.layouts.header')

<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Checkout<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <div class="checkout-discount">
                    <form action="#">
                        <input type="text" class="form-control" required id="checkout-discount-input">
                        <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
                    </form>
                </div><!-- End .checkout-discount -->
                <form action="{{route('order_by_cash')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-9">
                            <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>First Name *</label>
                                        <input type="text" value="{{old('first_name')}}" class="form-control @error('first_name') is-invalid @enderror" name="first_name" required>
                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Last Name *</label>
                                        <input type="text" value="{{old('second_name')}}" class="form-control @error('second_name') is-invalid @enderror" name="second_name" required>
                                        @error('second_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <label>Company Name (Optional)</label>
                                <input type="text" value="{{old('company')}}"  name="company" class="form-control">


                                <label>Country *</label>
                                <input type="text" value="{{old('country')}}" name="country" class="form-control @error ('country') is-invalid @enderror" required>
                                @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <label>Street address *</label>
                                <input type="text" name="street" value="{{old('street')}}" class="form-control @error ('street') is-invalid @enderror" placeholder="House number and Street name" required>
                                @error('street')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Town / City *</label>
                                        <input type="text" name="town" value="{{old('town')}}" class="form-control @error ('town') is-invalid @enderror" required>
                                        @error('town')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>State / County *</label>
                                        <input type="text" name="state" value="{{old('state')}}" class="form-control @error ('state') is-invalid @enderror" required>
                                        @error('state')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Email address *</label>
                                        <input type="text" name="email" value="{{old('email')}}" class="form-control @error ('email') is-invalid @enderror" required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Phone *</label>
                                        <input type="tel" name="phone" value="{{old('phone')}}" class="form-control @error ('phone') is-invalid @enderror" required>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <label>Order notes (optional)</label>
                                <textarea class="form-control" name="note" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery">{{old('note')}}</textarea>
                        </div><!-- End .col-lg-9 -->

                        <aside class="col-lg-3 append-order-summary">
                           @include('user.includes.order-summary')
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </form>

            </div><!-- End .container -->
        </div><!-- End .checkout -->
    </div><!-- End .page-content -->
</main><!-- End .main -->


@include('user.layouts.sign-in')

@endsection
@section('scripts')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="{{asset('user/assets/js/toastr-plugin.js')}}"></script>
<script src="{{asset('user/assets/vendor/js/toastr.js')}}"></script>
<script>


     //========================remove items from cart header===============================

 $(document).ready(function(){
        $(document).on('click', '.remove-cart-btn', function(e){
            e.preventDefault();
            if(confirm("remove this item?"))
            {
            var cart_id=$(this).val();
            // alert(cart_id);
            $.ajaxSetup({
            headers:{
                "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                data:{cart_id:cart_id},
                url:"{{route('remove.cart')}}",
                type:"GET",
                dataType:"json",
                success:function(response)
                {

                        $(".append-order-summary").html(response.order_summary);
                        $(".appendCartHeader").html(response.header);

                        toastr.warning(response.warning, {
                            positionClass: "toast-top-right",
                            timeOut: 3e3,
                            closeButton: !0,
                            debug: !1,
                            newestOnTop: !0,
                            progressBar: !0,
                            preventDuplicates: !0,
                            onclick: null,
                            showDuration: "300",
                            hideDuration: "1000",
                            extendedTimeOut: "1000",
                            showEasing: "swing",
                            hideEasing: "linear",
                            showMethod: "fadeIn",
                            hideMethod: "fadeOut",
                            tapToDismiss: !1
                        })

                },
            });
        }
            else{
                return false;
            }

        });

         //========================Changing Currency===============================

         $(document).on('click', '#currency_btn', function(e){
            e.preventDefault();
            var currency_val=$(this).val();

            $.ajaxSetup({
            headers:{
                "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({

                data:{currency_va:currency_val},
                url:"{{route('change.currency')}}",
                type:"get",
                dataType:"json",
                success:function(response){

                    if(response.status=='200'){

                    $(".append-order-summary").html(response.order_summary);
                    $("#currency").text(response.new_currency);
                    $(".appendCartHeader").html(response.header);
                    toastr.success(response.message + response.new_currency, {
                        positionClass: "toast-top-right",
                        timeOut: 3e3,
                        closeButton: !0,
                        debug: !1,
                        newestOnTop: !0,
                        progressBar: !0,
                        preventDuplicates: !0,
                        onclick: null,
                        showDuration: "300",
                        hideDuration: "1000",
                        extendedTimeOut: "1000",
                        showEasing: "swing",
                        hideEasing: "linear",
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut",
                        tapToDismiss: !1
                    })
                    }
                    else{
                        $('#signin-modal').modal('show');
                        $('.login-auth').append(`<div class="alert alert-warning text-center">`+response.message+`
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="icon-close"></i></span>
                            </button>
                        </div>`);
                    }
                }
            });
        });

        $(document).on('click','.card-paymemt', function(e){
            e.preventDefault();
            $('.cash-payment-btn').hide();
            $('.card-payment').show();
        });
        $(document).on('click','.cash-paymemt', function(e){
            e.preventDefault();
            $('.cash-payment-btn').show();
            $('.card-payment').hide();
        });
        });
</script>
<script type="text/javascript">

    $(function() {



        var $form         = $(".require-validation");



        $('form.require-validation').bind('submit', function(e) {

            var $form         = $(".require-validation"),

            inputSelector = ['input[type=email]', 'input[type=password]',

                             'input[type=text]', 'input[type=file]',

                             'textarea'].join(', '),

            $inputs       = $form.find('.required').find(inputSelector),

            $errorMessage = $form.find('div.error'),

            valid         = true;

            $errorMessage.addClass('hide');



            $('.has-error').removeClass('has-error');

            $inputs.each(function(i, el) {

              var $input = $(el);

              if ($input.val() === '') {

                $input.parent().addClass('has-error');

                $errorMessage.removeClass('hide');

                e.preventDefault();

              }

            });



            if (!$form.data('cc-on-file')) {

              e.preventDefault();

              Stripe.setPublishableKey($form.data('stripe-publishable-key'));

              Stripe.createToken({

                number: $('.card-number').val(),

                cvc: $('.card-cvc').val(),

                exp_month: $('.card-expiry-month').val(),

                exp_year: $('.card-expiry-year').val()

              }, stripeResponseHandler);

            }



      });



      function stripeResponseHandler(status, response) {

            if (response.error) {

                $('.error')

                    .removeClass('hide')

                    .find('.alert')

                    .text(response.error.message);

            } else {

                /* token contains id, last4, and card type */

                var token = response['id'];



                $form.find('input[type=text]').empty();

                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");

                $form.get(0).submit();

            }
        }

    });

    </script>
<script>
    @if (Session::has('success'))
    toastr.success("{{Session('success')}}", "Success", {
                        positionClass: "toast-top-right",
                        timeOut: 3e3,
                        closeButton: !0,
                        debug: !1,
                        newestOnTop: !0,
                        progressBar: !0,
                        preventDuplicates: !0,
                        onclick: null,
                        showDuration: "300",
                        hideDuration: "1000",
                        extendedTimeOut: "1000",
                        showEasing: "swing",
                        hideEasing: "linear",
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut",
                        tapToDismiss: !1
                    })
    @endif
</script>
@endsection
