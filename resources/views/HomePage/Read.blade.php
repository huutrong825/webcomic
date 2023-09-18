@extends('HomePage/layout_home_page')
@section('contents')

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
            @foreach($title as $t )
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Trang chủ</a>
                    <a class="breadcrumb-item text-dark" href="#">Truyện</a>
                    <a class="breadcrumb-item text-dark" href="{{ asset('/chi-tiet') }}/{{ $t->id_truyen }}">{{ $t->ten_truyen }}</a>
                    <span class="breadcrumb-item active">{{ $t->ten_chap }}</span>
                </nav>
            @endforeach                
            </div>
            <div class="col-12 align-center mb-4 " style="left:45%">
                <div class="p-2 mr-3">
                    <button class="btn btn-warning px-3"><i class="fa fa-times mr-1"></i>  Báo Lỗi </button>
                </div>
            </div>
            <div class="d-flex align-items-center mb-4 chap_turn">
                <div class="p-2 ">
                    <a href="/"><i class="fa fa-home"></i></a>
                </div>
                <div class="p-2 ">
                    @foreach($title as $t )
                    <a href="{{ asset('/chi-tiet') }}/{{ $t->id_truyen }}"><i class="fa fa-list"></i></a>
                    @endforeach
                </div>
                <div class="p-2">
                    <a class="btn btnReload" onclick="handleClick(event)"><i class="fa fa-undo"></i></a>
                </div>
                <div class="p-2 mr-3">
                    <button class="btn btn-outline-success px-3"><i class="fa fa-arrow-left mr-1"></i>Chap trước</button>
                </div>
                <div class="p-2 mr-3">
                    <select class="form-select" style="width:100%" id="select_chap" name="select_chap" >
                    @foreach($title as $t )
                        <option disabled selected hidden>{{ $t->ten_chap }}</option>
                    @endforeach
                    @foreach( $chap as $c)
                        <option value="{{ asset('/truyen') }}/{{ $c->id }}">{{ $c->ten_chap }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="p-2 mr-3">
                    <button class="btn btn-outline-danger px-3"> Chap sau <i class="fa fa-arrow-right mr-1"></i></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->
    <!-- <div class="container-fluid pb-5 read_img">
        <ul style="list-style-type:none;">
            @foreach( $img as $i)
            <li>
                <img class="review-img" src="{{ asset('/truyen_ND') }}/{{ $i->noi_dung }}" alt="Image">
            </li>
            @endforeach
        </ul>
    </div> -->

    <div class="container-fluid pb-5 read_img">
        <div class="card-body">
            <div class="area-image">
                <ul style="list-style-type:none;">
                    @foreach ($img as $i)
                    <li>
                        <img class="preview-img" src="{{ asset('truyen_ND/')}}/{{$i->noi_dung}}" alt="Image">
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        
    </div>
    <!-- Shop Detail End -->


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="d-flex align-items-center mb-4 chap_turn">
                <div class="p-2 ">
                    <a href="/"><i class="fa fa-home"></i></a>
                </div>
                <div class="p-2 ">
                    @foreach($title as $t )
                    <a href="{{ asset('/chi-tiet') }}/{{ $t->id_truyen }}"><i class="fa fa-list"></i></a>
                    @endforeach
                </div>
                <div class="p-2">
                    <a class="btn btnReload" onclick="handleClick(event)"><i class="fa fa-undo"></i></a>
                </div>
                <div class="p-2 mr-3">
                    <button class="btn btn-outline-success px-3"><i class="fa fa-arrow-left mr-1"></i>Chap trước</button>
                </div>
                <div class="p-2 mr-3">
                    <select class="form-select" style="width:100%" id="select_chap1" name="select_chap1" >
                    @foreach($title as $t )
                        <option disabled selected hidden>{{ $t->ten_chap }}</option>
                    @endforeach
                    @foreach( $chap as $c)
                        <option value="{{ asset('/truyen') }}/{{ $c->id }}">{{ $c->ten_chap }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="p-2 mr-3">
                    <button class="btn btn-outline-danger px-3"> Chap sau <i class="fa fa-arrow-right mr-1"></i></button>
                </div>
            </div>
            <div class="col-12">
                @foreach($title as $t )
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Trang chủ</a>
                    <a class="breadcrumb-item text-dark" href="#">Thể loại</a>
                    <span class="breadcrumb-item active">{{ $t->ten_truyen }}</span>
                </nav>
                @endforeach                
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Comment -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="">
                        <h4 class="mb-4">Bình luận ({{ $count }})</h4>
                        <form id="form_comment" method="post" >
                            @csrf
                            <div class="comment media mb-4">
                                @foreach ($title as $t)
                                <input id="id_truyen" name="id_truyen" value="{{ $t->id_truyen }}" hidden>
                                @endforeach
                                <textarea name="comment" class="form-control" style=" min-width:500px; max-width:100%;min-height:50px;height:100%;width:100%;" ></textarea>
                                <button id="bt_comment" class="btn btn-outline-success" style="margin-left: 10px; min-height:50px;"><i class="fa fa-paper-plane"></i></button>
                            </div>
                        </form>
                        @foreach( $comment as $cm)
                        <div class="media mb-4">
                            <img src="{{ asset('img/') }}/{{ $cm->avatar }}" alt="Image" class="img-fluid ">
                            <div class="media-body">
                                <h6>{{ $cm->name }}<small> - <i>{{ $cm->ngay_dang }}</i></small></h6>
                                <p>{{ $cm->noi_dung }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    let input = document.getElementById('select_chap');
    input.onchange = (e) => {
        var data = $('#select_chap').val();
        window.location.href = data;
    };

    let input1 = document.getElementById('select_chap1');
    input1.onchange = (e) => {
        var data = $('#select_chap1').val();
        window.location.href = data;
    };
</script>
<script>
    function handleClick(event) {
        location.reload();
    }
</script>

@endsection

