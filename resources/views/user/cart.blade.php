@section('title','E-shop Cart')
@extends('user.layouts.master')
@section('styles')
<link rel="stylesheet" href="{{asset('user/assets/vendor/css/toastr.css')}}">
@endsection
@section('content')

@include('user.layouts.header')

<main class="main">
    <div class="page-header text-center" style="background-image: url('{{asset('user/assets/images/page-header-bg.jpg')}}">
        <div class="container">
            <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
<div class="appendCart">
    @include('user.includes.cartItems')
</div>
</main><!-- End .main -->
@include('user.layouts.sign-in')
@endsection
@section('scripts')
<script src="{{asset('user/assets/js/toastr-plugin.js')}}"></script>
<script src="{{asset('user/assets/vendor/js/toastr.js')}}"></script>

<!-- update cart -->

<script>

    function cartId(cart_id){
        var cart_quantity=document.getElementById('cart_quantity').value=$(cart_id).val();
        var cart_id=document.getElementById('cart_id').value=$(cart_id).attr('data-CartId');
        // alert(cart_id);
        $.ajaxSetup({
            headers:{
                "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            data:{ id:cart_id, quantity:cart_quantity},
            url:"{{route('update.cart')}}",
            type:"post",
            dataType:"json",
            success:function(response)
            {
                console.log(response);
                $(".appendCart").html(response.view);
                $(".appendCartHeader").html(response.header);
            },

            // error:function(error)
            // {
            //     console.log(error);
            // }
        });
        }

    //========================remove items from cart ===============================

    $(document).ready(function(){
        $(document).on('click', '#cart-remove-btn', function(e){

            e.preventDefault();
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

                    $(".appendCart").html(response.view);
                    $(".appendCartHeader").html(response.header);

                    toastr.warning(response.warning, "Warning", {
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
                error:function(error)
                {
                    // alert('oops!!')
                    console.log(error);
                }
            });

        });

    //========================remove items from cart header===============================

        $(document).on('click', '.remove-cart-btn', function(e){
            e.preventDefault();
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
                    // console.log(response);
                    // alert('success!!')
                    $(".appendCart").html(response.view);
                    $(".appendCartHeader").html(response.header);

                    toastr.warning(response.warning, "Warning", {
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
                error:function(error)
                {
                    // alert('oops!!')
                    console.log(error);
                }
            });

        });

    //========================Shipping Option===============================

        $(document).on('change', '.shipping_val', function(e){
            e.preventDefault();
            var shipping_val=$(this).val();
            // alert(shipping_val);
            $.ajaxSetup({
            headers:{
                "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                data:{shipping_val:shipping_val},
                url:"{{route('shipping')}}",
                type:"POST",
                dataType:"json",
                success:function(response)
                {
                    $('.final_tot').text(response.final_tot);
                    // $(".appendCart").html(response.view);
                    // $(".appendCartHeader").html(response.header);
                },
                error:function(error)
                {
                    console.log(error);
                }
            });


        });

    });
</script>

@endsection
