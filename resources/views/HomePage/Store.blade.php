@extends('HomePage/layout_home_page')
@section('contents')

    
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Trang chủ</a>
                    <a class="breadcrumb-item text-dark" href="#">Truyện theo dõi</a>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- List find -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            @empty($truyen)
            <div class="container-fluid" >
                    <div class=" px-xl-5">
                        <div class=" h-auto mb-30">
                                <h5 style="text-align:center">Chưa có truyện được lưu vào</h5>
                        </div>
                    </div>
                </div>
            @else
            @foreach ($truyen as $t)
                <div class="col-sm-2 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('img_truyen/') }}/{{ $t->bia_truyen }}" alt="{{ $t->ten_truyen }}">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" id="{{ $t->id  }}" onclick="handleClick(event)"><i id="{{ $t->id  }}" class="fa fa-check" title="Đang theo dõi"></i></a>
                                <a class="btn btn-outline-dark btn-square" id="{{ $t->id }}" onclick="likeClick(event)"><i id="{{ $t->id }}" class="far fa-heart" title="Thích"></i></a>
                                <a class="btn btn-outline-dark btn-square" id="{{ $t->id }}" onclick="readClick(event)" href="{{ asset('/chi-tiet') }}/{{ $t->id }}"><i id="{{ $t->id }}" class="fa fa-eye" title="Đọc"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4 text-truncate">
                            <a class="h6 text-decoration-none text-truncate" id="{{ $t->id }}" onclick="readClick(event)" href="{{ asset('/chi-tiet') }}/{{ $t->id }}" title="{{ $t->ten_truyen }}">{{ $t->ten_truyen }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h8>{{ $t->ten_chap }}</h8>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
            @endempty
        </div>
    </div>
    <!-- End -->

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
