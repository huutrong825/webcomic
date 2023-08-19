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
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart" title="Thích"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{ asset('/chi-tiet') }}/{{ $t->id }}"><i class="fa fa-eye" title="Đọc"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4 text-truncate">
                            <a class="h6 text-decoration-none text-truncate" href="{{ asset('/chi-tiet') }}/{{ $t->id }}" title="{{ $t->ten_truyen }}">{{ $t->ten_truyen }}</a>
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
                    <div class="bg-light p-4">
                        <img class="s-10" src="{{ asset('img_truyen/kimetsu_no_yaiba.jpg') }}" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img class="s-10" src="{{ asset('img_truyen/tat_da.jpg') }}" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img class="s-10" src="{{ asset('img_truyen/thien_quan_tu_phuc.jpg') }}" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img class="s-10" src="{{ asset('img_truyen/hay_khien_toi_ghet_cau.jpg') }}" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img class="s-10" src="{{ asset('img_truyen/ma_dao_to_su.jpg') }}" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img class="s-10" src="{{ asset('img_truyen/tham_thang.jpg') }}" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img class="s-10" src="{{ asset('img_truyen/nguoi_la_ben_bo_bien.jpg') }}" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img class="s-10" src="{{ asset('img_truyen/da_tung_la_anh.jpg') }}" alt="">
                    </div>
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
