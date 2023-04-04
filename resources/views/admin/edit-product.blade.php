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
                            <li class="breadcrumb-item active">Edit-Product</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Product</h4>
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
                        <form action="{{route('update.product')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                    <div class="col-xl-6">

                                        <div class="mb-3">
                                            <label for="productname" class="form-label">Product Name</label>
                                            <input type="hidden" name="product_id" value="{{$product->id}}" >
                                            <input type="text" name="product_name" value="{{$product->product_name}}" id="productname" class="form-control @error('product_name')  is-invalid @enderror" placeholder="Enter post title" required>
                                            @error('product_name')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="productcategory" class="form-label">Select Category</label>
                                            <select type="text" id="productcategory"  data-toggle="select2" name="category_id" class="form-control select2 @error('category_id')  is-invalid @enderror" required>
                                                <option value=""  disabled>--select--</option>
                                                <option value="{{$categories->id}}" selected>{{$categories->name}}</option>
                                                @foreach (App\Models\Category::where('id','!=',$product->category->id)->get() as $category)
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
                                            <input type="number" min="0" name="product_price" value="{{$product->product_price}}" id="productprice" class="form-control @error('product_price')  is-invalid @enderror" placeholder="Enter post title" required>
                                            @error('product_price')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="productstatus" class="form-label">Supplier</label>
                                            <select type="text" id="productstatus"  name="supplier_id" data-toggle="select2"  class="form-control select2 @error('supplier_id')  is-invalid @enderror" required>
                                                @if ($supplier=='0')
                                                <option  selected disabled>--No selected supplier please choose one--</option>
                                                @foreach ($suppliers as $supplier)
                                                <option value="{{$supplier->id}}">{{$supplier->first_name}} {{$supplier->second_name}}</option>
                                                @endforeach
                                                @else
                                                <option value="{{$supplier->id}}" selected>{{$supplier->first_name}} {{$supplier->second_name}}</option>
                                                @foreach ($suppliers as $supplier)
                                                <option value="{{$supplier->id}}">{{$supplier->first_name}} {{$supplier->second_name}}</option>
                                                @endforeach
                                                @endif
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
                                                <input type="checkbox" name="product_publish" id="customCheck" class="form-check-input @error('product_publish')  is-invalid @enderror" {{$product->product_publish=='1' ? 'checked' : ''}}  >
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
                                                <img src="{{asset($product->product_image)}}" id="PreviewImg" class="border p-1" width="20%" alt="" style="border-color: 3 #505050 solid; margin:4px; border-radius:4%;">
                                                <input type="file" name="product_image" id="PreviewInput" class="form-control @error('product_image')  is-invalid @enderror" multiple='multiple'>
                                                @error('product_image')
                                                <span class="invalid-feedback">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3 mt-3 mt-xl-0">
                                                <label for="projectname" class="mb-1">Related Images</label><br>
                                                <input type="file" name="image[]" multiple id="" class="form-control @error('image')  is-invalid @enderror">
                                                @error('image')
                                                <span class="invalid-feedback">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                                <div>
                                                    @if ($product->productimage)
                                                    <div class="row">
                                                        @foreach ($product->productimage as $images)
                                                        <div class="col-md-2">
                                                            <img src="{{asset($images->image)}}" class="border me-1" alt="" style="height: 50px; width:auto; padding:3px">
                                                            <a href="{{route('delete.related_images',$images->id)}}" onclick="return confirm('delete related image?')" class="text-danger d-block">Remove</a>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="productquantity" class="form-label">Product Quantity</label>
                                                <input type="number" min="0" name="product_quantity" value="{{$product->product_quantity}}" id="productquantity" class="form-control @error('product_quantity')  is-invalid @enderror" placeholder="Available Quantity" required>
                                                @error('product_quantity')
                                                <span class="invalid-feedback">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="productstatus" class="form-label">Status</label>
                                                <select type="text" value="{{$product->id}}" id="productstatus"  name="product_status" class="form-control select @error('product_status')  is-invalid @enderror" required>
                                                    <option value="" disabled>--select--</option>
                                                    @if ($product->product_status=='0')
                                                    <option value="{{$product->product_status}}" selected hidden>Out of Stock</option>
                                                    @elseif ($product->product_status=='1')
                                                    <option value="{{$product->product_status}}" selected hidden>New</option>
                                                    @elseif ($product->product_status=='2')
                                                    <option value="{{$product->product_status}}" selected hidden>Top</option>
                                                    @else
                                                    <option value="{{$product->product_status}}" selected hidden>Available</option>
                                                    @endif
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
                                            <textarea class="ckeditor @error('product_description') is-invalid @enderror" id="product_description" name="product_description" required>{{$product->product_description}}</textarea>
                                            @error('product_description')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-secondary"><span class="mdi mdi-content-save"></span> Update</button>
                                </form>
                        <!-- end row -->
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