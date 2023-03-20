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
                        <li class="breadcrumb-item"><a href="{{route('home')}}">MK</a></li>
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Blog</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div>
                <h4 class="page-title">Category</h4>
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#create-category-modal"><i class="mdi mdi-plus-circle me-2"></i> Category</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>Category</th>
                                    <th>Posts Number</th>
                                    <th style="width: 85px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count=1;
                                @endphp
                                @foreach ($category as $category)
                                <tr>

                                    <td>
                                       {{$count++}} 
                                    </td>
                                    <td>
                                        {{$category->name}}
                                    </td>
                                    <td>
                                    </td>

                                    <td class="table-action">
                                         <button id="cat_id" value="{{$category->id}}" class="action-icon bg-transparent" style="border: none"> <i class="mdi mdi-square-edit-outline"></i>
                                        </button>
                                        <a href="{{route('delete.category',$category->id)}}" class="action-icon" onclick="return confirm('are u sure to delete this category?')"> <i class="mdi mdi-delete"></i></a>
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

        <!------------------edit category modal------------------->


       <div id="edit-category-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Update Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form action="{{route('update.category')}}" method="post">
                @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                                <label for="category-title">Category Name</label>
                                <input type="hidden" class="form-control" name="category_id" id="category_id">
                                <input type="text" class="form-control form-control-light" name="name" id="category_name" placeholder="Enter name">
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Update</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    
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

      <!-- Datatables js -->
  
      <!-- Datatable Init js -->
      <script src="{{asset('admin/assets/js/pages/demo.datatable-init.js')}}"></script>
      
      <script>
        $(document).ready(function(){
            $(document).on('click', '#cat_id', function(e){
                e.preventDefault();
                var category_data= $(this).val();
                $('#edit-category-modal').modal('show');
                $('#category_id').val(category_data);
                $('#category_name').val("...");
                $.ajax({
                    url:'/edit-category/'+category_data,
                    dataType:"json",
                    type:"GET",
                    success: function(response)
                    {
                        $('#category_name').val(response.category.name);
                    },
                    error: function(error){
                        console.log(error);
                    }
                });

            })
        })
      </script>
        <script>
            $(document).ready(function(){"use strict";
            $(".comment-datatable").DataTable({keys:!0,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});var a=$("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","print"],language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});});
        </script>
      

@endsection
