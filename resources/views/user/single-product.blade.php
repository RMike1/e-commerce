@section('title','E-shop | Product')
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
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Default</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="product-details-top">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery product-gallery-vertical">
                                <div class="row">
                                    <figure class="product-main-image">
                                        <img id="product-zoom" src="{{asset($product->product_image)}}" data-zoom-image="{{asset($product->product_image)}}" alt="product image">
                                        <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                            <i class="icon-arrows"></i>
                                        </a>
                                    </figure><!-- End .product-main-image -->

                                    <div id="product-zoom-gallery" class="product-image-gallery">
                                        @if ($product->productimage)
                                            @foreach ($product->productimage as $imagepro)
                                            <a class="product-gallery-item" href="#" data-image="{{asset($imagepro->image)}}" data-zoom-image="{{asset($imagepro->image)}}">
                                                <img src="{{asset($imagepro->image)}}" alt="product side">
                                            </a>
                                            @endforeach
                                        @endif
                                    </div><!-- End .product-image-gallery -->
                                </div><!-- End .row -->
                            </div><!-- End .product-gallery -->
                        </div><!-- End .col-md-6 -->

                        <div class="col-md-6">
                            <div class="product-details">
                                <h1 class="product-title">{{$product->product_name}}</h1><!-- End .product-title -->

                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                                </div><!-- End .rating-container -->

                                <div class="product-price">
                                    @php
                                    $currency_value=App\Models\Currency::where('fr_use_status','1')->first();
                                    @endphp
                                    @if ($currency_value->code=='RWF')
                                    {{number_format($product->product_price/$currency_value->normal_val,2)}} Frw
                                    @else
                                    {{$currency_value->symbol}}{{number_format($product->product_price/$currency_value->normal_val,2)}}
                                    @endif
                                </div><!-- End .product-price -->
                                <div class="product-content">
                                    <p>{!!Str::limit($product->product_description,120)!!}</p>
                                </div><!-- End .product-content -->

                                <div class="details-filter-row details-row-size">
                                    <label>Color:</label>

                                    <div class="product-nav product-nav-thumbs">
                                        <a href="#" class="active">
                                            <img src="{{asset('user/assets/images/products/single/1-thumb.jpg')}}" alt="product desc">
                                        </a>
                                        <a href="#">
                                            <img src="{{asset('user/assets/images/products/single/2-thumb.jpg')}}" alt="product desc">
                                        </a>
                                    </div><!-- End .product-nav -->
                                </div><!-- End .details-filter-row -->

                                <div class="details-filter-row details-row-size">
                                    <label for="size">Size:</label>
                                    <div class="select-custom">
                                        <select name="size" id="size" class="form-control">
                                            <option value="#" selected="selected">Select a size</option>
                                            <option value="s">Small</option>
                                            <option value="m">Medium</option>
                                            <option value="l">Large</option>
                                            <option value="xl">Extra Large</option>
                                        </select>
                                    </div><!-- End .select-custom -->

                                    <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a>
                                </div><!-- End .details-filter-row -->
                                <div class="details-filter-row details-row-size">
                                    <label for="qty">Qty:</label>
                                    <div class="product-details-quantity">
                                        <input type="number" name="quantity" id="product_qty" class="form-control" value="1" min="1" step="1" data-decimals="0" required>
                                    </div><!-- End .product-details-quantity -->
                                </div><!-- End .details-filter-row -->
                                <div class="product-details-action">

                                    <a href="#" type="button" class="btn-product btn-cart" id="add-to-cart" data-ProductQty="{{$product->id}}" onclick="productId(this);event.preventDefault();" ><span class="btn-product-info">add to cart</span></a>
                                    <button id="prod_id_btn" value="{{$product->id}}" type="button" class="d-none"></button>


                                    <div class="details-action-wrapper">
                                        <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                        <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to Compare</span></a>
                                    </div><!-- End .details-action-wrapper -->
                                </div><!-- End .product-details-action -->

                                <div class="product-details-footer">
                                    <div class="product-cat">
                                        <span>Category:</span>
                                        <a href="#">{{$product->Category->name}}</a>
                                    </div><!-- End .product-cat -->
                                    <div class="social-icons social-icons-sm">
                                        <span class="social-label">Share:</span>

                                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                    </div>
                                </div><!-- End .product-details-footer -->
                            </div><!-- End .product-details -->
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->
                </div><!-- End .product-details-top -->

                <div class="product-details-tab">
                    <ul class="nav nav-pills justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews (2)</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                            <div class="product-desc-content">
                                <h3>Product Information</h3>

                                <p>{!!$product->product_description!!}</p>

                            </div><!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                            <div class="product-desc-content">
                                <h3>Information</h3>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. </p>

                                <h3>Fabric & care</h3>
                                <ul>
                                    <li>Faux suede fabric</li>
                                    <li>Gold tone metal hoop handles.</li>
                                    <li>RI branding</li>
                                    <li>Snake print trim interior </li>
                                    <li>Adjustable cross body strap</li>
                                    <li> Height: 31cm; Width: 32cm; Depth: 12cm; Handle Drop: 61cm</li>
                                </ul>

                                <h3>Size</h3>
                                <p>one size</p>
                            </div><!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                            <div class="product-desc-content">
                                <h3>Delivery & returns</h3>
                                <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br>
                                We hope you’ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
                            </div><!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                            <div class="reviews">
                                <h3>Reviews (2)</h3>
                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="#">Samanta J.</a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                                </div><!-- End .ratings -->
                                            </div><!-- End .rating-container -->
                                            <span class="review-date">6 days ago</span>
                                        </div><!-- End .col -->
                                        <div class="col">
                                            <h4>Good, perfect size</h4>

                                            <div class="review-content">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum dolores assumenda asperiores facilis porro reprehenderit animi culpa atque blanditiis commodi perspiciatis doloremque, possimus, explicabo, autem fugit beatae quae voluptas!</p>
                                            </div><!-- End .review-content -->

                                            <div class="review-action">
                                                <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                                <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                            </div><!-- End .review-action -->
                                        </div><!-- End .col-auto -->
                                    </div><!-- End .row -->
                                </div><!-- End .review -->

                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="#">John Doe</a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                                </div><!-- End .ratings -->
                                            </div><!-- End .rating-container -->
                                            <span class="review-date">5 days ago</span>
                                        </div><!-- End .col -->
                                        <div class="col">
                                            <h4>Very good</h4>

                                            <div class="review-content">
                                                <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum blanditiis laudantium iste amet. Cum non voluptate eos enim, ab cumque nam, modi, quas iure illum repellendus, blanditiis perspiciatis beatae!</p>
                                            </div><!-- End .review-content -->

                                            <div class="review-action">
                                                <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                                <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                            </div><!-- End .review-action -->
                                        </div><!-- End .col-auto -->
                                    </div><!-- End .row -->
                                </div><!-- End .review -->
                            </div><!-- End .reviews -->
                        </div><!-- .End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .product-details-tab -->

                <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->

              <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow append_related_product" data-toggle="owl"
                data-owl-options='{
                "nav": false,
                "dots": true,
                "margin": 20,
                "loop": false,
                "responsive": {
                    "0": {
                        "items":1
                    },
                    "480": {
                        "items":2
                    },
                    "768": {
                        "items":3
                    },
                    "992": {
                        "items":4
                    },
                    "1200": {
                        "items":4,
                        "nav": true,
                        "dots": false
                    }
                }
                }'
                >
                @include('user.includes.related_products');
                </div><!-- End .owl-carousel -->

            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->

<!-- Sticky Bar -->
<div class="sticky-bar">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <figure class="product-media">
                    <a href="{{route('user.product',$product->id)}}">
                        <img src="{{asset($product->product_image)}}" alt="Product image">
                    </a>
                </figure><!-- End .product-media -->
                <h4 class="product-title"><a href="{{route('user.product',$product->id)}}">{{$product->product_name}}</a></h4><!-- End .product-title -->
            </div><!-- End .col-6 -->

            <div class="col-6 justify-content-end">
                <div class="product-price">
                    @php
                    $currency_value=App\Models\Currency::where('fr_use_status','1')->first();
                    @endphp
                    @if ($currency_value->code=='RWF')
                    {{number_format($product->product_price/$currency_value->normal_val,2)}} Frw
                    @else
                    {{$currency_value->symbol}}{{number_format($product->product_price/$currency_value->normal_val,2)}}
                    @endif
                </div><!-- End .product-price -->
                <div class="product-details-quantity">

                    <input type="number" name="quantity_product" id="product_qty2" class="form-control" value="1" min="1" step="1" data-decimals="0" required>

                </div><!-- End .product-details-quantity -->
                <div class="product-details-action">

                    <a href="#" type="button" class="btn-product btn-cart" id="add-to-cart" data-ProductQty2="{{$product->id}}" onclick="productId2(this);event.preventDefault();" ><span class="btn-product-info2">add to cart</span></a>
                    <button id="prod_id_btn2" value="{{$product->id}}" type="button" class="d-none"></button>

                    <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                </div><!-- End .product-details-action -->
            </div><!-- End .col-6 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .sticky-bar -->

@include('user.layouts.sign-in')

@endsection
@section('scripts')
<!-- Plugins JS File -->
<script src="{{asset('user/assets/js/jquery.hoverIntent.min.js')}}"></script>
<script src="{{asset('user/assets/js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('user/assets/js/superfish.min.js')}}"></script>
<script src="{{asset('user/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('user/assets/js/bootstrap-input-spinner.js')}}"></script>
<script src="{{asset('user/assets/js/jquery.elevateZoom.min.js')}}"></script>
<script src="{{asset('user/assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('user/assets/js/toastr-plugin.js')}}"></script>
<script src="{{asset('user/assets/vendor/js/toastr.js')}}"></script>



<script>

    $(document).ready(function(){
        $(document).on('click', '.btn-product-data',function(e){
            e.preventDefault();
            var product_id=$(this).val();
            // alert(product_id)
            var quantity=1;
            $(this).find('.btn-product-info').text('adding..').append(`<div class="spinner-grow" role="status">
  <span class="visually-hidden"></span>
</div>`);
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
                $(".append-category-data").html(response.view);
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
</script>
<script>

 //========================adding item to cart ===============================


function productId(caller){

            var product_id=document.getElementById('prod_id_btn').value=$(caller).attr('data-ProductQty');
            var quantity=$('#product_qty').val();

            $('.btn-product-info').text('adding..').append(`<div class="spinner-grow" role="status"><span class="visually-hidden"></span></div>`);
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
                $(".append-category-data").html(response.view);
                $(".appendCartHeader").html(response.header);
                $('.btn-product-info').text('add to cart')
                $('#product_qty').val(1)

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
    }

 //========================adding item to cart on stick formr===============================

function productId2(caller2){

        var product_id=document.getElementById('prod_id_btn2').value=$(caller2).attr('data-ProductQty2');
        var quantity=$('#product_qty2').val();
        // alert(quantity);

        $('.btn-product-info2').text('adding..').append(`<div class="spinner-grow" role="status"><span class="visually-hidden"></span></div>`);
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
            $(".append-category-data").html(response.view);
            $(".appendCartHeader").html(response.header);
            $('.btn-product-info2').text('add to cart')
            $('#product_qty2').val(1)

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
}

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
                    // console.log(response);
                    // alert('success!!')
                    $(".appendCart").html(response.view);
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
                error:function(error)
                {
                    // alert('oops!!')
                    console.log(error);
                }
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

                    $(".appendCart").html(response.view);
                    $(".append_related_product").html(response.view);
                    $(".appendCartHeader").html(response.header);
                }
            });
        });

    });


</script>
@endsection
