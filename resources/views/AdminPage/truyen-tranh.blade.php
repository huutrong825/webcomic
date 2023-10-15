@extends('AdminPage/Index')
@section('content')


    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                    <a style="float:right" class="btn btn-success" href="{{ asset('/admin/truyen/them-moi') }}"> Thêm truyện mới +</a>
            </div>
        </div>
    </div>

    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            @foreach ($truyen as $t)
            <div class="col-sm-2 ">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden" title=" {{ $t->ten_truyen }}">
                        <img class="img-fluid w-100" src="{{ asset('img_truyen/')}}/{{$t->bia_truyen}}" alt="{{ $t->ten_truyen }}">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square bt_xoaTruyen" value="{{ $t->id }}" ><i class="fa fa-times" title="Xóa"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4 text-truncate">
                    <a class="h6 text-decoration-none text-truncate" href="{{ asset('/admin/truyen-tranh') }}/{{ $t->id }}" >{{ $t->ten_truyen }}</a>
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

    <div class="modal hide fade in" id="modal_Deleted_Truyen" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nhắc nhở</h5>
                </div>
                <div class="">
                    <input type="hidden" class="form-control form-control-user" id='idDeleteTruyen' >
                </div>
                <div class="modal-body">Xác nhận xóa truyện <span id='nameDeleteTruyen' style="color:blue"></span> (Mọi dữ liệu về truyện sẽ bị xóa)</div>
                <div class="modal-footer">
                    <a class="btn btn-primary bt_xacnhanxoa_Truyen">Xác nhận</a>
                    <button class="btn btn-danger " type="button" data-dismiss="modal">Cancel</button>                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="{{ asset('js/ajax/ajax_truyen.js') }}"></script>
@endsection
