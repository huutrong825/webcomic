@extends('HomePage/layout_home_page')
@section('contents')
    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        @foreach($banners as $b)
                        @if ($b->loai_banner == 1)
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <a href="{{ asset('/chi-tiet') }}/{{ $b->id_truyen }}" >
                                <img class="position-absolute w-10 h-100" style="object-fit: cover;" src="{{ asset('img_truyen/') }}/{{ $b->image }}" alt="{{ $b->ten_truyen }}" title="{{ $b->ten_truyen }}" >
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">{{ $b->ten_truyen }}</h1>
                                    <!-- <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p> -->
                                    
                                </div>
                            </div>
                            </a>
                        </div>
                        @endif
                        @endforeach
                        
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-10 h-100" src="img_truyen/tan_lang_danh_mat.jpg">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Tân lang đánh mất</h1>
                                    <!-- <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p> -->
                                    
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-10 h-100" src="img_truyen/one_punch_man.jpg" >
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">One Punch Man</h1>
                                    <!-- <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p> -->
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                @foreach($banners as $b)
                @if ($b->loai_banner == 2)
                <div class="product-offer mb-30" style="height: 200px;">
                    <a href="{{ asset('/chi-tiet') }}/{{ $b->id_truyen }}" >
                        <img class="img-fluid" src="{{ asset('img_truyen/') }}/{{ $b->image }}" alt="{{ $b->ten_truyen }}" title="{{ $b->ten_truyen }}" >
                    </a>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- Carousel End -->




    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Truyện mới cập nhật</span></h2>
        <div class="row px-xl-5">
            @foreach ($update as $u)
            <div class="col-sm-2 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('img_truyen/') }}/{{ $u->bia_truyen }}" alt="{{ $u->ten_truyen }}">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-bookmark" title="Lưu"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart" title="Thích"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="{{ asset('/chi-tiet') }}/{{ $u->id }}"><i class="fa fa-eye" title=""></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4 text-truncate">
                        <a class="h6 text-decoration-none text-truncate" href="{{ asset('/chi-tiet') }}/{{ $u->id }}">{{ $u->ten_truyen }}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h8>{{ $u->ten_chap }}</h8>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Products End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Truyện mới đề xuất</span></h2>
        <div class="row px-xl-5">
            @foreach( $near as $n)
            <div class="col-sm-2 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('img_truyen/') }}/{{ $n->bia_truyen }}" alt="{{ $n->ten_truyen }}">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-bookmark" title="Lưu"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart" title="Thích"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="{{ asset('/chi-tiet') }}/{{ $n->id }}"><i class="fa fa-eye" title=""></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4 text-truncate">
                        <a class="h6 text-decoration-none text-truncate" href="{{ asset('/chi-tiet') }}/{{ $n->id }}">{{ $n->ten_truyen }}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h8>{{ $n->ten_chap }}</h8>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Products End -->

    <!-- Offer Start -->
    <!-- <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="img/offer-1.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="img/offer-2.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Offer End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Tất cả</span></h2>
        <div class="row px-xl-5">
            @foreach ($all as $a)
            <div class="col-sm-2 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('img_truyen/') }}/{{ $a->bia_truyen }}" alt="{{ $a->ten_truyen }}">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" id="{{ $a->id  }}" onclick="handleClick(event)"><i id="{{ $a->id  }}" class="fa fa-bookmark" title="Lưu"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart" title="Thích"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="{{ asset('/chi-tiet') }}/{{ $a->id }}"><i class="fa fa-eye" title="Đọc"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4 text-truncate">
                        <a class="h6 text-decoration-none text-truncate" href="{{ asset('/chi-tiet') }}/{{ $a->id }}">{{ $a->ten_truyen }}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h8>{{ $a->ten_chap }}</h8>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Products End -->


    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    @foreach($banners as $b)
                    @if ($b->loai_banner == 3)
                    <div class="bg-light p-4">
                        <a href="{{ asset('/chi-tiet') }}/{{ $b->id_truyen }}" >
                            <img class="s-10" src="{{ asset('img_truyen/') }}/{{ $b->image }}" alt="{{ $b->ten_truyen }}" title="{{ $b->ten_truyen }}" >
                        </a>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->

@endsection

@section('scripts')

<script>
    function handleClick(event) {
      var id = event.target.id;
        $.ajax({
            url:'/add-store/' + id,
            type:'get',
            // dataType: 'json',
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            // },
            success: function(response)
            {
                if (response.errors) {
                    alertify.error(response.errors);
                };
                if (response.message) {
                    
                    alertify.success(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
@endsection
