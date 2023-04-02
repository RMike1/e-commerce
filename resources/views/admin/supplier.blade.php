@extends('admin.layouts.title')
@section('title','MK | Admin')
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
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Data</a></li>
                        <li class="breadcrumb-item active">Supplier</li>
                    </ol>
                </div>
                <h4 class="page-title">Suppliers</h4>
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

    <div class="row mb-2">
        <div class="col-sm-12">
            <div class="text-sm-end">
                <div class="btn-group mb-3 ms-1">
                </div>
                <div class="btn-group mb-3 ms-2 d-none d-sm-inline-block">
                </div>
            </div>
        </div><!-- end col-->
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add-supplier-modal"><i class="mdi mdi-plus-circle me-2"></i>Supplier</button>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap category-datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>Supplier Name</th>
                                    <th>Products</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count=1;
                                @endphp
                                @foreach ($suppliers as $supplier)
                                <tr>
                                     <td>
                                       {{$count++}}
                                    </td>
                                    <td>
                                        {{$supplier->first_name}} {{$supplier->second_name}}
                                    </td>
                                    <td>
                                        {{$supplier->status=='1' ? 'Active' : 'Inactive'}}
                                    </td>
                                    <td>
                                        <button value="{{$supplier->id}}" type="button" id="edit-supplier" class="action-icon bg-transparent" style="border: none"> <i class="mdi mdi-square-edit-outline"></i></button>
                                        <a href="{{route('delete.supplier',$supplier->id)}}" class="action-icon" onclick="return confirm('are u sure to delete this supplier?')"> <i class="mdi mdi-delete"></i></a>
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

<div id="add-supplier-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Add Supplier</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="{{route('store.supplier')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3 position-relative" id="datepicker4">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control form-control-light" name="first_name" placeholder="First Name..">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Second Name</label>
                                <input type="text" class="form-control form-control-light" name="second_name" placeholder="Second Name..">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 form-check form-checkbox-secondary">
                        <label class="form-check-label category_status2" for="supplier_status">Active?</label>
                        <input type="checkbox" class="form-check-input" name="status" id="supplier_status">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary d-block w-100"><i class="mdi mdi-content-save"></i> Save</button>
                </div>
            </form>                        <!-- end row -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

 <!------------------edit category modal------------------->


 <div id="edit-supplier-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Update Category</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="{{route('update.supplier')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3 position-relative" id="datepicker4">
                                <label class="form-label">First Name</label>
                                <input type="hidden" id="supplier_id" name="supplier_id">
                                <input type="text" class="form-control form-control-light" id="first_name" name="first_name" placeholder="First Name..">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Second Name</label>
                                <input type="text" class="form-control form-control-light" id="second_name" name="second_name" placeholder="Second Name..">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 form-check form-checkbox-secondary">
                        <label class="form-check-label supplier_status2" for="supplier_status">Active?</label>
                        <input type="checkbox" class="form-check-input" name="status" id="supplier_status3">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary d-block w-100"><i class="mdi mdi-content-save"></i> Save</button>
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
      <script src="{{asset('admin/assets/js/pages/demo.datatable-init.js')}}"></script>
     <script>
       $(document).ready(function(){
            $(document).on('click', '#edit-supplier', function(e){
                e.preventDefault();
                var supplier_data= $(this).val();
                $('#edit-supplier-modal').modal('show');
                $('#supplier_id').val(supplier_data);
                $('#first_name').val("...");
                $('#second_name').val("...");
                $('.supplier_status2').append(`<input type="checkbox" class="form-check-input" name="status" id="supplier_status3">`)

                $.ajax({
                    url:"{{route('edit.supplier')}}",
                    data:{supplier_id:supplier_data},
                    dataType:"json",
                    type:"GET",
                    success: function(response)

                    {
                        $('#first_name').val(response.supplier.first_name);
                        $('#second_name').val(response.supplier.second_name);

                        if(response.supplier.status=='1')
                        {
                            $('.supplier_status2').append(`<input type="checkbox" class="form-check-input" name="status" checked id="supplier_status3">`);
                        }
                        else{
                            $('.supplier_status2').append(`<input type="checkbox" class="form-check-input" name="status" id="supplier_status3">`);
                        }
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
            $(".category-datatable").DataTable({keys:!0,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});var a=$("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","print"],language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});});
        </script>
@endsection
