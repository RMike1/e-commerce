<div class="heading heading-center mb-6">
    <h2 class="title">Recent Arrivals</h2><!-- End .title -->

    <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab" role="tab" aria-controls="top-all-tab" aria-selected="true">All</a>
        </li>
        @foreach ($categories as $category)
        <li class="nav-item">
            <a class="nav-link" id="{{$category->slug}}-link" data-toggle="tab" href="#{{$category->slug}}" role="tab" aria-controls="{{$category->slug}}" aria-selected="false">{{$category->name}}</a>
        </li>
        @endforeach
    </ul>
</div><!-- End .heading -->

<div class="tab-content">
    <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
        <div class="products">
            <div class="row justify-content-center">
                @foreach ($products->where('product_status','!=','0') as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product product-11 mt-v3 text-center">
                        <figure class="product-media">
                            @if ($product->product_status=='1')
                            <span class="product-label label-new">New</span>
                            @elseif ($product->product_status=='2')
                            <span class="product-label label-top">Top</span>
                            @elseif ($product->product_status=='0')
                            <span class="product-label label-out">Out of Stcok</span>
                            @else
                            @endif
                            <a href="product.html">
                                <img src="{{asset($product->product_image)}}" alt="Product image" class="product-image">
                                @if ($product->ProductImage)
                                @foreach ($product->ProductImage as $product_related_image)
                                <img src="{{asset($product_related_image->image)}}" alt="Product image" class="product-image-hover">
                                @endforeach
                                @endif
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                            </div><!-- End .product-action-vertical -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <h3 class="product-title"><a href="product.html">{{$product->product_name}}</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                ${{number_format($product->product_price,2)}}
                            </div><!-- End .product-price -->
                        </div><!-- End .product-body -->
                        <div class="product-action">
                            <button href="#" value="{{$product->id}}" class="btn-product btn-cart add-cart-btn"><span class="btn-product-info">add to cart</span></button>

                        </div><!-- End .product-action -->
                    </div><!-- End .product -->
                </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
                @endforeach
            </div><!-- End .row -->
        </div><!-- End .products -->
    </div><!-- .End .tab-pane -->
    @foreach ($categories as $category)
    <div class="tab-pane p-0 fade" id="{{$category->slug}}" role="tabpanel" aria-labelledby="{{$category->slug}}-link">
        <div class="products">
            <div class="row justify-content-center">
                @if ($category->product)
                @foreach ($category->product->where('product_status','!=','0') as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product product-11 mt-v3 text-center">
                        <figure class="product-media">
                            @if ($product->product_status=='1')
                            <span class="product-label label-new">New</span>
                            @elseif ($product->product_status=='2')
                            <span class="product-label label-top">Top</span>
                            @elseif ($product->product_status=='0')
                            <span class="product-label label-out">Out of Stcok</span>
                            @else
                            @endif
                            <a href="product.html">
                                <img src="{{asset($product->product_image)}}" alt="Product image" class="product-image">
                                @if ($product->ProductImage)
                                @foreach ($product->ProductImage as $product_related_image)
                                <img src="{{asset($product_related_image->image)}}" alt="Product image" class="product-image-hover">
                                @endforeach
                                @endif
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                            </div><!-- End .product-action-vertical -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <h3 class="product-title"><a href="product.html">{{$product->product_name}}</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                ${{number_format($product->product_price,2)}}
                            </div><!-- End .product-price -->
                        </div><!-- End .product-body -->
                        <div class="product-action">
                            <button href="#" value="{{$product->id}}" class="btn-product btn-cart add-cart-btn"><span class="btn-product-info">add to cart</span></button>
                        </div><!-- End .product-action -->
                    </div><!-- End .product -->
                </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
                @endforeach
                @endif

            </div><!-- End .row -->
        </div><!-- End .products -->
    </div><!-- .End .tab-pane -->
    @endforeach
</div><!-- End .tab-content -->