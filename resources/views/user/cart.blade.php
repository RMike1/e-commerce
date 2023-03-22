@section('title','E-shop Cart')
@extends('user.layouts.master')
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
<div id="appendCart">
    @include('user.includes.cartItems')
</div>
</main><!-- End .main -->
@include('user.layouts.sign-in')
@endsection
@section('scripts')
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
                $("#appendCart").html(response.view);
                $("#appendCartHeader").html(response.header);
            },
            
            // error:function(error)
            // {
            //     console.log(error);
            // }
        });
        }
</script>
@endsection
