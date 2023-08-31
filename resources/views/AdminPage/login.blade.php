<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" >
    <title>Đăng nhập</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

        <!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>



</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            </div>
                            <div class="col-lg-6 bg-login">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4  mb-4">Sign in to start your session</h1>
                                    </div>
                                    @if(session('error'))
                                        <div class="alert alert-danger">
                                            {{session('error')}}
                                        </div>
                                    @endif
                                    <form action="/login-admin" class="user" method='post'>
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                name='email'
                                                placeholder="Nhập Email ">
                                            <p style="color:red" class="help is-danger">{{ $errors->first('email') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name='password' id='password' placeholder="Nhập mật khẩu">
                                                <i id="togglePass" class="bi bi-eye-slash input-group-append"></i>
                                            <p style="color:red" class="help is-danger">{{ $errors->first('password') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input hide-pass" id="customCheck" name="customCheck">
                                                <label style="color:white" class="custom-control-label" for="customCheck">Ghi nhớ đăng nhập</label>
                                            </div>
                                        </div>
                                        <button style="text-align: center" type="submit" class="btn btn-success btn-user btn-block">Đăng nhập</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a style="color:white" href="/forget-password">Quên mật khẩu?</a>
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
    const ipnElement = document.querySelector('#password')
    const btToggle = document.querySelector('#togglePass')

    // step 2
        btToggle.addEventListener('click', function() {
        // step 3
        const currentType = ipnElement.getAttribute('type')
        // step 4
        ipnElement.setAttribute('type', currentType === 'password' ? 'text' : 'password')

        this.classList.toggle('bi-eye')
    })      
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <style>
        #togglePass {
            cursor: pointer;
            z-index: 9;
            margin: -33px 15px 10px -55px;
            position: relative;
            float: right;
        }

        .hide-pass{
        float: left;
        }
    </style>

</body>

</html>