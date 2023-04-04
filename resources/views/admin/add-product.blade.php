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
                            <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">E-shop</a></li>
                            <li class="breadcrumb-item"><a href="{{route('products')}}">Data</a></li>
                            <li class="breadcrumb-item active">Add-Product</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add Product</h4>
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
                        <form action="{{route('store.product')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                    <div class="col-xl-6">

                                        <div class="mb-3">
                                            <label for="productname" class="form-label">Product Name</label>
                                            <input type="text" name="product_name" value="{{old('product_name')}}" id="productname" class="form-control @error('product_name')  is-invalid @enderror" placeholder="Enter post title" required>
                                            @error('product_name')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="productcategory" class="form-label">Select Category</label>
                                            <select type="text" id="productcategory" data-toggle="select2"  name="category_id" class="form-control select2 @error('category_id')  is-invalid @enderror" required>
                                                <option value="" selected disabled>--select--</option>
                                                @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="productprice" class="form-label">Product Price</label>
                                            <input type="number" min="0" name="product_price" value="{{old('product_price')}}" id="productprice" class="form-control @error('product_price')  is-invalid @enderror" placeholder="Enter post title" required>
                                            @error('product_price')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="productstatus" class="form-label">Supplier</label>
                                            <select type="text" id="productstatus"  name="supplier_id" data-toggle="select2"  class="form-control select2 @error('supplier_id')  is-invalid @enderror" required>
                                                <option value="" selected disabled>--select--</option>
                                                @foreach ($suppliers as $supplier)
                                                <option value="{{$supplier->id}}">{{$supplier->first_name}} {{$supplier->second_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('supplier_id')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-checkbox-secondary mb-2">
                                                <label class="form-check-label" for="customCheck">Active?</label>
                                                <input type="checkbox" name="product_publish" id="customCheck" class="form-check-input @error('product_publish')  is-invalid @enderror">
                                            </div>
                                            @error('product_publish')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3 mt-3 mt-xl-0">
                                                <label for="projectname" class="mb-1">Product Image</label><br>
                                                <img src="" id="PreviewImg" width="20%" class="border p-1" alt="" style="border-color: 3 #505050 solid; margin:4px; border-radius:4%">
                                                <input type="file" name="product_image" id="PreviewInput" class="form-control @error('product_image')  is-invalid @enderror" required>
                                                @error('product_image')
                                                <span class="invalid-feedback">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 mt-3 mt-xl-0">
                                                <label for="projectname" class="mb-1">Related Images</label><br>
                                                <input type="file" name="image[]" multiple id="" class="form-control @error('image')  is-invalid @enderror" required>
                                                @error('image')
                                                <span class="invalid-feedback">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="productquantity" class="form-label">Product Quantity</label>
                                                <input type="number" min="0" name="product_quantity" value="{{old('product_quantity')}}" id="productquantity" class="form-control @error('product_quantity')  is-invalid @enderror" placeholder="Available quantity" required>
                                                @error('product_quantity')
                                                <span class="invalid-feedback">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="productstatus" class="form-label">Status</label>
                                                <select type="text" id="productstatus"  name="product_status" class="form-control select @error('product_status')  is-invalid @enderror" required>
                                                    <option value="" selected disabled>--select--</option>
                                                    <option value="0">Out of Stock</option>
                                                    <option value="1">New</option>
                                                    <option value="2">Top</option>
                                                    <option value="3">Available</option>
                                                </select>
                                                @error('product_status')
                                                <span class="invalid-feedback">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="mb-3">
                                            <label for="product_description" class="form-label">Description</label>
                                            <textarea class="ckeditor @error('product_description') is-invalid @enderror" id="product_description" name="product_description" required>{{old('product_description')}}</textarea>
                                            @error('product_description')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-secondary"><span class="mdi mdi-content-save"></span> Save</button>
                                </form>
                        <!-- end row -->
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->
<!-- Dropzone js -->

@endsection
<!-- bundle -->
@section('scripts')

    <script src="{{asset('admin/assets/js/pages/ckeditor/ckeditor.js')}}"></script>

    <script>
        CKEDITOR.replace('productdescription',{
            filebrowserUploadUrl:"{{route('upload',['_token'=>csrf_token()] )}}",
            filebrowserUploadMethod:'form'
        });
    </script>

    <script src="{{asset('admin/assets/js/pages/demo.dashboard.js')}}"></script>

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
