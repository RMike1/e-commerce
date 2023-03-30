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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table  class="table table-centered w-100 dt-responsive nowrap orders-datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>Order ID/No</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total_Amount</th>
                                    <th>Payment_Status</th>
                                    <th>Payment_Method</th>
                                    <th style="width: 85px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count=1;
                                @endphp
                                @foreach($orders as $order)
                                <tr>
                                     <td>
                                       {{$count++}} 
                                    </td>
                                     <td>
                                       #{{$order->order_id}}

                                    </td>
                                    <td>
                                        <img src="{{asset($order->product_image)}}" alt="contact-img" title="product-img" class="rounded me-3" height="48">
                                        <p class="m-0 d-inline-block align-middle font-16">
                                            <a href="{{route('view.product',$order->id)}}" class="text-body">{{$order->product_name}}</a>
                                        </p>
                                    </td>
                                    <td>
                                        ${{number_format($order->product_price,2)}}
                                    </td>
                                    <td>
                                    {{$order->orderQty}}
                                    </td>
                                    <td>
                                        ${{number_format($order->orderTot,2)}}
                                    </td>
                                    @if($order->payment_status=='pending')
                                    <td>
                                        <h5><span class="badge badge-warning-lighten">Pending..</span></h5>
                                    </td>
                                    @else
                                    <td>
                                        <h5><span class="badge badge-success-lighten">Delivered</span></h5>
                                    </td>
                                    @endif
                                    <td>
                                        {{$order->payment_method}}
                                    </td>
                                    <td class="table-action">
                                        <a  class="action-icon" href="{{route('view.order',$order->id)}}"><i title="view this order" class="mdi mdi-eye-outline"></i></a>
                                        <a  class="action-icon" onclick="return confirm('are u sure to cancel this category?')"> <i class="mdi mdi-cancel" title="cancel this order"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row-->


    
    </div>
</div> <!-- container -->

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
