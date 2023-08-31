@extends('HomePage/layout_home_page')
@section('contents')

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                @foreach ($truyen as $t)
                    <nav class="breadcrumb bg-light mb-30">
                        <a class="breadcrumb-item text-dark" href="#">Trang chủ</a>
                        <a class="breadcrumb-item text-dark" href="#">Truyện tranh</a>
                        <span class="breadcrumb-item active">{{ $t->ten_truyen }}</span>
                    </nav>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        @foreach ($truyen as $t)
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('img_truyen/')}}/{{$t->bia_truyen}}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3 style="text-align:center">{{ $t->ten_truyen }}</h3>
                    <div class="d-flex mb-3">
                        <strong class="text-dark mr-3">Tác giả: &emsp; {{ $t->tac_gia }}</strong>
                    </div>
                    <div class="d-flex mb-4">
                        <strong class="text-dark mr-3">Trạng thái: &emsp; {{ ($t->trang_thai) == 1 ? 'Đang cập nhật' : ($t->trang_thai == 1 ? 'Đã hoàn thành' : 'Trì hoãn')}} </strong>
                    </div>
                    <div class="d-flex mb-4">
                        <strong class="text-dark mr-3">Nhóm dịch: &emsp; {{ $t->nhom_dich }}</strong>
                    </div>
                    <div class="d-flex mb-4">
                        <strong class="text-dark mr-3">Lượt theo dõi: &emsp; {{ $t->luot_theo_doi }}</strong>
                    </div>
                    <div class="d-flex mb-4">
                        <strong class="text-dark mr-3">Lượt thích: &emsp; {{ $t->luot_thich }}</strong>
                    </div>
                    <div class="d-flex mb-4">
                        <strong class="text-dark mr-3">Thể loại: </strong>
                        @foreach($TLoai as $tl)
                            <div class="chip">{{ $tl->the_loai }}</div>
                        @endforeach
                    </div>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class=" mr-3">
                            <button class="btn btn-outline-success px-3"><i class="fa fa-book mr-1"></i>Đọc từ đầu</button>
                        </div>
                        <div class=" mr-3">
                            <button class="btn btn-outline-danger px-3" id="{{ $t->id  }}" onclick="handleClick(event)"><i  id="{{ $t->id  }}" class="fa fa-bookmark mr-1"></i> Theo dõi </button>
                            <!-- <button class="btn btn-outline-danger px-3" style="display:none"><i class="fa fa-times mr-1"></i> Hủy theo dõi </button> -->
                        </div>
                        <div class=" mr-3">
                            <button class="btn btn-outline-info px-3"><i class="fa fa-heart mr-1"></i>Thích</button>
                            <button class="btn btn-outline-info px-3" style="display:none"><i class="fa fa-heart mr-1"></i>Đã Thích</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <h5>Mô tả</h5>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">{{ $t->mo_ta }} </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <h5>Danh sách chap</h5>
                    </div>
                    <div class="table-responsive">
                        <nav class="list-chap">
                        <ul class="list-group">
                            @foreach( $chap as $c)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ asset('/truyen') }}/{{ $c->id }}">{{ $c->ten_chap }}</a>
                                    <span class="badge ">{{ $c->ngay_dang }}</span>
                                </li>
                            @endforeach
                        </ul
                        ></nav>
                    </div>
                </div>
            </div>
        </div>        
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="">
                        <h4 class="mb-4">Bình luận (1)</h4>
                        <form id="form_comment" method="post" >
                            @csrf
                            <div class="comment media mb-4">
                                @foreach ($truyen as $t)
                                <input id="id_truyen" name="id_truyen" value="{{ $t->id }}" hidden>
                                @endforeach
                                <textarea name="comment" class="form-control" style=" min-width:500px; max-width:100%;min-height:50px;height:100%;width:100%;" ></textarea>
                                <button id="bt_comment" class="btn btn-outline-success" style="margin-left: 10px; min-height:50px;"><i class="fa fa-paper-plane"></i></button>
                            </div>
                        </form>
                        <div class="media mb-4">
                            <img src="admin_img/avatar.png" alt="Image" class="img-fluid ">
                            <div class="media-body">
                                <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

@endsection
@section('scripts')
<!-- <script  src="{{ asset('js/ajax/ajax_viewer.js') }}"></script> -->

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
