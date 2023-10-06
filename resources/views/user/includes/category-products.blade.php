<div class="row">
    <div class="col-lg-9">
        <div class="toolbox">
            <div class="toolbox-left">
                <div class="toolbox-info">
                    {{-- Showing <span>9 of 56</span> Products --}}
                </div><!-- End .toolbox-info -->
            </div><!-- End .toolbox-left -->

            <div class="toolbox-right">
                <div class="toolbox-sort">
                    <label for="sortby">Sort by:</label>
                    <div class="select-custom">
                        <select name="sortby" id="sortby" class="form-control sortby_products">
                            <option selected disabled>--sort by--</option>
                            <option value="product_price">Price</option>
                            <option value="created_at">Date</option>
                            <option value="product_name">Name</option>
                        </select>
                    </div>
                </div><!-- End .toolbox-sort -->
            </div><!-- End .toolbox-right -->
        </div><!-- End .toolbox -->

        <div class="products mb-3">
            <div class="row justify-content-center append-sort-category-product">
               @include('user.includes.sort-category')
            </div><!-- End .row -->
        </div><!-- End .products -->

      {{$products->links('user.layouts.products-pagination')}}

    </div><!-- End .col-lg-9 -->
    <aside class="col-lg-3 order-lg-first">
        <div class="sidebar sidebar-shop">
            <div class="widget widget-clean">
                <label>Filters:</label>
                <a href="#" class="sidebar-filter-clear">Clean All</a>
            </div><!-- End .widget widget-clean -->

            <div class="widget widget-collapsible">
                <h3 class="widget-title">
                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                        Category
                    </a>
                </h3><!-- End .widget-title -->

                <div class="collapse show" id="widget-1">
                    <div class="widget-body">
                        <div class="filter-items filter-items-count">
                            <div class="filter-item">
                                <div class="custom-control ">
                                    <button class="bg-transparent border-0 checkbox-category text-muted" value="all">
                                        All
                                        </button>
                                      </div><!-- End .custom-checkbox -->
                              </div><!-- End .filter-item -->
                          @foreach (App\Models\Category::all() as $category)
                          <div class="filter-item">
                              <div class="custom-control ">
                                    <button class="bg-transparent border-0 checkbox-category text-muted" value="{{$category->slug}}">
                                        {{$category->name}}
                                        </button>
                                </div><!-- End .custom-checkbox -->
                                <span class="item-count">{{$category->product->count()}}</span>
                        </div><!-- End .filter-item -->

                            @endforeach

                        </div><!-- End .filter-items -->
                    </div><!-- End .widget-body -->
                </div><!-- End .collapse -->
            </div><!-- End .widget -->
            <div class="widget widget-collapsible">
                <h3 class="widget-title">
                    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
                        Size
                    </a>
                </h3><!-- End .widget-title -->

                <div class="collapse show" id="widget-2">
                    <div class="widget-body">
                        <div class="filter-items">
                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="size-1">
                                    <label class="custom-control-label" for="size-1">XS</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->

                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="size-2">
                                    <label class="custom-control-label" for="size-2">S</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->

                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" checked id="size-3">
                                    <label class="custom-control-label" for="size-3">M</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->

                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" checked id="size-4">
                                    <label class="custom-control-label" for="size-4">L</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->

                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="size-5">
                                    <label class="custom-control-label" for="size-5">XL</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->

                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="size-6">
                                    <label class="custom-control-label" for="size-6">XXL</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->
                        </div><!-- End .filter-items -->
                    </div><!-- End .widget-body -->
                </div><!-- End .collapse -->
            </div><!-- End .widget -->
            <div class="widget widget-collapsible">
                <h3 class="widget-title">
                    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="false" aria-controls="widget-4">
                        Brand
                    </a>
                </h3><!-- End .widget-title -->

                <div class="collapse false" id="widget-4">
                    <div class="widget-body">
                        <div class="filter-items">
                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brand-1">
                                    <label class="custom-control-label" for="brand-1">Next</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->

                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brand-2">
                                    <label class="custom-control-label" for="brand-2">River Island</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->

                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brand-3">
                                    <label class="custom-control-label" for="brand-3">Geox</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->

                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brand-4">
                                    <label class="custom-control-label" for="brand-4">New Balance</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->

                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brand-5">
                                    <label class="custom-control-label" for="brand-5">UGG</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->

                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brand-6">
                                    <label class="custom-control-label" for="brand-6">F&F</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->

                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brand-7">
                                    <label class="custom-control-label" for="brand-7">Nike</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->

                        </div><!-- End .filter-items -->
                    </div><!-- End .widget-body -->
                </div><!-- End .collapse -->
            </div><!-- End .widget -->


        </div><!-- End .sidebar sidebar-shop -->
    </aside><!-- End .col-lg-3 -->
</div><!-- End .row -->
