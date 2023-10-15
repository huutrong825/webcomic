@extends('HomePage/layout_home_page')
@section('contents')
    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                <ol class="carousel-indicators">
                        @php
                            $count = 0;
                        @endphp
                        @foreach($banners as $b)
                            @if ($b->loai_banner == 1)
                                <li data-target="#header-carousel" data-slide-to="{{ $count++}}" class="{{ $b->id == $min->id ? 'active': '' }}"></li>                                
                            @endif                            
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($banners as $b)
                            @if ($b->loai_banner == 1)
                            <div class="carousel-item position-relative {{ $b->id == $min->id ? 'active': '' }}" style="height: 430px;">
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
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                @foreach($banners as $b)
                @if ($b->loai_banner == 2)
                <div class="product-offer mb-30" style="height: 200px;">
                    <a id="{{ $b->id_truyen }}" onclick="readClick(event)" href="{{ asset('/chi-tiet') }}/{{ $b->id_truyen }}" >
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
                            @php
                                $found = false;
                            @endphp
                            @foreach($checkstores as $tk)                                
                                    @if ($u->id == $tk->id_truyen && $tk->id_viewer == Auth::id())
                                        @php
                                            $found = true;
                                            break;
                                        @endphp
                                    @endif
                                    
                            @endforeach
                            @if ($found)
                                <a class="btn btn-outline-dark btn-square" id="{{ $u->id  }}" onclick="handleClick(event)"><i id="{{ $u->id  }}" class="fa fa-check" title="Hủy lưu"></i></a>
                            @else
                                <a class="btn btn-outline-dark btn-square" id="{{ $u->id  }}" onclick="handleClick(event)"><i id="{{ $u->id  }}" class="fa fa-bookmark" title="Lưu"></i></a>
                            @endif
                            <a class="btn btn-outline-dark btn-square" id="{{ $u->id }}" onclick="likeClick(event)"><i class="far fa-heart" title="Thích"></i></a>
                            <a class="btn btn-outline-dark btn-square" id="{{ $u->id }}" onclick="readClick(event)" href="{{ asset('/chi-tiet') }}/{{ $u->id }}"><i id="{{ $u->id }}" class="fa fa-eye" title=""></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4 text-truncate">
                        <a class="h6 text-decoration-none text-truncate" id="{{ $u->id }}" onclick="readClick(event)" href="{{ asset('/chi-tiet') }}/{{ $u->id }}">{{ $u->ten_truyen }}</a>
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
                            @php
                                $found = false;
                            @endphp
                            @foreach($checkstores as $tk)                                
                                    @if ($n->id  == $tk->id_truyen && $tk->id_viewer == Auth::id())
                                        @php
                                            $found = true;
                                            break;
                                        @endphp
                                    @endif
                                    
                            @endforeach
                            @if ($found)
                                <a class="btn btn-outline-dark btn-square" id="{{ $n->id   }}" onclick="handleClick(event)"><i id="{{ $n->id }}" class="fa fa-check" title="Hủy lưu"></i></a>
                            @else
                                <a class="btn btn-outline-dark btn-square" id="{{ $n->id   }}" onclick="handleClick(event)"><i id="{{ $n->id }}" class="fa fa-bookmark" title="Lưu"></i></a>
                            @endif
                            <a class="btn btn-outline-dark btn-square" id="{{ $n->id }}" onclick="likeClick(event)"><i class="far fa-heart" title="Thích"></i></a>
                            <a class="btn btn-outline-dark btn-square" id="{{ $n->id }}" onclick="readClick(event)" href="{{ asset('/chi-tiet') }}/{{ $n->id }}"><i id="{{ $n->id }}" class="fa fa-eye" title=""></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4 text-truncate">
                        <a class="h6 text-decoration-none text-truncate" id="{{ $n->id }}" onclick="readClick(event)" href="{{ asset('/chi-tiet') }}/{{ $n->id }}">{{ $n->ten_truyen }}</a>
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
                            @php
                                $found = false;
                            @endphp
                            @foreach($checkstores as $tk)                                
                                    @if ($a->id == $tk->id_truyen && $tk->id_viewer == Auth::id())
                                        @php
                                            $found = true;
                                            break;
                                        @endphp
                                    @endif
                                    
                            @endforeach
                            @if ($found)
                                <a class="btn btn-outline-dark btn-square" id="{{ $a->id }}" onclick="handleClick(event)"><i id="{{ $a->id }}" class="fa fa-check" title="Hủy lưu"></i></a>
                            @else
                                <a class="btn btn-outline-dark btn-square" id="{{ $a->id }}" onclick="handleClick(event)"><i id="{{ $a->id }}" class="fa fa-bookmark" title="Lưu"></i></a>
                            @endif
                            <a class="btn btn-outline-dark btn-square" id="{{ $a->id }}" onclick="likeClick(event)"><i id="{{ $a->id }}" class="far fa-heart" title="Thích"></i></a>
                            <a class="btn btn-outline-dark btn-square" id="{{ $a->id }}" onclick="readClick(event)" href="{{ asset('/chi-tiet') }}/{{ $a->id }}"><i id="{{ $a->id }}" class="fa fa-eye" title="Đọc"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4 text-truncate">
                        <a class="h6 text-decoration-none text-truncate" id="{{ $a->id }}" onclick="readClick(event)" href="{{ asset('/chi-tiet') }}/{{ $a->id }}">{{ $a->ten_truyen }}</a>
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
                        <a id="{{ $b->id_truyen }}" onclick="readClick(event)" href="{{ asset('/chi-tiet') }}/{{ $b->id_truyen }}" >
                            <img id="{{ $b->id_truyen }}" class="s-10" src="{{ asset('img_truyen/') }}/{{ $b->image }}" alt="{{ $b->ten_truyen }}" title="{{ $b->ten_truyen }}" >
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
@endsection
