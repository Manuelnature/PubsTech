<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PubsTech</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">



  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">


  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css') }}">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{ asset('plugins/dropzone/min/dropzone.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">


  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


    <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>  <!-- JQuery has to be moved up because of datatables in some pages -->
</head>


<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  {{-- <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> --}}

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">PubsTech</a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
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
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
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

      {{-- <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
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
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
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
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PubsTech</span>
    </a>

    @php
        $user_session_details = Session::get('user_session');
    @endphp

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user1.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ ucwords(trans($user_session_details->first_name ))}} {{ ucwords(trans($user_session_details->last_name)) }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        @if ($user_session_details->role != NULL || $user_session_details->role != '')
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

                @if ($user_session_details->role == 'Retailer')
                    <li class="nav-item">
                        <li class="nav-link {{ Request::segment(1) === 'retailer_dashboard' ? 'active' : null }}">
                            <a href="{{ url('retailer_dashboard' )}}" >
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    </li>
                @else
                    <li class="nav-item">
                        <li class="nav-link {{ Request::segment(1) === 'home' ? 'active' : null }}">
                            <a href="{{ url('home' )}}" >
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    </li>
                @endif

                @if ($user_session_details->role == 'Super Admin' || $user_session_details->role == 'Admin')
                    <li class="nav-item">
                        <li class="nav-link {{ Request::segment(1) === 'product' ? 'active' : null }}">
                            <a href="{{ url('product' )}}" >
                                <i class="nav-icon fab fa-product-hunt"></i>
                                <p>Product</p>
                            </a>
                        </li>
                    </li>
                    <li class="nav-item">
                        <li class="nav-link {{ Request::segment(1) === 'warehouse' ? 'active' : null }}">
                            <a href="{{ url('warehouse' )}}" >
                                <i class="nav-icon fas fa-warehouse"></i>
                                <p>Warehouse</p>
                            </a>
                        </li>
                    </li>

                    <li class="nav-item">
                        <li class="nav-link {{ Request::segment(1) === 'transfer' ? 'active' : null }}">
                            <a href="{{ url('transfer' )}}" >
                                <i class="nav-icon fas fa-dolly-flatbed"></i>
                                <p>Transfers</p>
                            </a>
                        </li>
                    </li>
                @endif

                <li class="nav-item">
                    <li class="nav-link {{ Request::segment(1) === 'retailing' ? 'active' : null }}">
                        <a href="{{ url('retailing' )}}" >
                            <i class="nav-icon fas fa-wine-bottle"></i>
                            <p>Sales</p>
                        </a>
                    </li>
                </li>

                <li class="nav-item">
                    <li class="nav-link {{ Request::segment(1) === 'profile' ? 'active' : null }}">
                        <a href="{{ url('profile' )}}" >
                            <i class="nav-icon fas fa-id-card"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                </li>

                @if ($user_session_details->role == 'Super Admin')
                    <li class="nav-item">
                        <li class="nav-link {{ Request::segment(1) === 'users' ? 'active' : null }}">
                            <a href="{{ url('users' )}}" >
                                <i class="nav-icon fas fa-users nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    </li>
                @endif

                <li class="nav-header">CAR WASHING BAY</li>
                @if ($user_session_details->role == 'Super Admin' || $user_session_details->role == 'Admin')
                    <li class="nav-item">
                        <li class="nav-link {{ Request::segment(1) === 'vehicles' ? 'active' : null }}">
                            <a href="{{ url('vehicles' )}}" >
                                <i class="nav-icon fas fa-id-card"></i>
                                <p>Vehicles</p>
                            </a>
                        </li>
                    </li>

                    <li class="nav-item">
                        <li class="nav-link {{ Request::segment(1) === 'services' ? 'active' : null }}">
                            <a href="{{ url('services' )}}" >
                                <i class="nav-icon fas fa-id-card"></i>
                                <p>Services</p>
                            </a>
                        </li>
                    </li>
                    <li class="nav-item">
                        <li class="nav-link {{ Request::segment(1) === 'pricing' ? 'active' : null }}">
                            <a href="{{ url('pricing' )}}" >
                                <i class="nav-icon fas fa-id-card"></i>
                                <p>Pricing</p>
                            </a>
                        </li>
                    </li>
                    <li class="nav-item">
                        <li class="nav-link {{ Request::segment(1) === 'washers' ? 'active' : null }}">
                            <a href="{{ url('washers' )}}" >
                                <i class="nav-icon fas fa-id-card"></i>
                                <p>Car Washers</p>
                            </a>
                        </li>
                    </li>
                    <li class="nav-item">
                        <li class="nav-link {{ Request::segment(1) === 'washer_debt' ? 'active' : null }}">
                            <a href="{{ url('washer_debt' )}}" >
                                <i class="nav-icon fas fa-id-card"></i>
                                <p>Car Washer Debts</p>
                            </a>
                        </li>
                    </li>
                @endif
                <li class="nav-item">
                    <li class="nav-link {{ Request::segment(1) === 'washing_transaction' ? 'active' : null }}">
                        <a href="{{ url('washing_transaction' )}}" >
                            <i class="nav-icon fas fa-id-card"></i>
                            <p>Transactions</p>
                        </a>
                    </li>
                </li>

                <li class="nav-item">
                    <li class="nav-link {{ Request::segment(1) === 'logout' ? 'active' : null }}">
                        <a href="{{ url('logout' )}}" >
                            <i class="nav-icon far fa-circle nav-icon"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </li>

                {{-- <a href="{{url('logout')}}" class="nav-link">
                    <i class="nav-icon far fa-circle nav-icon"></i>
                        <p>
                            Logout
                        </p>
                </a> --}}
            </ul>
        @endif
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>




  @yield('content')
  @include('sweetalert::alert')


  {{-- <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="#">Manuel Consult</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b>
    </div>
  </footer> --}}

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
{{-- <script src="plugins/jquery/jquery.min.js"></script> --}}



<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

<!-- InputMask -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- BS-Stepper -->
<script src="{{ asset('plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<!-- dropzonejs -->
<script src="{{ asset('plugins/dropzone/min/dropzone.min.js') }}"></script>

<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>



<!-- AdminLTE App -->
{{-- <script src="dist/js/adminlte.min.js"></script> --}}

{{-- <script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script> --}}
<!-- Page specific script -->

@yield('Dashboard_JS')
@yield('Extra_JS')
@yield('Product_JS')
@yield('Service_JS')
@yield('LoadImage_JS')


</body>
</html>
