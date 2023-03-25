@forelse ($products as $product)
    
                    
<div class="col-6 col-md-4 col-lg-4">
    <div class="product product-7 text-center">
        <figure class="product-media">
            @if ($product->product_status=='0')
            <span class="product-label label-out">Out Of Stock</span>
            @elseif ($product->product_status=='1')
            <span class="product-label label-new">New</span>
            @elseif ($product->product_status=='2')
            <span class="product-label label-top">Top</span>
            @else
            @endif
            <a href="{{route('user.product',$product->id)}}">
                <img src="{{asset($product->product_image)}}"  alt="Product image" class="product-image">
            </a>

            <div class="product-action-vertical">
                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
            </div><!-- End .product-action-vertical -->
            {{-- <form action="{{route('add.cart')}}" method="post">
                @csrf --}}
            <div class="product-action">
                <input type="hidden" value="{{$product->id}}"  name="product_id">
                <input type="hidden" value="1" name="quantity">
                <button type="button" class="btn-product btn-cart btn-product-data border-0" value="{{$product->id}}"><span class="btn-product-info">add to cart</span></button>
            </div><!-- End .product-action -->
            {{-- </form> --}}
        </figure><!-- End .product-media -->

        <div class="product-body">
            <div class="product-cat">
                <span>{{$product->Category->name}}</span>
            </div><!-- End .product-cat -->
            <h3 class="product-title"><a href="{{route('user.product',$product->id)}}">{{$product->product_name}}</a></h3><!-- End .product-title -->
            <div class="product-price">
                ${{number_format($product->product_price,2)}}
            </div><!-- End .product-price -->
            <div class="ratings-container">
                <div class="ratings">
                    <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                </div><!-- End .ratings -->
                <span class="ratings-text">( 2 Reviews )</span>
            </div><!-- End .rating-container -->

            <div class="product-nav product-nav-thumbs">
            </div><!-- End .product-nav -->
        </div><!-- End .product-body -->
    </div><!-- End .product -->
</div><!-- End .col-sm-6 col-lg-4 -->

@empty
<div class="col-6 col-md-4 col-lg-4">
    <div class="product product-7 text-center">
<h4 class="text-muted">
    no product found!!
</h4>
</div>
</div>

@endforelse 
