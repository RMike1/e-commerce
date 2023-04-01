<div class="leftside-menu">

    <!-- LOGO -->
    <a href="{{route('admin-dashboard')}}" class="logo text-center logo-light">
        <h3 class="font-weight-bold text-muted h2" style="font-family:Arial, Helvetica, sans-serif">MK <span style="color:#c96;">Store</span></h3>
        <h4 class="font-weight-bold text-light" style="font-family:Arial, Helvetica, sans-serif">| Admin |</h4>
    </a>

    <!-- LOGO -->
    <a href="{{route('admin-dashboard')}}" class="logo text-center logo-dark">
        <h3 class="font-weight-bold text-muted h2" style="font-family:Arial, Helvetica, sans-serif">MK <span style="color:#c96;">Store</span></h3>
        <h4 class="font-weight-bold text-light" style="font-family:Arial, Helvetica, sans-serif">| Admin |</h4>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item"></li>

            <li class="side-nav-item">
                <a href="{{route('admin-dashboard')}}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard</span>
                </a>
            </li>

            <li class="side-nav-title side-nav-item">Section</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="uil-layer-group"></i>
                    <span> Data </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('products')}}">View Products</a>
                        </li>
                        <li>
                            <a href="{{route('category')}}">View Category</a>
                        </li>
                        <li>
                            <a href="{{route('orders')}}">View Orders</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-title side-nav-item mt-1">Users</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarBaseUI" aria-expanded="false" aria-controls="sidebarBaseUI" class="side-nav-link">
                    <i class="uil-box"></i>
                    <span>Management</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarBaseUI">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('users')}}">View Users</a>
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
