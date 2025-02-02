@extends('user.layouts.master')

@section('content')

@include('user.layouts.header')

 <main class="main">

    <div class="intro-section bg-lighter pt-5 pb-6">

                <div class="container">

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="intro-slider-container slider-container-ratio slider-container-1 mb-2 mb-lg-0">
                                <div class="intro-slider intro-slider-1 owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl" data-owl-options='{
                                        "nav": false,
                                        "responsive": {
                                            "768": {
                                                "nav": true
                                            }
                                        }
                                    }'>

                                    @foreach ($slide_products as $product)

                                    <div class="intro-slide">
                                        <figure class="slide-image">
                                            <picture>
                                                <source media="(max-width: 480px)" srcset="{{asset($product->product_image)}}">
                                                <img src="{{asset($product->product_image)}}" alt="Image2 Test">
                                            </picture>
                                        </figure><!-- End .slide-image -->

                                        <div class="intro-content">
                                            <h3 class="intro-subtitle">{{$product->Category->name}}</h3><!-- End .h3 intro-subtitle -->
                                            <h1 class="intro-title">{{$product->product_name}}</h1><!-- End .intro-title -->

                                            <a href="{{route('user.product',$product->id)}}" class="btn btn-outline-white">
                                                <span>SHOP NOW</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </a>
                                        </div><!-- End .intro-content -->
                                    </div><!-- End .intro-slide -->

                                    @endforeach

                                </div><!-- End .intro-slider owl-carousel owl-simple -->

                                <span class="slider-loader"></span><!-- End .slider-loader -->
                            </div><!-- End .intro-slider-container -->
                        </div><!-- End .col-lg-8 -->
                        <div class="col-lg-4">
                            <div class="intro-banners">
                                <div class="row row-sm">
                                    @foreach (App\Models\Product::where('product_publish','1')->where('product_status','2')->latest()->take(1)->get() as $best_product)
                                    <div class="col-md-6 col-lg-12">
                                        <div class="banner banner-display">
                                            <a href="#">
                                                <img src="{{asset($best_product->product_image)}}" alt="Banner">
                                            </a>

                                            <div class="banner-content">
                                                <h4 class="banner-subtitle text-darkwhite"><a href="#">Clearence</a></h4><!-- End .banner-subtitle -->
                                                <h3 class="banner-title text-white"><a href="#"> {{$best_product->product_name}} <br>Up to 40% off</a></h3><!-- End .banner-title -->
                                                <a href="{{route('user.product',$best_product->id)}}" class="btn btn-outline-white banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                                            </div><!-- End .banner-content -->
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-md-6 col-lg-12 -->
                                    @endforeach

                                    @foreach (App\Models\Category::where('category_status','1')->latest()->take(1)->get() as $best_category)
                                        {{-- {{dump($best_category)}} --}}
                                        <div class="col-md-6 col-lg-12">
                                            <div class="banner banner-display mb-0">
                                            <a href="#">
                                                <img src="{{asset($best_category->category_image)}}" alt="Banner">
                                            </a>

                                            <div class="banner-content">
                                                <h4 class="banner-subtitle text-darkwhite"><a href="#">New in</a></h4><!-- End .banner-subtitle -->
                                                <h3 class="banner-title text-white"><a href="#">Best {{$best_category->name}} <br>Collection</a></h3><!-- End .banner-title -->
                                                <a href="#" onclick="event.preventDefault();document.getElementById('best_cat').submit()" class="btn btn-outline-white banner-link">Discover Now<i class="icon-long-arrow-right"></i></a>

                                                <form action="{{route('product.category')}}" id="best_cat" method="post" class="d-none">
                                                    @csrf
                                                    <input type="hidden" name="category_val" value="{{$best_category->name}}">
                                                </form>

                                            </div><!-- End .banner-content -->
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-md-6 col-lg-12 -->
                                    @endforeach
                                </div><!-- End .row row-sm -->
                            </div><!-- End .intro-banners -->
                        </div><!-- End .col-lg-4 -->
                    </div><!-- End .row -->

                    <div class="mb-6"></div><!-- End .mb-6 -->

                </div><!-- End .container -->
            </div><!-- End .bg-lighter -->

            <div class="mb-6"></div><!-- End .mb-6 -->


    		<div class="container categories pt-6">
        		<h2 class="title-lg text-center mb-4">Shop by Categories</h2><!-- End .title-lg text-center -->

        		<div class="row">
                    @foreach (App\Models\Category::where('category_position','left')->where('category_status','1')->get() as $left_category)
        			<div class="col-6 col-lg-4">
        				<div class="banner banner-display banner-link-anim">
                			<a href="#">
                				<img src="{{asset($left_category->category_image)}}" alt="Banner">
                			</a>
                			<div class="banner-content banner-content-center">
                				<h3 class="banner-title text-white"><a href="#">{{$left_category->name}}</a></h3><!-- End .banner-title -->
                				<a href="#" onclick="event.preventDefault();document.getElementById('left_cat').submit()" class="btn btn-outline-white banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                                <form action="{{route('product.category')}}" id="left_cat" method="post" class="d-none">
                                    @csrf
                                    <input type="hidden" name="category_val" value="{{$left_category->name}}">
                                </form>
                			</div><!-- End .banner-content -->
            			</div><!-- End .banner -->
        			</div><!-- End .col-sm-6 col-lg-3 -->
                    @endforeach
                    @foreach (App\Models\Category::where('category_position','right')->where('category_status','1')->get() as $right_category)
        			<div class="col-6 col-lg-4 order-lg-last">
        				<div class="banner banner-display banner-link-anim">
                			<a href="#">
                				<img src="{{asset($right_category->category_image)}}" alt="Banner">
                			</a>
                			<div class="banner-content banner-content-center">
                				<h3 class="banner-title text-white"><a href="#">{{$right_category->name}}</a></h3><!-- End .banner-title -->
                				<a href="#" onclick="event.preventDefault();document.getElementById('right_cat').submit()" class="btn btn-outline-white banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                                <form action="{{route('product.category')}}" id="right_cat" method="post" class="d-none">
                                    @csrf
                                    <input type="hidden" name="category_val" value="{{$right_category->name}}">
                                </form>
                			</div><!-- End .banner-content -->
            			</div><!-- End .banner -->
        			</div><!-- End .col-sm-6 col-lg-3 -->
                    @endforeach
                    @foreach (App\Models\Category::where('category_position','up')->where('category_status','1')->get() as $up_category)
        			<div class="col-sm-12 col-lg-4 banners-sm">
                        <div class="row">
            				<div class="banner banner-display banner-link-anim col-lg-12 col-6">
                    			<a href="#">
                    				<img src="{{asset($up_category->category_image)}}" alt="Banner">
                    			</a>

                    			<div class="banner-content banner-content-center">
                    				<h3 class="banner-title text-white"><a href="#">{{$up_category->name}}</a></h3><!-- End .banner-title -->
                    				<a href="#" onclick="event.preventDefault();document.getElementById('up_cat').submit()" class="btn btn-outline-white banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                                    <form action="{{route('product.category')}}" id="up_cat" method="post" class="d-none">
                                        @csrf
                                        <input type="hidden" name="category_val" value="{{$up_category->name}}">
                                    </form>
                    			</div><!-- End .banner-content -->
                			</div><!-- End .banner -->
                            @endforeach
                            @foreach (App\Models\Category::where('category_position','down')->where('category_status','1')->get() as $down_category)
                			<div class="banner banner-display banner-link-anim col-lg-12 col-6">
                    			<a href="#">
                    				<img src="{{asset($down_category->category_image)}}" alt="Banner">
                    			</a>

                    			<div class="banner-content banner-content-center">
                    				<h3 class="banner-title text-white"><a href="#">{{$down_category->name}}</a></h3><!-- End .banner-title -->
                    				<a href="#" onclick="event.preventDefault();document.getElementById('down_cat').submit()" class="btn btn-outline-white banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                                    <form action="{{route('product.category')}}" id="down_cat" method="post" class="d-none">
                                        @csrf
                                        <input type="hidden" name="category_val" value="{{$down_category->name}}">
                                    </form>
                    			</div><!-- End .banner-content -->
                			</div><!-- End .banner -->
                            @endforeach
                        </div>
        			</div><!-- End .col-sm-6 col-lg-3 -->
        		</div><!-- End .row -->
    		</div><!-- End .container -->

            <div class="mb-5"></div><!-- End .mb-6 -->


            <div class="container">
                <div class="appendIndex-Load-more">
                    @include('user.includes.load-more')
                </div>

                <div class="more-container text-center">
                    <button href="#" class="btn btn-outline-darker btn-more load-more"><span class="append-load">Load more products</span>
                        <i class="icon-long-arrow-down load-icon"></i>
                    </button>
                </div><!-- End .more-container -->
            </div><!-- End .container -->

            <div class="container">
                <hr>
            	<div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-6">
                        <div class="icon-box icon-box-card text-center">
                            <span class="icon-box-icon">
                                <i class="icon-rocket"></i>
                            </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Payment & Delivery</h3><!-- End .icon-box-title -->
                                <p>Free shipping for orders over $50</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-lg-4 col-sm-6 -->

                    <div class="col-lg-4 col-sm-6">
                        <div class="icon-box icon-box-card text-center">
                            <span class="icon-box-icon">
                                <i class="icon-rotate-left"></i>
                            </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Return & Refund</h3><!-- End .icon-box-title -->
                                <p>Free 100% money back guarantee</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-lg-4 col-sm-6 -->

                    <div class="col-lg-4 col-sm-6">
                        <div class="icon-box icon-box-card text-center">
                            <span class="icon-box-icon">
                                <i class="icon-life-ring"></i>
                            </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Quality Support</h3><!-- End .icon-box-title -->
                                <p>Alway online feedback 24/7</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-lg-4 col-sm-6 -->
                </div><!-- End .row -->

                <div class="mb-2"></div><!-- End .mb-2 -->
            </div><!-- End .container -->
            @guest
            <div class="cta cta-display bg-image pt-4 pb-4" style="background-image: url({{asset('user/assets/images/backgrounds/cta/bg-6.jpg')}});">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-9 col-xl-8">
                            <div class="row no-gutters flex-column flex-sm-row align-items-sm-center">
                                <div class="col">
                                    <h3 class="cta-title text-white">Sign Up & Get 10% Off</h3><!-- End .cta-title -->
                                    <p class="cta-desc text-white">MK Store presents the best in interior design</p><!-- End .cta-desc -->
                                </div><!-- End .col -->

                                <div class="col-auto">
                                    <a href="{{route('register')}}" class="btn btn-outline-white"><span>SIGN UP</span><i class="icon-long-arrow-right"></i></a>
                                </div><!-- End .col-auto -->
                            </div><!-- End .row no-gutters -->
                        </div><!-- End .col-md-10 col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .cta -->
            @endguest
        </main><!-- End .main -->

@include('user.layouts.sign-in')

@endsection
@section('scripts')
<script>


     //========================remove items from cart header===============================

 $(document).ready(function(){
        $(document).on('click', '.remove-cart-btn', function(e){
            e.preventDefault();
            if(confirm("remove this item?"))
            {
            var cart_id=$(this).val();
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

                    toastr.warning(response.warning,{
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
            });
            }
            else{
                return false;
            }
        });

     //==============================add items to cart on index page===============================

        $(document).on('click','.add-cart-btn', function(e){
            e.preventDefault();
            var product_id=$(this).val();
            var quantity=1;
            $(this).find('.btn-product-info').text('adding..').append(`<div class="spinner-grow" role="status"><span class="visually-hidden"></span></div>`);
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
                if(response.status=='200'){

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
                }
                else{
                    $('.btn-product-info').text('add to cart');
                    $('#signin-modal').modal('show');
                        $('.login-auth').append(`<div class="alert alert-warning text-center">`+response.warning_message+`
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="icon-close"></i></span>
                            </button>
                        </div>`);
                }
            }
            });
        });

     //==============================Load more products===============================

        $(document).on('click','.load-more', function(e){
            e.preventDefault();

            $('.load-icon').removeClass('icon-long-arrow-down');
            $('.load-icon').text("...");

            $.ajax({
                url:"{{route('load.more')}}",
                type:"get",
                dataType:"json",
                success:function(response)
                {
                    $('.appendIndex-Load-more').html(response.view);
                    $('.load-icon').addClass('icon-long-arrow-up');
                    $('.load-more').addClass('less-product');
                    $('.btn-outline-darker').removeClass('load-more');
                    $('.load-icon').text("");
                    $('.append-load').text("Less Products");
                },
            });
        });

     //==============================Less products===============================

        $(document).on('click','.less-product', function(e){
            e.preventDefault();

            $('.load-icon').removeClass('icon-long-arrow-up');
            $('.load-icon').text("...");
            $('.btn-outline-darker').addClass('load-more');

            $.ajax({
                url:"{{route('less.product')}}",
                type:"get",
                dataType:"json",
                success:function(response)
                {
                    $('.appendIndex-Load-more').html(response.view);
                    $('.load-icon').addClass('icon-long-arrow-down');
                    $('.btn-outline-darker').addClass('load-more');
                    $('.btn-outline-darker').removeClass('less-product');
                    $('.load-icon').text("");
                    $('.append-load').text("Load more products");
                },
            });
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
                url:"{{route('change.currency_h')}}",
                type:"get",
                dataType:"json",
                success:function(response){

                    if(response.status=='200'){
                        $('.appendIndex-Load-more').html(response.view);
                        $(".appendCartHeader").html(response.header);
                        $("#currency").text(response.new_currency);

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
                },
            });
        });
    })
</script>
@endsection
