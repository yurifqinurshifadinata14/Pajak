<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Wajib Pajak - Forgot Password</title>

    <link rel="icon" href="{{asset('logo.png')}}" type="gambar/tipe ikon">
    <!-- Custom fonts for this template-->
    <link href="{{asset ('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset ('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>

        .bg-password-image {
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
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <img src="{{ asset('logo.png') }}" class="rounded mx-auto d-block" alt="..." width="60" height="60">
                                    <div class="text-center mt-3">
                                        <h1 class="h4 text-gray-900 mb-2"><b>Forgot Your Password?</b></h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Email">
                                        </div>
                                        <a href="/login" class="btn btn-navy btn-user btn-block">
                                            Reset Password
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="/register">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="/login">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset ('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{asset ('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset ('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset ('js/sb-admin-2.min.js') }}"></script>

</body>

</html>
