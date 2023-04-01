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
                            <li class="breadcrumb-item"><a href="{{route('products')}}">Data</a></li>
                            <li class="breadcrumb-item active">Mail</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Send Mail To: {{$order->first_name}} {{$order->second_name}} [{{$order->email}}]
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
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('send.mail_notification',$order->id)}}" method="post">
                            @csrf
                            <div class="modal-header">
                                <a href="{{route('view.order',$order->id)}}" type="submit" class="btn btn-secondary float-end"><i class="mdi mdi-keyboard-return me-1"></i>Back</a>
                            </div>
                            <div class="modal-body">

                                <div class="mb-3">
                                        <label for="mail-title">Greeting</label>
                                        <input type="text" class="form-control form-control-light" name="greeting" id="user_name" value="">
                                </div>
                                <div class="mb-3">
                                        <label for="mail-title">First Line</label>
                                        <input type="text" class="form-control form-control-light" name="first_line" id="user_name" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="mail-title">Body </label>
                                    <textarea type="text" class="form-control form-control-light" name="body" id="user_name" value=""></textarea>
                                </div>
                                <div class="mb-3">
                                        <label for="mail-title">Button</label>
                                        <input type="text" class="form-control form-control-light" name="button" id="user_name" value="">
                                </div>
                                <div class="mb-3">
                                        <label for="mail-title">Url</label>
                                        <input type="text" class="form-control form-control-light" name="url" id="user_name" value="">
                                </div>
                                <div class="mb-3">
                                        <label for="mail-title">Last Line</label>
                                        <input type="text" class="form-control form-control-light" name="last_line" id="user_name" value="">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-secondary d-block w-100"><i class="mdi mdi-email-send-outline"></i> Send</button>
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
