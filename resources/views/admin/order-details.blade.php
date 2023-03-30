@extends('admin.layouts.title')
@section('title','MK')
@extends('admin.layouts.master')
@section('styles')
    <link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{asset('admin/assets/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="dark-style">
    <link href="{{asset('admin/assets/css/vendor/dataTables.bootstrap5.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/vendor/responsive.bootstrap5.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/vendor/select.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/assets/css/vendor/buttons.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
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
                        <li class="breadcrumb-item"><a href="{{route('home')}}">E-shop</a></li>
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Data</a></li>
                        <li class="breadcrumb-item active">Order</li>
                    </ol>
                </div>
                <h4 class="page-title">Order</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

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


    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10 col-sm-11">

            <div class="horizontal-steps mt-4 mb-4 pb-5" id="tooltip-container">
                <div class="horizontal-steps-content">
                    <div class="step-item">
                        <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$shipping_delivery_info->created_at}}">Order Placed</span>
                    </div>
                    <div class="step-item current">
                        <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom">Packed</span>
                    </div>
                    <div class="step-item">
                        <span>Shipped</span>
                    </div>
                    <div class="step-item">
                        <span>Delivered</span>
                    </div>
                </div>

                <div class="process-line" style="width: 33%;"></div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <a href="{{route('download.invoice',$order->id)}}" class="btn btn-secondary"><i class="mdi mdi-download me-1"></i>Download Invoice</a>
    <a href="{{route('view.invoice',$order->id)}}" class="btn btn-secondary"><i class="mdi mdi-eye me-1"></i>View Invoice</a>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Items from Order Tracking N<sup>o</sup> [{{$tracking_no}}]</h4>

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                            <tr>
                                <td>{{$order->product_name}}</td>
                                <td>{{$order->orderQty}}</td>
                                <td>${{number_format($order->product_price,2)}}</td>
                                <td>${{number_format($order->orderTot,2)}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->

                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Order Summary</h4>

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>Description</th>
                                <th>Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Total :</td>
                                <td>${{number_format($subtotcart,2)}}</td>
                            </tr>
                            <tr>
                                <td>Shipping Charge:</td>
                                <td>${{$shipping_val}} <span>({{$shipping_method}})</span></td>
                            </tr>
                            <tr>
                                <th>Grand Total :</th>
                                <th>${{number_format($final_tot,2)}}</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->

                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Shipping Information</h4>

                    <h5>{{$shipping_info->first_name}} {{$shipping_info->second_name}}</h5>

                    <address class="mb-0 font-14 address-lg">
                        {{$shipping_info->street}}, <br>
                        {{$shipping_info->state}}, {{$shipping_info->town}}<br>
                        <abbr title="Phone">P:</abbr> {{$shipping_info->phone}} <br>
                        <abbr title="Email">E:</abbr> {{$shipping_info->email}} <br>
                    </address>

                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Billing Information</h4>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <p class="mb-2"><span class="fw-bold me-2">Payment Type:</span> {{$billing_info->payment_method}}</p>
                            <p class="mb-2"><span class="fw-bold me-2">Valid Date:</span> 02/2020</p>
                            <p class="mb-0"><span class="fw-bold me-2">CVV:</span> xxx</p>
                        </li>
                    </ul>

                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3 text-center">Delivery Info</h4>

                    <div class="text-center">
                        <i class="mdi mdi-truck-fast h2 text-muted"></i>
                        <h5><b>UPS Delivery</b></h5>
                        <p class="mb-1"><b>Order ID :</b> {{$delivery_info->order_id}}</p>
                        <p class="mb-0"><b>Payment Mode :</b>  {{$delivery_info->payment_method}}</p>
                        <p class="mb-0"><b>Payment Status :</b>  {{$delivery_info->payment_status}}</p>
                        <p class="mb-0"><b>Shipping Method :</b>  {{$delivery_info->shipping_method}}</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->


</div> <!-- container -->

</div> <!-- content -->


@endsection
@section('scripts')

    <script src="{{asset('admin/assets/js/pages/demo.dashboard.js')}}"></script>
      <!-- third party js -->
      <script src="{{asset('admin/assets/js/vendor/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('admin/assets/js/vendor/dataTables.bootstrap5.js')}}"></script>
      <script src="{{asset('admin/assets/js/vendor/dataTables.responsive.min.js')}}"></script>
      <script src="{{asset('admin/assets/js/vendor/responsive.bootstrap5.min.js')}}"></script>
      <script src="{{asset('admin/assets/js/vendor/dataTables.checkboxes.min.js')}}"></script>
      <script src="{{asset('admin/assets/js/vendor/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendor/buttons.bootstrap5.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendor/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendor/buttons.flash.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendor/buttons.print.min.js')}}"></script>

      <!-- Datatables js -->

      <!-- Datatable Init js -->
      <script src="{{asset('admin/assets/js/pages/demo.datatable-init.js')}}"></script>

        <script>
            $(document).ready(function(){"use strict";
            $(".orders-datatable").DataTable({keys:!0,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});var a=$("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","print"],language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});});
        </script>


@endsection
