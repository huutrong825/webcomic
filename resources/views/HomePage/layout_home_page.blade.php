<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    @foreach ($infopage as $i)
    <title>{{ $i->ten_web }} - {{  $i->tieu_de }}</title> 
    @endforeach   
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/admin_img/logo.ico') }}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="/" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">DamMe</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Truyen</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="{{ asset('/search') }}">
                    <div class="input-group">
                        <input type="text" name="keySearch" class="form-control" placeholder="Nhập để tìm truyện">
                            <div class="input-group-append">
                                <button class="input-group-text bg-transparent text-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                    </div>
                </form>
            </div>
            @auth
            <div class="navbar-nav ml-auto py-0 d-none d-lg-block ">
                <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a  class="nav-link dropdown-toggle"  id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600"></span>
                                <img class="img-profile rounded-circle" style="width:40px; height:40px; border:1px solid #FFD333" src="{{ asset('img') }}/{{ Auth::User()->avatar }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ asset('/kho-luu-tru') }}">
                                    <i class="fas fa-bookmark fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Truyện theo dõi
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"  href="{{ asset('/profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                @if (Auth::User()->group_role != 3)
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ asset('/admin') }}">
                                    <i class="fas fa-user-tie fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Trang Admin
                                </a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"  href="{{ asset('/logout') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
            </div>
            @else
            <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                <a href="" class="btn px-0">
                    <button type="button" class="btn btn-outline-primary" id="bt-regein">Đăng ký</button>
                </a>
                <a href="" class="btn px-0 ml-3">
                    <button type="button" class="btn btn-outline-primary" id="bt-login">Đăng nhập</button>
                </a>
            </div>
            @endauth
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Modal Login -->
    <div class="modal hide fade in" data-backdrop="static" id="modal-login" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-contents ">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">ĐĂNG NHẬP</h1>
                    </div>
                    <form id="form_login" class="user" >
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" name='email'  placeholder="Nhập Email ">
                        </div>
                        <div class="form-group input-group">
                            <input type="password" class="form-control form-control-user" name='password' id="ipnPassword" placeholder="Nhập mật khẩu">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="btnPassword">
                                    <span id="icopass" class="bi bi-eye-slash"></span>
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox ">
                                <input type="checkbox" class="custom-control-input" id="customCheck" name="customCheck">
                                <label class="custom-control-label" for="customCheck"> Ghi nhớ đăng nhập </label>
                            </div>
                        </div>
                        <div style="">
                            <button style="text-align: center" id="sub_Login" class="btn btn-outline-warning btn-user ">Đăng nhập</button>
                            <button style="text-align: center" id="bt-cancel-1" class="btn btn-outline-danger">Hủy</button>
                        </div>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a style="color:black" href="#"> Đăng ký </a> |
                        <a style="color:black" href="#"> Quên mật khẩu ? </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login End -->

    <!-- Modal Regein -->
    <div class="modal hide fade in" data-backdrop="static" id="modal-regein" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-contents ">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">ĐĂNG KÝ MỚI</h1>
                    </div>
                    <form id="form_regin" class="user" >
                        @csrf
                        <div class="form-group ">
                            <input type="email" class="form-control form-control-user" name='email'  placeholder="Nhập Email ">
                        </div>
                        <div class="form-group input-group">
                            <input type="password" class="form-control form-control-user" id="ipnPassword2" name='password' placeholder="Nhập mật khẩu">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="btnPassword2">
                                    <span id="icopass2" class="bi bi-eye-slash"></span>
                                </button>
                            </div>
                        </div>
                        <!-- <div class="form-group ">
                            <input type="password" name='customCheck' placeholder="Mã xác nhận">
                            <label for="customCheck"> Ghi nhớ đăng nhập </label>
                        </div> -->
                        <div style="text-align: right">
                            <button style="text-align: center" id="sub_reg" class="btn btn-outline-warning btn-user ">Đăng ký</button>
                            <button style="text-align: center" id="bt-cancel-2" class="btn btn-outline-danger">Hủy</button>
                        </div>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a style="color:blue" href="#"> Đăng nhập </a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Regein End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block me" onclick="myFunction()">
                <a class="d-flex align-items-center justify-content-between bg-primary w-100"  style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Thể loại</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="http://127.0.0.1:8000/" class="nav-item nav-link active">Trang chủ</a>
                            <a href="{{ asset('/loai-truyen/2') }}" class="nav-item nav-link">Manga</a>
                            <a href="{{ asset('/loai-truyen/1') }}" class="nav-item nav-link">Truyện chữ</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Xếp hạng <i class="fa fa-angle-down mt-1"></i></a>
                                <div class="dropdown-menu bg-primary m-0">
                                    <!-- <a href="#" class="dropdown-item">Top Ngày</a>
                                    <a href="#" class="dropdown-item">Top Tuần</a>
                                    <a href="#" class="dropdown-item">Top Tháng</a> -->
                                    <a href="/lay-top/1" class="dropdown-item">Yêu Thích</a>
                                    <a href="/lay-top/2" class="dropdown-item">Theo dõi</a>
                                    <a href="/lay-top/3" class="dropdown-item">Lượt xem</a>
                                </div>
                            </div>
                            <a href="{{ asset('/info-page')  }}" class="nav-item nav-link">Thông tin</a>
                        </div>                        
                    </div>
                </nav>
            </div>
        </div>
        <div id="menu_TL" class=" ma">
            <div class=" theloai1">
                @foreach($theloai as $t)
                <a href="{{ asset('/search') }}/{{ $t->id }}" class="nav-item nav-link">{{ $t->the_loai }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!--Body main -->
    @yield('contents')
    <!--Body end -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">
                <a href="/" class="text-decoration-none">
                    <span class="h4 text-uppercase text-primary bg-dark px-2">DamMe</span>
                    <span class="h4 text-uppercase text-dark bg-primary px-2 ml-n1">Truyen</span>
                </a>
                </h5>
                <p class="mb-4">Mọi thông tin và hình ảnh trên website đều được sưu tầm trên Internet. Chúng tôi không sở hữu hay chịu trách nhiệm bất kỳ thông tin nào trên web này. Nếu làm ảnh hưởng đến cá nhân hay tổ chức nào, khi được yêu cầu, chúng tôi sẽ xem xét và gỡ bỏ ngay lập tức.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i></p>
                @foreach ($infopage as $i)
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{ $i->email }}</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>{{ $i->phone }}</p>
                @endforeach                
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Thể loại</h5>
                        <div  style="position: absolute;">
                            <div class="">
                                @foreach($theloai as $t)
                                <a style='color:white' href="{{ asset('/search') }}/{{ $t->id }}">{{ $t->the_loai }}</a> |
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">My Homepage</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="/"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="{{ asset('/loai-truyen/2') }}"><i class="fa fa-angle-right mr-2"></i>Manga</a>
                            <a class="text-secondary mb-2" href="{{ asset('/loai-truyen/1') }}"><i class="fa fa-angle-right mr-2"></i>Truyện chữ</a>
                            <a class="text-secondary mb-2" href="{{ asset('/loai-truyen/1') }}"><i class="fa fa-angle-right mr-2"></i>Đoản văn</a>
                            <a class="text-secondary" href="{{ asset('/info-page')  }}"><i class="fa fa-angle-right mr-2"></i>Thông tin</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Follow Us</h5>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="https://www.facebook.com/vu.jun.330"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    Damme Truyen - Web đọc truyện online &copy; 2023 by
                    <a class="text-primary" href="https://www.facebook.com/vu.jun.330">Trong Huu</a>
                </p>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- toger mode dark  -->
    <div class="icon-bar">
    </div>
    


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    @yield('scripts')

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>


    <!-- JavaScript -->
    <script src="{{ asset('//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js') }}"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css') }}"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="{{ asset('//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css') }}"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="{{ asset('//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css') }}"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="{{ asset('//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css') }}"/>
    

    <!-- Contact Javascript File -->
    <!-- <script src="{{ asset('mail/jqBootstrapValidation.min.js') }}"></script> -->
    <!-- <script src="{{ asset('mail/contact.js') }}"></script> -->

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/ajax/ajax_layout.js') }}"></script>
    <script src="{{ asset('js/ajax/ajax_viewer.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <script type="text/javascript">
        function myFunction() {
            var x = document.getElementById('menu_TL');
            if (x.style.display === 'none') {
                x.style.display = 'block';
            } else {
                x.style.display = 'none';
            }
        }
    </script>
    <!-- Like truyện -->
    <script>
        function likeClick(event) {
        var id = event.target.id;
            $.ajax({
                url:'/like/' + id,
                type:'get',
                success: function(response)
                {
                    if (response.errors) {
                        alertify.error(response.errors);
                    };
                    if (response.message) {
                        
                        alertify.success(response.message);
                        setTimeout(function() {
                            location.reload();
                        },1);
                    }; 
                },
                error: function (xhr)
                {
                    var errors = xhr.responseJSON.errors;

                    // Hiển thị thông báo lỗi
                    for (var field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            var errorMessage = errors[field][0];
                            // Xử lý hiển thị thông báo lỗi cho từng trường
                            alertify.error(errorMessage);
                        }
                    }
                }
            });
        }
    </script>
    <!-- Count view -->
    <script>
        function readClick(event) {
            var id = event.target.id;
            $.ajax({
                url:'/view/' + id,
                type:'get',
                success: function(response)
                {
                
                },
            });
        }
    </script>
    <!-- Add in Store -->
    <script>
        function handleClick(event) {
        var id = event.target.id;
            $.ajax({
                url:'/add-store/' + id,
                type:'get',
                success: function(response)
                {
                    if (response.errors) {
                        alertify.error(response.errors);
                    };
                    if (response.message) {
                        
                        alertify.success(response.message);
                        setTimeout(function() {
                            location.reload();
                        },1);
                    }; 
                },
                error: function (xhr)
                {
                    var errors = xhr.responseJSON.errors;

                    // Hiển thị thông báo lỗi
                    for (var field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            var errorMessage = errors[field][0];
                            // Xử lý hiển thị thông báo lỗi cho từng trường
                            alertify.error(errorMessage);
                        }
                    }
                }
            });
        }
    </script>
</body>

</html>