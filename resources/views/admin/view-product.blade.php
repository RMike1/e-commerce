@extends('admin.layouts.title')
@section('title','MK Dashboard')
@extends('admin.layouts.master')
@section('styles')
    <link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{asset('admin/assets/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="dark-style">

    <link href="{{asset('admin/assets/css/vendor/dataTables.bootstrap5.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/vendor/responsive.bootstrap5.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')


    <!-- Start Content-->
    <div class="container-fluid">
                        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">E-shop</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">products</a></li>
                            <li class="breadcrumb-item active">Product Details</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Product Details</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5">
                                <!-- Product image -->
                                <a href="javascript: void(0);" class="text-center d-block mb-4">
                                    <img src="{{asset($product->product_image)}}" class="img-fluid" style="max-width: 280px;" alt="Product-img">
                                </a>

                                <div class="d-lg-flex d-none justify-content-center">
                                    @if ($product->ProductImage)
                                    @foreach ($product->ProductImage as $related_image)
                                    <a href="javascript: void(0);">
                                        <img src="{{asset($related_image->image)}}" class="img-fluid img-thumbnail p-2" style="max-width: 75px;" alt="Product-img">
                                    </a>
                                    @endforeach
                                    @endif
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-7">
                                <form class="ps-lg-4">
                                    <!-- Product title -->
                                    <h3 class="mt-0">{{$product->product_name}}<a href="{{route('edit.product',$product->id)}}" class="text-muted"><i class="mdi mdi-square-edit-outline ms-2"></i></a> </h3>
                                  @if ($product->created_at)
                                  <p class="mb-1">{{$product->created_at->format('d-m-Y')}} at {{$product->created_at->diffForHumans()}}</p>
                                  @else
                                      <p><script>document.write(new Date().getDate())</script>-<script>document.write(new Date().getMonth()+1)</script>-<script>document.write(new Date().getFullYear())</script></p>
                                  @endif

                                    <!-- Product stock -->
                                    <div class="mt-3">
                                        @if ($product->product_status=='0')
                                        <h4><span class="badge badge-warning-lighten">Out of Stock</span></h4>
                                        @elseif ($product->product_status=='1')
                                        <h4><span class="badge badge-success-lighten">New</span></h4>
                                        @elseif ($product->product_status=='2')
                                        <h4><span class="badge badge-success-lighten">Top</span></h4>
                                        @else
                                        <h4><span class="badge badge-success-lighten">Available</span></h4>
                                        @endif
                                    </div>

                                    <!-- Product description -->
                                    <div class="mt-4">
                                        <h6 class="font-14">Retail Price:</h6>
                                        <h3> ${{number_format($product->product_price,2)}}</h3>
                                    </div>

                                    <!-- Product description -->
                                    <div class="mt-4">
                                        <h6 class="font-14">Description:</h6>
                                        <p>{!!$product->product_description!!}</p>
                                    </div>

                                    <!-- Product information -->
                                    <div class="mt-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h6 class="font-14">Available Stock:</h6>
                                                <p class="text-sm lh-150">{{$available_product}}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="font-14">Number of Orders:</h6>
                                                <p class="text-sm lh-150">5,458</p>
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="font-14">Revenue:</h6>
                                                <p class="text-sm lh-150">$8,57,014</p>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div> <!-- end col -->
                        </div> <!-- end row-->

                        <div class="table-responsive mt-4">
                            <table class="table table-bordered table-centered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Outlets</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>ASOS Ridley Outlet - NYC</td>
                                        <td>$139.58</td>
                                        <td>
                                            <div class="progress-w-percent mb-0">
                                                <span class="progress-value">478 </span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 56%;" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$1,89,547</td>
                                    </tr>
                                    <tr>
                                        <td>Marco Outlet - SRT</td>
                                        <td>$149.99</td>
                                        <td>
                                            <div class="progress-w-percent mb-0">
                                                <span class="progress-value">73 </span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 16%;" aria-valuenow="16" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$87,245</td>
                                    </tr>
                                    <tr>
                                        <td>Chairtest Outlet - HY</td>
                                        <td>$135.87</td>
                                        <td>
                                            <div class="progress-w-percent mb-0">
                                                <span class="progress-value">781 </span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 72%;" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$5,87,478</td>
                                    </tr>
                                    <tr>
                                        <td>Nworld Group - India</td>
                                        <td>$159.89</td>
                                        <td>
                                            <div class="progress-w-percent mb-0">
                                                <span class="progress-value">815 </span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 89%;" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$55,781</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                        
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->
        
    </div> <!-- container -->


@endsection
@section('scripts')
    <script src="{{asset('admin/assets/js/vendor.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/app.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/pages/demo.dashboard.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendor/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendor/dataTables.bootstrap5.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendor/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendor/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendor/dataTables.checkboxes.min.js')}}"></script>

    <script src="{{asset('admin/assets/js/pages/demo.products.js')}}"></script>

@endsection