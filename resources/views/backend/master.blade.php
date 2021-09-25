<!DOCTYPE html>
@if (Auth::user())
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="icon" type="image/png" href="{{ asset('assets/dist/img/online-shopping.ico') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
</head>


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('dashboard') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('contact') }}" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>




                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('assets/dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('assets/dist/img/user8-128x128.jpg')}}" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('assets/dist/img/user3-128x128.jpg')}}" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link">
                <img src="{{ asset('assets/dist/img/online-shopping.ico')}}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        @php
                        $name = Auth::user()->name;
                        $admin = true;
                        if (Auth::user()->roles()->first()->name == "Customer") {
                        $admin = false;
                        }
                        $nick_name = explode(' ',$name);
                        @endphp
                        <a href="{{ route('dashboard') }}" class="d-block">{{ $nick_name[0]}}
                            @if($admin) ({{ Auth::user()->roles()->first()->name ?? '' }}) @endif </a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item ">
                            <a href="{{ route('dashboard') }}" class="nav-link @yield('dashboardactive')">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    {{-- <i class="right fas fa-angle-left"></i> --}}
                                </p>
                            </a>
                        </li>

                        @can("category view")
                        <li class="nav-item @yield('catopen')">
                            <a href="#" class="nav-link @yield('categoryactive')">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Categories
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                @can("category view")
                                <li class="nav-item">
                                    <a href="{{ route('category.index') }}" class="nav-link @yield(' cviewatactive')">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>Views Category</p>
                                    </a>
                                </li>
                                @endcan
                                @can("category add")
                                <li class="nav-item">
                                    <a href="{{ route('category.create') }}" class="nav-link @yield('adcatactive')">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>Add Category</p>
                                    </a>
                                </li>
                                @endcan
                                @can("category delete")
                                <li class="nav-item">
                                    <a href="{{ route('category.trash') }}" class="nav-link @yield('trashcatactive')">
                                        <i class="fas fa-trash-alt nav-icon"></i>
                                        <p>Trashed</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcan

                        @can("subcategory view")
                        <li class="nav-item @yield('scatopen')">
                            <a href="#" class="nav-link @yield('scategoryactive')">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>
                                    SubCategory
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route("Subcategories") }}" class="nav-link @yield('sviewcatactive')">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>Views SubCategory</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('addSubcategory') }}" class="nav-link @yield('saddcatactive')">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>Add SubCategory</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('trashSubcategory') }}"
                                        class="nav-link @yield('strashcatactive')">
                                        <i class="fas fa-trash-alt nav-icon"></i>
                                        <p>Trashed SubCategory</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @can("product view")
                        <li class="nav-item @yield('productopen')">
                            <a href="#" class="nav-link @yield('productactive')">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Products
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>
                            @can("product view")
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('products.view') }}"
                                        class="nav-link @yield('productviewcatactive')">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>Views Products</p>
                                    </a>
                                </li>
                                @endcan
                                @can("product add")
                                <li class="nav-item">
                                    <a href="{{ route('ProductForm') }}" class="nav-link @yield('productaddcatactive')">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>Add Product</p>
                                    </a>
                                </li>
                                @endcan
                                @can("product view")
                                <li class="nav-item">
                                    <a href="{{ route('TrashedProduct') }}"
                                        class="nav-link @yield('producttrashcatactive')">
                                        <i class="fas fa-trash-alt nav-icon"></i>
                                        <p>Trashed Products</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcan
                        @can("size view")
                        <li class="nav-item @yield('sizeopen')">
                            <a href="#" class="nav-link @yield('sizeactive')">
                                <i class="nav-icon fas fa-palette"></i>
                                <p>
                                    Sizes and Color
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can("size view")
                                <li class="nav-item">
                                    <a href="{{ route('CreateSize') }}" class="nav-link @yield('sizeviewactive')">
                                        <i class="nav-icon fas fa-size"></i>
                                        <p>Sizes</p>
                                    </a>
                                </li>@endcan
                                @can("color view")
                                <li class="nav-item">
                                    <a href="{{ route('CreateColor') }}" class="nav-link @yield('colorviewactive')">
                                        <i class="nav-icon fas fa-palette "></i>
                                        <p>Colors</p>
                                    </a>
                                </li>@endcan
                            </ul>
                        </li>@endcan

                        @can("coupon view")
                        <li class="nav-item @yield('couponOpen')">
                            <a href="#" class="nav-link @yield('couponActive')">
                                <i class="nav-icon fas fa-gift"></i>
                                <p>
                                    Coupon
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item ">
                                    <a href="{{ route('coupon.index') }}" class="nav-link @yield('couponIndexactive')">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>
                                            Coupon List
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('coupon.create') }}"
                                        class="nav-link @yield('couponCreateActive')">
                                        <i class="nav-icon fas fa-plus "></i>
                                        <p>Add Coupon</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('coupon.trash')}}" class="nav-link @yield('couponDestroyactive')">
                                        <i class="fas fa-trash-alt nav-icon"></i>
                                        <p>Trash Coupon</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @can('assign user')
                        <li class="nav-item @yield('roleOpen')">
                            <a href="#" class="nav-link @yield('roleActive')">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>
                                    User Role Manager
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item ">
                                    <a href="{{ route('role.index') }}" class="nav-link @yield('roleIndexactive')">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>
                                            Roles
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="{{ route('role.create') }}" class="nav-link @yield('couponCreateactive')">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>
                                            Add Role
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item ">
                                    <a href="{{ route('assignuser.index') }}"
                                        class="nav-link @yield('assignUseractive')">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>
                                            Assign User
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="{{ route('add.user.index') }}" class="nav-link @yield('adduserseractive')">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>
                                            Add User
                                        </p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endcan


                        <li class="nav-item ">
                            <a href="{{ route('Frontend') }}" class="nav-link" target="blank">
                                @role('Customer')
                                <i class="nav-icon  fas fa-cart-plus"></i>
                                <p> Shop </p>
                                @else
                                <i class="nav-icon  fas fa-home"></i>
                                <p> Frontend </p>
                                @endrole
                            </a>
                        </li>




                        {{-- logout --}}
                        <form id="form-logout" action="{{route('logout')}}" method="POST">
                            <li class="nav-item pull-bottom ">
                                <a href="{{ route('logout') }}" class="nav-link"
                                    onclick="event.preventDefault();document.getElementById('form-logout').submit()">
                                    <i class="nav-icon  fas fa-sign-out-alt"></i>
                                    <p class="btn btn-outline-danger">
                                        Logout
                                        {{-- <i class="right fas fa-angle-left"></i> --}}
                                    </p>
                                </a>
                            </li>

                            @csrf
                        </form>


                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>


        @yield('content');



        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('assets/plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/dist/js/demo.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('assets/dist/js/pages/dashboard.js')}}"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    @yield("toastr_js");
    @yield("footer_js");


</body>


</html>

@else
<script>
    window.location.replace = "/login";
</script>
@endif
