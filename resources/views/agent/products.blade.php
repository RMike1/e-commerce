@extends('agent.layouts.title')
@section('title','MK Dashboard')
@extends('agent.layouts.master')
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">MK</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Data</a></li>
                                <li class="breadcrumb-item active">Products</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Products</h4>
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
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="text-sm-end">
                        <div class="btn-group mb-3 ms-2 d-none d-sm-inline-block">
                            <h4>Categories: </h4>
                        </div>
                        <div class="btn-group mb-3 ms-1">
                            <a type="button" href="{{route('agent-products')}}" style="border-left: 1px #6c757d37 solid" class="btn btn-light">All</a>
                            @foreach (App\Models\Category::latest()->take(4)->get() as $category)
                            <a type="button" href="{{route('agent-products',['category'=>$category->name])}}" style="border-left: 1px #6c757d37 solid" class="btn btn-light">{{$category->name}} </a>
                            @endforeach
                        </div>
                    </div>
                </div><!-- end col-->
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                </div>
                                <div class="col-sm-8">
                                </div><!-- end col-->
                            </div>

                            <div class="table-responsive">
                                <table  class="table table-centered w-100 dt-responsive nowrap agent-products-datatable">

                                    <thead class="table-light">
                                        <tr>
                                            <th class="all" style="width: 20px;">
                                               #
                                            </th>
                                            <th class="all">Product</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                            <th style="width:120px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i=1;
                                        @endphp
                                        @forelse ($products as $product)
                                        <tr>
                                            <td>
                                                {{$i++}}.
                                            </td>
                                            <td>
                                                <img src="{{asset($product->product_image)}}" alt="contact-img" title="product-img" class="rounded me-3" height="48">
                                                <p class="m-0 d-inline-block align-middle font-16">
                                                    <a href="{{route('view.product',$product->id)}}" class="text-body">{{$product->product_name}}</a>
                                                </p>
                                            </td>
                                            <td>
                                                {{$product->category->name}}
                                            </td>
                                            <td>
                                                ${{number_format($product->product_price,2)}}
                                            </td>

                                            <td>
                                                {{$product->product_quantity}}
                                            </td>
                                            @if ($product->product_status=='0')
                                            <td>
                                                <span class="badge badge-warning-lighten">Out Of Stock</span>

                                            </td>
                                            @elseif ($product->product_status=='1')
                                            <td>
                                                <span class="badge badge-success-lighten">New</span>
                                            </td>
                                            @elseif ($product->product_status=='2')
                                            <td>
                                                <span class="badge badge-success-lighten">Top</span>
                                            </td>
                                            @else
                                            <td>
                                                <span class="badge badge-success-lighten">Available</span>
                                            </td>
                                            @endif

                                            <td class="table-action">
                                                <a href="{{route('view-product',$product->id)}}" title="View this product's details" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="customCheck2">
                                                        <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td colspan="8" class="text-center">
                                                    no products available!!
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->
       <!------------------adding category modal------------------->

       <div id="create-category-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Create Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form action="{{route('store.category')}}" method="post">
                @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                                <label for="category-title">Category Name</label>
                                <input type="text" class="form-control form-control-light" name="name" id="category-title" placeholder="Enter name">
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
      $(".agent-products-datatable").DataTable({keys:!0,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});var a=$("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","print"],language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});});
  </script>
@endsection
