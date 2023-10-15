@extends('HomePage/layout_home_page')
@section('contents')

    
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                @if(isset($theloai1))
                @foreach($theloai1 as $th)
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Trang chủ</a>
                    <a class="breadcrumb-item text-dark" href="#">Tìm kiếm</a>
                    <span class="breadcrumb-item active">{{ $th->the_loai }}</span>
                </nav>
                @endforeach
                @elseif (isset($key))
                    <nav class="breadcrumb bg-light mb-30">
                        <a class="breadcrumb-item text-dark" href="#">Trang chủ</a>
                        <a class="breadcrumb-item text-dark" href="#">Tìm kiếm</a>
                        <span class="breadcrumb-item active">{{ $key }}</span>
                    </nav>
                @endif
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Fill sort -->
    <!-- <div class="container-fluid" >
        <div class=" px-xl-5">
            <div class=" h-auto mb-30">
                <div class=" bg-light p-30  text-align-center">
                    <div class="d-flex mb-3 text-align-center">
                        <strong class="text-dark mr-3">Thể loại: </strong>
                        <select style="text-align:center; width:500px" class="form-select ">
                            @foreach($theloai as $th)
                                <option >{{ $th->the_loai }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex mb-4">
                        <strong class="text-dark mr-3">Trạng thái: </strong>
                        <div class="d-flex align-items-center mb-4 pt-2">
                            <div class=" mr-3">
                                <button class="btn btn-outline-success  px-3"> Đang cập nhật</button>
                            </div>
                            <div class=" mr-3">
                                <button class="btn btn-outline-danger px-3"> Đã hoàn thành</button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <strong class="text-dark mr-3">Sắp xếp: </strong>
                        <select style="text-align:center; width:400px" class="form-select">
                            <option>Ngày đăng giảm dần</option>
                            <option>Ngày đăng tăng dần</option>
                            <option>Ngày cập nhật giảm dần</option>
                            <option>Ngày cập nhật tăng dần</option>
                            <option>Lượt xem giảm dần</option>
                            <option>Lượt xem tăng dần</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- End -->

    <!-- List find -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            @if ($truyen->isEmpty())
            <div class="container-fluid" >
                    <div class=" px-xl-5">
                        <div class=" h-auto mb-30">
                                <h5 style="text-align:center">Không tìm thấy truyện cần tìm</h5>
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
                            @php
                                $found = false;
                            @endphp
                            @foreach($checkstores as $tk)                                
                                    @if ($t->id == $tk->id_truyen && $tk->id_viewer == Auth::id())
                                        @php
                                            $found = true;
                                            break;
                                        @endphp
                                    @endif
                                    
                            @endforeach
                            @if ($found)
                                <a class="btn btn-outline-dark btn-square" id="{{ $t->id }}" onclick="handleClick(event)"><i id="{{ $t->id }}" class="fa fa-check" title="Hủy lưu"></i></a>
                            @else
                                <a class="btn btn-outline-dark btn-square" id="{{ $t->id }}" onclick="handleClick(event)"><i id="{{ $t->id }}" class="fa fa-bookmark" title="Lưu"></i></a>
                            @endif
                                <a class="btn btn-outline-dark btn-square" id="{{ $t->id }}" onclick="likeClick(event)"><i class="far fa-heart" title="Thích"></i></a>
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

    {{ $truyen->links() }}

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
