@extends('agent.layouts.title')
@section('title','MK | Agent')
@extends('agent.layouts.master')
@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{asset('admin/assets/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="dark-style">
    <link href="{{asset('admin/assets/css/vendor/quill.core.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/assets/css/vendor/quill.snow.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/assets/css/vendor/simplemde.min.css')}}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">MK</a></li>
                            <li class="breadcrumb-item"><a href="{{route('products')}}">Data</a></li>
                            <li class="breadcrumb-item active">PO</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Purchase Order </h4>
                    </h4>
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
                    <div class="card-header text-center">
                        <h4>Create Purchase Order</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('store.purchase-order')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3 position-relative" id="datepicker4">
                                            <label class="form-label">Date</label>
                                                <input type="text" class="form-control form-control-light" name="date" data-provide="datepicker" placeholder="pick date.." data-date-autoclose="true" data-date-container="#datepicker4">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                                <label class="form-label">Invoice N<sup>o</sup></label>
                                                <input type="text" class="form-control form-control-light" value="{{$po_invoice_no}}" name="invoice_no" placeholder="Invoice No.."  value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Information </label>
                                    <textarea type="text" rows="5"  class="form-control form-control-light" placeholder="more details.." name="information"   value=""></textarea>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                            <label class="form-label">Supplier Name</label>
                                            <select type="text" data-toggle="select2"  class="form-control form-control-light select2" name="supplier_name" placeholder="Supplier Name.."  value="">
                                                <option selected disabled>--select--</option>
                                                @foreach ($suppliers as $supplier)
                                                <option value="{{$supplier->id}}">{{$supplier->first_name}} {{$supplier->second_name}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="append-data">
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Tot</th>
                                                <th ></th>
                                            </tr>
                                            <tr>
                                                <td><input class="form-control" name="inputs[0][product_name]" type="text" placeholder="name.."></td>
                                                <td><input class="form-control" name="inputs[0][product_price]" type="text" placeholder="price.."></td>
                                                <td><input class="form-control" name="inputs[0][product_quantity]" type="text" placeholder="quantity.."></td>
                                                <td><input class="form-control" name="inputs[0][product_total]" type="text" placeholder="Tot amount.."></td>
                                                <td><Button type="button" class="btn btn-secondary btn-sm float-end append_btn"><i class=" dripicons-plus"></i></Button></td>
                                            </tr>
                                    </table>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-secondary d-block w-100"><i class="mdi mdi-content-save"></i> Submit</button>
                            </div>
                        </form>                        <!-- end row -->
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->

@endsection
@section('scripts')

    <script src="{{asset('admin/assets/js/pages/ckeditor/ckeditor.js')}}"></script>

    <script>
        CKEDITOR.replace('productdescription',{
            filebrowserUploadUrl:"{{route('upload',['_token'=>csrf_token()] )}}",
            filebrowserUploadMethod:'form'
        });
    </script>

<script src="{{asset('admin/assets/js/pages/demo.dashboard.js')}}"></script>

    <script src="{{asset('admin/assets/js/vendor/dropzone.min.js')}}"></script>

    <script src="{{asset('admin/assets/js/ui/component.fileupload.js')}}"></script>
        <!-- quill js -->
    <script src="{{asset('admin/assets/js/vendor/quill.min.js')}}"></script>
    <!-- quill Init js-->
    <script src="{{asset('admin/assets/js/pages/demo.quilljs.js')}}"></script>
    <script>
        $(document).ready(function(){
            var i=0;
            $(document).on('click','.append_btn', function(e){
                e.preventDefault();
                i++
                $('#append-data').append(`<tr>
                                                <td><input class="form-control" name="inputs[`+i+`][product_name]" type="text" placeholder="name.."></td>
                                                <td><input class="form-control" name="inputs[`+i+`][product_price]" type="text" placeholder="price.."></td>
                                                <td><input class="form-control" name="inputs[`+i+`][product_quantity]" type="text" placeholder="quantity.."></td>
                                                <td><input class="form-control" name="inputs[`+i+`][product_total]" type="text" placeholder="Tot amount.."></td>
                                                <td><Button type="button" class="btn btn-danger btn-sm float-end remove_append_btn"><i class=" dripicons-minus"></i></Button></td>
                                            </tr>`)
            });
            $(document).on('click','.remove_append_btn', function(e){
               e.preventDefault();
                    $(this).parents('tr').remove();


            });


        });
    </script>
@endsection
