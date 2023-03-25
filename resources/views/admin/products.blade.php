@extends('admin.layouts.title')
@section('title','MK Dashboard')
@extends('admin.layouts.master')
@section('styles')
    <link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{asset('admin/assets/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="dark-style">

    <link href="{{asset('admin/assets/css/vendor/dataTables.bootstrap5.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/vendor/responsive.bootstrap5.css')}}" rel="stylesheet" type="text/css">
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
                                    <a href="{{route('add.product')}}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add Products</a>
                                </div>
                                <div class="col-sm-8">
                                    <div class="text-sm-end">
                                        <button type="button" class="btn btn-success mb-2 me-1"><i class="mdi mdi-cog-outline"></i></button>
                                        <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                                        <button type="button" class="btn btn-light mb-2">Export</button>
                                    </div>
                                </div><!-- end col-->
                            </div>
    
                            <div class="table-responsive">
                                <table class="table table-hover table-centered w-100 dt-responsive nowrap" id="products-datatable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="all" style="width: 20px;">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                </div>
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
                                        @forelse ($products as $product)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                </div>
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
                                            <td>
                                                <script>document.write(new Date().getDate())</script>-<script>document.write(new Date().getMonth()+1)</script>-<script>document.write(new Date().getFullYear())</script>
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

@endsection
@section('scripts')
    <script src="{{asset('admin/assets/js/vendor.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/app.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/pages/demo.dashboard.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendor/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendor/dataTables.bootstrap5.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendor/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendor/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendor/dataTables.checkboxes.min.js')}}"></script>

    <script src="{{asset('admin/assets/js/pages/demo.products.js')}}"></script>

@endsection