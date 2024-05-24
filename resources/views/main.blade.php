<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Wajib Pajak</title>

        <link rel="icon" href="{{ asset('KKP.png') }}" type="gambar/tipe ikon">
        <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/styles.min.css') }}" rel="stylesheet">
        <link href="{{ asset('sbadmin2/css/styles.css') }}" rel="stylesheet">

        <!-- DataTables CSS -->
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        {{--  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.bootstrap5.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.css"> --}}
        <link rel="stylesheet" type="css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        {{-- <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.2/dist/full.min.css" rel="stylesheet" type="text/css" /> --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
        {{--   <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.css" /> --}}
        <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.7/b-3.0.2/b-html5-3.0.2/datatables.min.css"
            rel="stylesheet">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"
            rel="stylesheet">
        <link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css" rel="stylesheet">

        <link href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css" rel="stylesheet">

        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <style>
            body {
                min-width: 360px;
                !important
                /* desired pixel value */
            }

            .bg-navy {
                background-color: #12094a;
                padding: 10px;
                border-radius: 5px;
            }

            .btn-navy {
                background-color: #12094a;
                color: #ffffff;
                transition: background-color 0.3s ease;
            }

            .btn-navy:hover {
                background-color: #adbd1e;
                border-color: #ffffff;
            }

            .font-color {
                color: #12094a;
            }

            .img-fluid {
                width: 500px;
                height: auto;
            }

            @media (min-width: 400px) {
                .sidebar-card {
                    display: none;
                }
            }

            /* .sidebar-brand-icon img {
            max-width: 70%;
            height: auto;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .sidebar-card img{
            max-width: 100%;
            height: auto;
        } */
        </style>
        {{--  @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav sidebar sidebar-dark bg-navy" id="accordionSidebar">

                    <!-- Sidebar - Brand -->
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/pajaksub">
                        <div class="sidebar-brand-icon">
                            {{-- <i class="fas fa-fw fa-user"></i> --}}
                            <img src="{{ asset('KKPLOGO.png') }}" class="img-fluid mx-auto" alt="..."
                                style="width: 100px; height:auto;">
                        </div>
                        {{-- <div class="sidebar-brand-text mx-3">Wajib Pajak</div> --}}
                    </a>

                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">
                    <div class="sidebar-menu">
                        <!-- Nav Item - Dashboard -->
                        <li class="nav-item {{ Request::is('beranda*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('beranda') }}">
                                <i class="fas fa-fw fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <!-- Nav Item - Pajak -->
                        <li class="nav-item {{ Request::is('pajaksub*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('pajakSub') }}" aria-expanded="true">
                                <i class="fas fa-fw fa-briefcase"></i>
                                <span>Pajak</span>
                            </a>
                        </li>

                        <!-- Nav Item - Pph -->
                        <li class="nav-item {{ Request::is('pphsub*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('pphSub') }}" aria-expanded="true">
                                <i class="fas fa-fw fa-briefcase"></i>
                                <span>PPH</span>
                            </a>
                        </li>

                        <!-- Nav Item - Pph 21 -->
                        <li class="nav-item {{ Request::is('pph21sub*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('pph21Sub') }}" aria-expanded="true">
                                <i class="fas fa-fw fa-briefcase"></i>
                                <span>PPH 21</span>
                            </a>
                        </li>

                        <li class="nav-item {{ Request::is('karyawansub*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('karyawanSub') }}" aria-expanded="true">
                                <i class="fas fa-fw fa-briefcase"></i>
                                <span>Daftar Karyawan</span>
                            </a>
                        </li>

                        <!-- Nav Item - Pph Unifikasi -->
                        <li class="nav-item {{ Request::is('pphunifikasisub*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('pphunifikasiSub') }}" aria-expanded="true">
                                <i class="fas fa-fw fa-briefcase"></i>
                                <span>PPH Unifikasi</span>
                            </a>
                        </li>

                        @if (auth()->user()->role == 'admin')
                            <li class="nav-item {{ Request::is('dataadmin*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('dataadmin') }}" aria-expanded="true">
                                    <i class="fas fa-fw fa-database"></i>
                                    <span>Data Admin</span>
                                </a>
                            </li>
                        @endif
                    </div>
                    <!-- Divider -->
                    <!-- Divider -->
                    <hr class="sidebar-divider d-none d-md-block">

                    <!-- Sidebar Toggler (Sidebar) -->
                    <div class="d-none d-md-inline text-center">
                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>

                    <!-- Sidebar Message -->
                    <div class="sidebar-card d-none d-lg-flex mt-4 d-inline d-md-none">
                        {{-- <img class="sidebar-card-illustration mb-2" src="{{ asset('KKPLOGO.png') }}" style="width: 100%; height:auto;" alt="..."> --}}
                        <p class="mb-2 text-center"><strong>Wajib Pajak</strong> Jangan sampai terlambat untuk membayar
                            pajak Anda!</p>
                    </div>



            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light topbar static-top mb-4 bg-white shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Search -->
                        <form
                            class="d-none d-sm-inline-block form-inline ml-md-3 my-md-0 mw-100 navbar-search my-2 mr-auto">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light small border-0"
                                    placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-navy" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right animated--grow-in p-3 shadow"
                                    aria-labelledby="searchDropdown">
                                    <form class="form-inline w-100 navbar-search mr-auto">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0"
                                                placeholder="Search for..." aria-label="Search"
                                                aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <!-- Counter - Alerts -->
                                    <span class="badge badge-danger badge-counter">3+</span>
                                </a>
                                <!-- Dropdown - Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right animated--grow-in shadow"
                                    aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">
                                        Alerts Center
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 12, 2019</div>
                                            <span class="font-weight-bold">A new monthly report is ready to
                                                download!</span>
                                        </div>
                                    </a>
                                    <!-- Add other alert items here -->
                                </div>
                            </li>

                            <!-- Nav Item - Messages -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fas fa-envelope fa-fw"></i>
                                    <!-- Counter - Messages -->
                                    <span class="badge badge-danger badge-counter">7</span>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right animated--grow-in shadow"
                                    aria-labelledby="messagesDropdown">
                                    <h6 class="dropdown-header">
                                        Message Center
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                                alt="...">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">Hi there! I am wondering if you can help me with
                                                a
                                                problem I've been having.</div>
                                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                                        </div>
                                    </a>
                                    <!-- Add other message items here -->
                                </div>
                            </li>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="d-none d-lg-inline small mr-2 text-gray-600">Wajib Pajak</span>
                                    <img class="img-profile"
                                        src="{{ asset('KKP.png') }}"style="width: 80px; height:auto;">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right animated--grow-in shadow"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity Log
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        @yield('konten')
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer">
                    <div class="container my-auto">
                        <div class="my-auto text-center">
                            <span>Copyright &copy; Wajib Pajak - 2024</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script Export Responsive -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- DataTables JavaScript -->
        {{--      <script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script> --}}

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        {{--  <script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.6/js/dataTables.bootstrap5.js"></script> --}}
        {{--  <script src="/public/datatables.js"></script> --}}

        {{--     <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
        <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
        <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script> --}}

        <script>
            const dataTable = new DataTable('datatables');
        </script>
        {{--
    <script>
        $(document).ready(function () {
            // Tambahkan kelas aktif ke elemen menu yang sesuai dengan halaman saat ini
            $('.sidebar-menu li').removeClass('active');
            $('.sidebar-menu li').each(function () {
                if ($(this).find('a').attr('href') === window.location.pathname) {
                    $(this).addClass('active');
                }
            });

            // Tangani navigasi internal (misalnya: saat tombol di dalam halaman diklik)
            $('.internal-link').click(function (event) {
                event.preventDefault(); // Hindari navigasi bawaan
                var targetUrl = $(this).attr('href');
                // Lakukan navigasi ke halaman baru
                window.location.href = targetUrl;
                // Tambahkan kelas aktif ke elemen menu yang sesuai dengan halaman yang baru dimuat
                $('.sidebar-menu li').removeClass('active');
                $('.sidebar-menu li').each(function () {
                    if ($(this).find('a').attr('href') === targetUrl) {
                        $(this).addClass('active');
                    }
                });
            });
        });

    </script> --}}

        {{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Periksa apakah halaman saat ini adalah halaman Beranda
        var isBeranda = "{{ Request::is('beranda*') ? 'true' : 'false' }}";

        // Ambil elemen item sidebar Beranda
        var sidebarItem = document.querySelector('.nav-item[href="{{ route('beranda') }}"]');

        // Jika halaman saat ini adalah halaman Beranda, tambahkan kelas 'active' pada item sidebar
        if (isBeranda === 'true' && sidebarItem) {
            sidebarItem.classList.add('active');
        }
    });
</script> --}}

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        <script src="{{ asset('sbadmin2/vendor/chart.js/Chart.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('sbadmin2/js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('sbadmin2/js/demo/chart-pie-demo.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.7/b-3.0.2/b-html5-3.0.2/datatables.min.js"></script>

        {{-- <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
        <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script> --}}

        {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
        <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
        <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
        <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>

        @stack('script')
    </body>

</html>
