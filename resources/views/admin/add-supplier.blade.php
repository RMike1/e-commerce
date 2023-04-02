@extends('admin.layouts.title')
@section('title','MK | Admin')
@extends('admin.layouts.master')
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
                            <li class="breadcrumb-item active">Add Supplier</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add Supplier</h4>
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

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Add Supplier</h4>
                    </div>
                    <div class="card-body">
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
@endsection
