@extends('admin.layouts.title')
@section('title','MK Dashboard')
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">MK</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">eCommerce</a></li>
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
                        <div class="btn-group mb-3 ms-1">
                            <a type="button" href="{{route('products')}}" style="border-left: 1px #6c757d37 solid" class="btn btn-light">All</a>
                            @foreach (App\Models\Category::latest()->take(4)->get() as $category)
                            <a type="button" href="{{route('products',['category'=>$category->name])}}" style="border-left: 1px #6c757d37 solid" class="btn btn-light">{{$category->name}} </a>
                            @endforeach
                        </div>
                        <div class="btn-group mb-3 ms-2 d-none d-sm-inline-block">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#create-category-modal"><i class="mdi mdi-plus-circle me-1"></i>Category</button>
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
                                    <a href="{{route('add.product')}}" class="btn btn-secondary mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add Products</a>
                                </div>
                                <div class="col-sm-8">
                                    <div class="text-sm-end">
                                    </div>
                                </div><!-- end col-->
                            </div>

                            <div class="table-responsive">
                                <table  class="table table-centered w-100 dt-responsive nowrap products-datatable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>
                                                #
                                            </th>
                                            <th class="all">Product</th>
                                            <th>Category</th>
                                            <th>Added Date</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                            <th>Publish Status</th>
                                            <th style="width: 85px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $count=1;
                                        @endphp
                                        @forelse ($products as $product)
                                        <tr>
                                            <td>
                                                {{$count++}}.
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
                                            @if ($product->created_at)
                                            <td>
                                                {{$product->created_at->format('d-m-Y')}}
                                                <small> {{$product->created_at->diffForHumans()}}</small>
                                            </td>
                                            @else
                                            @php
                                                $todayTime=Carbon\Carbon::now()->format('g:i A');
                                                $todayDate=Carbon\Carbon::now()->format('d-m- Y');
                                            @endphp
                                            <td>
                                                {{$todayDate}}
                                                <small>{{$todayTime}}</small>
                                            </td>
                                            @endif
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
                                            @if ($product->product_publish=='1')
                                            <td>
                                                <span class="badge badge-success-lighten">Published</span>
                                            </td>
                                            @else
                                            <td>
                                                <span class="badge badge-warning-lighten">Pending..</span>
                                            </td>
                                            @endif

                                            <td class="table-action">
                                                <a href="{{route('view.product',$product->id)}}" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                <a href="{{route('edit.product',$product->id)}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                <a href="{{route('delete.product',$product->id)}}" onclick="return confirm('delete product?')" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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
                <form action="{{route('store.category')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                                <label for="category-title">Category Name*</label>
                                <input type="text" class="form-control form-control-light" value="{{old('name')}}" name="name" id="category-title" placeholder="Enter name">
                            </div>
                        <div class="mb-3">
                                <label for="category-image">Category Image</label>
                                <input type="file" class="form-control form-control-light" name="category_image" id="category-image">
                            </div>

                        <div class="mb-3">
                            <label for="category-pos">Category Postion for Homepage</label>
                            <select type="text" id="category-pos" name="category_position" class="form-control form-control-light">
                                <option value="" selected disabled>--select--</option>
                                <option value="right">Right</option>
                                <option value="left">Left</option>
                                <option value="up">Up</option>
                                <option value="down">Down</option>
                            </select>
                            </div>
                        <div class="mb-3 form-check form-checkbox-secondary">
                                <label class="form-check-label" for="category-status">Publish?</label>
                                <input type="checkbox" class="form-check-input" name="category_status" id="category-status">
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
      $(".products-datatable").DataTable({keys:!0,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});var a=$("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","print"],language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});});
  </script>
@endsection
