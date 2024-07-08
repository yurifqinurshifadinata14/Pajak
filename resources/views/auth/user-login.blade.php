<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Wajib Pajak - Login</title>

    <link rel="icon" href="{{ asset('KKP.png') }}" type="gambar/tipe ikon">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        .bg-login-image {
            background-image: url('logo2.png');
            background-repeat: no-repeat;
            background-position: relative;
            width: 115%;
            height: auto;
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
    </style>

</head>

<body class="bg-navy">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            {{-- <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            </div> --}}
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <img src="{{ asset('KKP.png') }}" style="width: 150px; height:auto;" class="rounded mx-auto d-block" alt="..."
                                        width="60" height="60">
                                    <div class="text-center mt-3">
                                        <h1 class="h4 text-gray-900 mb-4"><b>Welcome Back!</b></h1>
                                    </div>
                                    <form action="{{ route('user.login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username"
                                                name="nama_wp">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="NPWP" name="npwp">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck" style="line-height: 1.5rem;">Remember Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-navy btn-user btn-block">
                                            Login
                                        </button>
                                        {{-- <hr> --}}
                                        {{-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> --}}
                                    </form>
                                    <hr>
                                    <!-- <div class="text-center">
                                        <a class="small" href="/forgot-password">Forgot Password?</a>
                                    </div> -->
                                    <!-- <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">Create an Account!</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    @if (session('loginError'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Failed!',
                text: "{{ session('loginError') }}",
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Oke'
            })
        </script>
    @endif
</body>

</html>
