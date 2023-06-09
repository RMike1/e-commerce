    <link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{asset('admin/assets/css/vendor/dataTables.bootstrap5.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/vendor/responsive.bootstrap5.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/vendor/select.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/assets/css/vendor/buttons.bootstrap5.css')}}" rel="stylesheet" type="text/css" />

 <!-- Start Content-->
 <div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3 class="text-center">
                Invoice Details
                <a  class="btn btn-secondary float-start" href="{{route('view.order',$order->id)}}"><i title="view this order" class="mdi mdi-keyboard-return me-1"></i>Back</a>
            </h3>
        </div>
    </div>
    <!-- end row -->

    {{-- <a href="{{route('download.invoice',$orders->id)}}" class="btn btn-dark"><i class="fa fa-download"></i>Download Invoice</a> --}}
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Items from Order Tracking N<sup>o</sup> [{{$tracking_no}}]</h4>

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                            <tr>
                                <td>{{$order->product_name}}</td>
                                <td>{{$order->orderQty}}</td>
                                <td>${{number_format($order->product_price,2)}}</td>
                                <td>${{number_format($order->orderTot,2)}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->

                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Order Summary</h4>

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>Description</th>
                                <th>Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Total :</td>
                                <td>${{number_format($subtotcart,2)}}</td>
                            </tr>
                            <tr>
                                <td>Shipping Charge:</td>
                                <td>${{$shipping_val}} <span>({{$shipping_method}})</span></td>
                            </tr>
                            <tr>
                                <th>Grand Total :</th>
                                <th>${{number_format($final_tot,2)}}</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->

                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Shipping Information</h4>

                    <h5>{{$shipping_info->first_name}} {{$shipping_info->second_name}}</h5>

                    <address class="mb-0 font-14 address-lg">
                        {{$shipping_info->street}}, <br>
                        {{$shipping_info->state}}, {{$shipping_info->town}}<br>
                        <abbr title="Phone">P:</abbr> {{$shipping_info->phone}} <br>
                        <abbr title="Email">E:</abbr> {{$shipping_info->email}} <br>
                    </address>

                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Billing Information</h4>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <p class="mb-2"><span class="fw-bold me-2">Payment Type:</span> {{$billing_info->payment_method}}</p>
                            <p class="mb-2"><span class="fw-bold me-2">Valid Date:</span> 02/2020</p>
                            <p class="mb-0"><span class="fw-bold me-2">CVV:</span> xxx</p>
                        </li>
                    </ul>

                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3 text-center">Delivery Info</h4>

                    <div class="text-center">
                        <i class="mdi mdi-truck-fast h2 text-muted"></i>
                        <h5><b>UPS Delivery</b></h5>
                        <p class="mb-1"><b>Order ID :</b> {{$delivery_info->order_id}}</p>
                        <p class="mb-0"><b>Payment Mode :</b>  {{$delivery_info->payment_method}}</p>
                        <p class="mb-0"><b>Payment Status :</b>  {{$delivery_info->payment_status}}</p>
                        <p class="mb-0"><b>Shipping Method :</b>  {{$delivery_info->shipping_method}}</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->


</div> <!-- container -->

</div> <!-- content -->

<script src="{{asset('admin/assets/js/pages/demo.dashboard.js')}}"></script>
  <!-- third party js -->
  <script src="{{asset('admin/assets/js/vendor/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/vendor/dataTables.bootstrap5.js')}}"></script>
  <script src="{{asset('admin/assets/js/vendor/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/vendor/responsive.bootstrap5.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/vendor/dataTables.checkboxes.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/vendor/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('admin/assets/js/vendor/buttons.bootstrap5.min.js')}}"></script>
<script src="{{asset('admin/assets/js/vendor/buttons.html5.min.js')}}"></script>
<script src="{{asset('admin/assets/js/vendor/buttons.flash.min.js')}}"></script>
<script src="{{asset('admin/assets/js/vendor/buttons.print.min.js')}}"></script>
