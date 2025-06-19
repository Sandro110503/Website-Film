<!-- Layout Dashboard Admin -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Dashboard Admin')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">

</head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src={{ asset('dist/img/AdminLTELogo.png') }} alt="AdminLTELogo" height="60" width="60">
      </div>
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
              <i class="fas fa-bars"></i>
            </a>
          </li> 
          <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('backend.home') }}" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <form method="POST" action="{{ route('backend.logout') }}" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-link nav-link p-0" style="border: none; background: none;">
                Logout
              </button>
            </form>
          </li>
        </ul>
      </nav>

      <!-- /.navbar -->
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('backend.dashboard') }}" class="brand-link d-flex align-items-center">
          <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 mr-1" style="opacity: .8; width: 30px; height: 30px;">
          <span class="brand-text font-weight-light">Dashboard</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <a href="{{route('backend.dashboard')}}">
                <img src={{ asset("dist/img/sandro.jpg") }} class="img-circle elevation-2" alt="User Image">
              </a>
            </div>
            <div class="info">
              <a href="{{route('backend.dashboard')}}" class="d-block">Admin</a>
            </div>
          </div>
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul id="sidebarnav" class="sidebar-nav">
              <li class="nav-item">
                <a href="{{ route('backend.dashboard') }}"
                  class="nav-link {{ request()->routeIs('backend.dashboard') ? 'active' : '' }}">
                  <i class="far fa-home nav-icon"></i>
                  <span>Beranda</span>
                </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('backend.admin.film.index') }}"
                    class="nav-link {{ request()->routeIs('backend.admin.film.index') ? 'active' : '' }}">
                      <i class="far fa nav-icon"></i>
                      <span>Film</span>
                  </a>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
    @section('content')

    @show

      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <strong>FavScreen 2025.</strong>
      </footer>
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="{{ asset('dist/js/demo.js') }}"></script> -->
    <!-- AdminLTE dashboard demo -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- sweetalert End -->
    <!-- konfirmasi success-->
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}"
        });
    </script>
    @endif
    <!-- konfirmasi success End-->
    <script type="text/javascript">
        //Konfirmasi delete
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var konfdelete = $(this).data("konf-delete");
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Hapus Data?',
                html: "Data yang dihapus <strong>" + konfdelete + "</strong> tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, dihapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success')
                        .then(() => {
                            form.submit();
                        });
                }
            });
        });
    </script>

  </body>
</html>