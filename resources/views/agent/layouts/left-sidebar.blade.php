<div class="leftside-menu">

    <!-- LOGO -->
    <a href="{{route('agent-products')}}" class="logo text-center logo-light">
        <h3 class="font-weight-bold text-muted h2" style="font-family:Arial, Helvetica, sans-serif">MK <span style="color:#c96;">Store</span></h3>
        <h4 class="font-weight-bold text-light" style="font-family:Arial, Helvetica, sans-serif">| Agent |</h4>
    </a>

    <!-- LOGO -->
    <a href="{{route('agent-products')}}" class="logo text-center logo-dark">
        <h3 class="font-weight-bold text-muted h2" style="font-family:Arial, Helvetica, sans-serif">MK <span style="color:#c96;">Store</span></h3>
        <h4 class="font-weight-bold text-light" style="font-family:Arial, Helvetica, sans-serif">| Agent |</h4>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">



            <li class="side-nav-title side-nav-item"></li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="true" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span> Data </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse show" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('agent-products')}}">Products</a>
                        </li>
                        <li>
                            <a href="{{route('agent.category')}}">Category</a>
                        </li>
                        <li>
                            <a href="{{route('purchase.order')}}">Purchase Order</a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>

        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
