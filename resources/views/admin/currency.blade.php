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

    <div class="currency-status"></div>


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
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add-currency-modal"><i class="mdi mdi-plus-circle me-2"></i>Currency</button>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap category-datatable">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th>
                                        #
                                    </th>
                                    <th>Currency Name</th>
                                    <th>Currency Code</th>
                                    <th>Currency Value <br> (According to RWF)</th>
                                    <th>Currency Value <br> (According to US Dollar)</th>
                                    <th>Active?</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count=1;
                                @endphp
                                @foreach ($currencies as $currency)
                                <tr class="text-center">
                                     <td>
                                       {{$count++}}
                                    </td>
                                    <td>
                                        {{$currency->name}}
                                    </td>
                                    <td>
                                        {{$currency->code}}
                                    </td>
                                    <td>
                                        {{$currency->normal_val}}
                                    </td>
                                    <td>
                                        {{$currency->us_value}}
                                    </td>
                                    @if ($currency->status=='1')
                                    <td>
                                        <input type="checkbox" id="{{$currency->code}}"  value="{{$currency->id}}" class="change-currency" checked data-switch="success"/>
                                        <label for="{{$currency->code}}" data-on-label="Yes" data-off-label="No"></label>
                                    </td>
                                    @else
                                    <td>
                                        <input type="checkbox" id="{{$currency->code}}"  value="{{$currency->id}}" class="change-currency" data-switch="success"/>
                                        <label for="{{$currency->code}}" data-on-label="Yes" data-off-label="No"></label>
                                    </td>
                                    @endif
                                    <td>
                                        <button value="{{$currency->id}}" type="button" id="edit-currency" class="action-icon bg-transparent" style="border: none"> <i class="mdi mdi-square-edit-outline"></i></button>
                                        <a href="{{route('delete.currency',$currency->id)}}" class="action-icon" onclick="return confirm('are u sure to delete this supplier?')"> <i class="mdi mdi-delete"></i></a>
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

 <!------------------add currency modal------------------->

<div id="add-currency-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">New Currency</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="{{route('store.currency')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3 position-relative" id="datepicker4">
                                <label class="form-label">Currency Name</label>
                                <input type="text" class="form-control form-control-light" name="name" placeholder="Currency Name..">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3 position-relative" id="datepicker4">
                                <label class="form-label">Currency Code</label>
                                <input type="text" class="form-control form-control-light" name="code" placeholder="Currency Code..">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3 position-relative" id="datepicker4">
                                <label class="form-label">Currency Value(According to RWF)</label>
                                <input type="text" class="form-control form-control-light" name="normal_val" placeholder="Value..">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3 position-relative" id="datepicker4">
                                <label class="form-label">Currency Value(According to US Dollar)</label>
                                <input type="text" class="form-control form-control-light" name="us_value" placeholder="Value..">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3 position-relative" id="datepicker4">
                                <label class="form-label">Currency Symbol</label>
                                <input type="text" class="form-control form-control-light" name="symbol" placeholder="Currency Symbol..">
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

 <!------------------edit currency modal------------------->


 <div id="edit-currency-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Update Currency</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="{{route('update.currency')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3 position-relative" id="datepicker4">
                                <label class="form-label">Currency Name</label>
                                <input type="hidden" id="currency_val" name="id">
                                <input type="text" class="form-control form-control-light" id="currency_name" name="name" placeholder="Currency Name..">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3 position-relative" id="datepicker4">
                                <label class="form-label">Currency Code</label>
                                <input type="text" class="form-control form-control-light" id="currency_code" name="code" placeholder="Currency Code..">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3 position-relative" id="datepicker4">
                                <label class="form-label">Currency Value <br> (According to RWF)</label>
                                <input type="text" class="form-control form-control-light" id="currency_val_rwf" name="normal_val" placeholder="Value..">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3 position-relative" id="datepicker4">
                                <label class="form-label">Currency Value <br> (According to US Dollar)</label>
                                <input type="text" class="form-control form-control-light" id="currency_val_us" name="us_value" placeholder="Value..">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3 position-relative" id="datepicker4">
                                <label class="form-label">Currency Symbol</label>
                                <input type="text" class="form-control form-control-light" id="currency_symbol" name="symbol" placeholder="Currency Symbol..">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary d-block w-100"><i class="mdi mdi-content-save"></i> Update</button>
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
            $(document).on('click', '#edit-currency', function(e){
                e.preventDefault();
                var currency_val= $(this).val();

                // if(curr_id)
                // alert(currency_val);
                $('#edit-currency-modal').modal('show');
                $('#currency_val').val(currency_val);
                $('#currency_name').val("...");
                $('#currency_code').val("...");
                $('#currency_symbol').val("...");
                $('#currency_val_rwf').val("...");
                $('#currency_val_us').val("...");

                $.ajax({
                    url:"{{route('edit.currency')}}",
                    data:{currency_val:currency_val},
                    dataType:"json",
                    type:"GET",
                    success: function(response)
                    {
                        $('#currency_name').val(response.currency.name);
                        $('#currency_code').val(response.currency.code);
                        $('#currency_symbol').val(response.currency.symbol);
                        $('#currency_val_rwf').val(response.currency.normal_val);
                        $('#currency_val_us').val(response.currency.us_value);
                    },
                    error: function(error){
                        console.log(error);
                    }
                });
            })

            $(document).on('change','.change-currency', function(e){
                e.preventDefault();
                var currency_chk=$(this).val();
                if($(this).is(':checked')){
                    var status=1;
                    $('.currency-status').html("");
                    $.ajaxSetup({
                        headers:{
                            "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        data:{currency_va:currency_chk, status:status},
                        url:"{{route('update.currency_status')}}",
                        type:"post",
                        dataType:"json",
                        success:function(response){
                            $('.currency-status').append(`
                                <div class="alert alert-`+response.alert+` alert-dismissible fade show mb-3" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    `+response.message+`
                                </div>`)
                        }
                    });

                }
                else{
                    var status=0;
                    $('.currency-status').html("");
                    $.ajaxSetup({
                        headers:{
                            "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        data:{currency_va:currency_chk, status:status},
                        url:"{{route('update.currency_status')}}",
                        type:"post",
                        dataType:"json",
                        success:function(response){
                            $('.currency-status').append(`
                                <div class="alert alert-`+response.alert+` alert-dismissible fade show mb-3" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    `+response.message+`
                                </div>`)
                        }
                    });
                }

            });
        })
     </script>
        <script>
            $(document).ready(function(){"use strict";
            $(".category-datatable").DataTable({keys:!0,language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});var a=$("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","print"],language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}},drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}});});
        </script>
@endsection
