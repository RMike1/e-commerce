<div class="leftside-menu">

    <!-- LOGO -->
    <a href="{{route('agent-dashboard')}}" class="logo text-center logo-light">
        <h1 class="text-light">Agent</h1>
    </a>

    <!-- LOGO -->
    <a href="{{route('agent-dashboard')}}" class="logo text-center logo-dark">
        <h1 class="text-dark">Agent</h1>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a href="{{route('agent-dashboard')}}"  class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard</span>
                </a>
            </li>

            <li class="side-nav-title side-nav-item">Section</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="uil-layer-group"></i>
                    <span> Products </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('agent-products')}}">Products</a>
                        </li>
                        {{-- <li>
                            <a href="{{route('category')}}">Category</a>
                        </li> --}}
                    </ul>
                </div>
            </li>

        </ul>

        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
