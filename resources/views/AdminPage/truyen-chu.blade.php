@extends('AdminPage/Index')
@section('content')


    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                    <a style="float:right" class="btn btn-success" href="/admin/truyen/them-moi"> Thêm truyện mới +</a>
            </div>
        </div>
    </div>

    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            @foreach ($truyen as $t)
            <div class="col-sm-2 ">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('img_truyen/')}}/{{$t->bia_truyen}}" alt="">
                    </div>
                    <div class="text-center py-4 text-truncate">
                        <a class="h6 text-decoration-none text-truncate" href="/admin/truyen-tranh/{{ $t->id }}">{{ $t->ten_truyen }}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h8>{{ $t->ten_chap }}</h8>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{ $truyen->links() }}
    </div>
    <!-- Products End -->

@endsection
