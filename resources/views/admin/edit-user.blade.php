@extends('admin.layouts.title')
@section('title','Admin Dashboard')
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
                            <li class="breadcrumb-item"><a href="{{route('products')}}">Users</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit User Role</h4>
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
                        <form action="{{route('update.user')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <a href="{{route('users')}}" type="submit" class="btn btn-secondary float-end">Back</a>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                        <label for="category-title">User Name</label>
                                        <input type="hidden"name="use_val" id="user_name" value="{{$users->id}}">
                                        <input type="text" class="form-control form-control-light" name="name" id="user_name" value="{{$users->name}}">
                                        @error('name')
                                        <span class="invalid-feedback">
                                            <strong>
                                                {{$message}}
                                            </strong>
                                        </span>
                                        @enderror
                                    </div>
                                <div class="mb-3">
                                        <label for="category-title">User Email</label>
                                        <input type="text" class="form-control form-control-light" name="email" id="user_email" value="{{$users->email}}">
                                        @error('email')
                                        <span class="invalid-feedback">
                                            <strong>
                                                {{$message}}
                                            </strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="category-pos">Role</label>
                                        <select type="text" id="" name="usertype" class="form-control form-control-light user_roles">
                                            @if ($users->usertype=='0')
                                            <option hidden>Normal User</option>
                                            @elseif ($users->usertype=='1')
                                            <option hidden>Agent</option>
                                            @else
                                            <option hidden>Admin</option>
                                            @endif
                                            <option value="0">Normal User</option>
                                            <option value="1">Agent</option>
                                            <option value="2">Admin</option>
                                        </select>
                                        </div>
                                </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-dark">Update</button>
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
        PreviewInput.onchange=evt=>{
            const[file]=PreviewInput.files
            if(file)
            {
                PreviewImg.src=URL.createObjectURL(file)
            }
        }
    </script>
@endsection
