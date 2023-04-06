@foreach ($related_products_data as $related_products)
<div class="col-6 col-md-4 col-lg-3">
            <div class="product product-7 text-center">
                <figure class="product-media">
                    @if ($related_products->product_status=='0')
                    <span class="product-label label-out">Out of Stock</span>
                    @elseif ($related_products->product_status=='1')
                    <span class="product-label label-new">New</span>
                    @elseif ($related_products->product_status=='2')
                    <span class="product-label label-top">Top</span>
                    @else
                    @endif

                      <a href="{{route('user.product',$related_products->id)}}">
                        <img src="{{asset($related_products->product_image)}}" alt="Product image" class="product-image">
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                    </div><!-- End .product-action-vertical -->

                    <div class="product-action">
                        <button type="button" value="{{$related_products->id}}" class="btn-product btn-cart btn-product-data border-0"><span class="btn-product-info">add to cart</span></button>
                    </div><!-- End .product-action -->

                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <span>{{$related_products->category->name}}</span>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="{{route('user.product',$related_products->id)}}">{{$related_products->product_name}}</a></h3><!-- End .product-title -->
                    <div class="product-price">
                        @php
                        $currency_value=App\Models\Currency::where('fr_use_status','1')->first();
                        @endphp
                        @if ($currency_value->code=='RWF')
                        {{number_format($related_products->product_price/$currency_value->normal_val,2)}} Frw
                        @else
                        {{$currency_value->symbol}}{{number_format($related_products->product_price/$currency_value->normal_val,2)}}
                        @endif
                        </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 2 Reviews )</span>
                    </div><!-- End .rating-container -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->
        </div><!-- End .col-sm-6 col-lg-4 -->
        @endforeach
