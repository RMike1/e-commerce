@section('title','MK | Product Category')
@extends('user.layouts.master')
@section('styles')
<link rel="stylesheet" href="{{asset('user/assets/css/plugins/nouislider/nouislider.css')}}">
<link rel="stylesheet" href="{{asset('user/assets/vendor/css/toastr.css')}}">
@endsection
@section('content')
@include('user.layouts.header')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">E-shop<span>Store</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">E-shop</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="append-category-data">
                @include('user.includes.category-products')
            </div>
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@include('user.layouts.sign-in')

@endsection
@section('scripts')
<script src="{{asset('user/assets/js/wNumb.js')}}"></script>
<script src="{{asset('user/assets/js/bootstrap-input-spinner.js')}}"></script>
<script src="{{asset('user/assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('user/assets/js/nouislider.min.js')}}"></script>
<script src="{{asset('user/assets/js/toastr-plugin.js')}}"></script>
<script src="{{asset('user/assets/vendor/js/toastr.js')}}"></script>

<script>

    $(document).ready(function(){
        $(document).on('click', '.btn-product-data',function(e){
            e.preventDefault();
            var product_id=$(this).val();
            var quantity=1;
            $(this).find('.btn-product-info').text('adding..');
            $('.login-auth').html("");
            
            $.ajaxSetup({
                headers:{
                    "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            data:{ product_id:product_id, quantity:quantity},
            url:"{{route('add.cart')}}",
            type:"post",
            dataType:"json",
            success:function(response)
            {
                // console.log(response);
                // alert('success!!')
                $(".appendCartHeader").html(response.header);
                $('.btn-product-info').text('add to cart')
               
                toastr.success(response.message, "Success", {
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
                $('#signin-modal').modal('show');
                $('.btn-product-info').text("add to cart");
                $('.login-auth').append(`<div class="alert alert-warning text-center">First Login To Continue
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="icon-close"></i></span>
                            </button>
                        </div>`);
            }
        });
    });
    })

    
    //========================remove items from cart header===============================


    $(document).ready(function(){
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
        
    //========================sort items by categories===============================

        $(document).on('click','.checkbox-category', function(e){
            e.preventDefault();
            var cat_val=$(this).val();
            // $(this).css('background')
            if(cat_val=='all')
            {
                $.ajaxSetup({
                    headers:{
                        "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    data:{category_val:cat_val},
                    url:"{{route('reset.sort_by_category')}}",
                    type:"get",
                    dataType:"json",
                    success:function(response)
                    {
                        // console.log(response);
                        $(".append-sort-category-product").html(response.view);
                    },
                    error:function(error)
                {
                    console.log(error);
                    $('#signin-modal').modal('show');
                    $('.btn-product-info').text("add to cart");
                    $('.login-auth').append(`<div class="alert alert-warning text-center">First Login To Continue
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="icon-close"></i></span>
                                </button>
                            </div>`);
                }
            });

            }
            else
            {

                $.ajaxSetup({
                    headers:{
                        "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    data:{category_val:cat_val},
                    url:"{{route('sort.category')}}",
                    type:"get",
                    dataType:"json",
                    success:function(response)
                    {
                        // console.log(response);
                        $(".append-sort-category-product").html(response.view);
                },
                error:function(error)
                {
                    console.log(error);
                    $('#signin-modal').modal('show');
                    $('.btn-product-info').text("add to cart");
                    $('.login-auth').append(`<div class="alert alert-warning text-center">First Login To Continue
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="icon-close"></i></span>
                                </button>
                            </div>`);
                }
            });
            }
                // alert(cat_val);

            
        });

        
});

</script>
@endsection
