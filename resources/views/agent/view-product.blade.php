@extends('agent.layouts.title')
@section('title','MK Agent')
@extends('agent.layouts.master')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">MK</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">products</a></li>
                            <li class="breadcrumb-item active">Product Details</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Product Details</h4>
                </div>
            </div>
        </div>
        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{Session::get('success')}}
        </div>
        @elseif(Session::has('warning'))
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{Session::get('warning')}}
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            @foreach ($errors->all() as $error)
                <ul>
                    <li>
                        {{$error}}
                    </li>
                </ul>
            @endforeach
        </div>
        @endif

        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end">
                            <a href="{{route('agent-products')}}" class="btn btn-sm btn-secondary"><i class="mdi mdi-keyboard-return me-1"></i>Back</a>
                        </div>
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
                                    <h3 class="mt-0">{{$product->product_name}}</h3>
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
                                        </div>
                                    </div>

                                </form>
                            </div> <!-- end col -->
                        </div> <!-- end row-->


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
