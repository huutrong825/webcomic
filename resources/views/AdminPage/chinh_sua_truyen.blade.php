@extends('AdminPage/Index')
@section('content')

    <!-- Shop Detail Start -->
    
    <div class="container-fluid pb-5"> 
        @foreach($truyen as $t)
            <input id="idtruyen" value="{{ $t->id }}" hidden>
            <div class="row px-xl-5">
                <div class="col-lg-5 mb-30">
                    <div id="product-carousel" class="carousel slide" >
                        <div class="carousel-inner product-item bg-light">
                            <div>
                                <img class="w-100 h-100 " id="av" src="{{ asset('img_truyen/')}}/{{$t->bia_truyen}}" alt="Image">
                                <form class="form" id="form_anhbia" contentType="multipart/form-data">
                                    @csrf
                                    <input id='input_av' name='input_av'  type="file" hidden >
                                </form>
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" id="bt-av"><i class="fa fa-camera" title="Đổi ảnh"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 h-auto mb-30">
                    <div class="h-100 bg-light p-30">
                        <h3 style="text-align:center">{{ $t->ten_truyen }}</h3>
                        <div class="d-flex mb-3">
                            <strong class="text-dark mr-3">Tác giả:</strong>                        
                            <input style="width:300px" type="text" value="{{ $t->tac_gia }}" class="form-control-sm " id="input-tacgia" disabled>
                            <button id="bt-pen1" class="btn btn-outline-success" style="margin-left: 10px; padding: 2px 4px"><i class="fa fa-edit" ></i></button>
                            <button id="bt-save1" class="btn btn-outline-success" style="margin-left: 10px; padding: 2px 4px; display:none;"><i class="fa fa-save"></i></button>
                        </div>
                        <div class="d-flex mb-4">
                            <strong class="text-dark mr-3">Trạng thái: </strong>
                            <select id="trangthai" name="trangthai" class="form-select form-control-sm" style="width:300px">
                                <option disabled selected hidden>{{ $t->trang_thai != 1 ? 'Đã hoàn thành' : 'Đang cập nhật' }}</option>
                                <option value ='1'>Đang cập nhật</option>
                                <option value ='2'>Đã hoàn thành</option>
                            </select>
                        </div>
                        <div class="d-flex mb-4">
                            <strong class="text-dark mr-3">Nhóm dịch:</strong>
                            <input style="width:300px" type="text" value="{{ $t->nhom_dich }}" class="form-control-sm" id="input-dich" disabled>
                            <button id="bt-pen2" class="btn btn-outline-success" style="margin-left: 10px; padding: 2px 4px"><i class="fa fa-edit" ></i></button>
                            <button id="bt-save2" class="btn btn-outline-success" style="margin-left: 10px; padding: 2px 4px;display:none;"><i class="fa fa-save" ></i></button>
                        </div>
                        <div class="d-flex mb-4">
                            <strong class="text-dark mr-3">Lượt theo dõi: &emsp; {{ $t->luot_theo_doi }}</strong>
                        </div>
                        <div class="d-flex mb-4">
                            <strong class="text-dark mr-3">Lượt thích: &emsp; {{ $t->luot_thich }}</strong>
                        </div>
                        
                        <div class="d-flex mb-4">
                            <strong class="text-dark mr-3">Thể loại: </strong>
                            <select class="js-example-basic-multiple form-select form-select-lg form-control" id="input_theloai" name="input_theloai" multiple="multiple">
                            @foreach($theloai as $t)
                                @php
                                    $found = false;
                                @endphp
                                
                                @foreach($TLoai as $tl)
                                    @if ($t->the_loai == $tl->the_loai)
                                        @php
                                            $found = true;
                                            break;
                                        @endphp
                                    @endif
                                @endforeach
                                
                                @if (!$found)
                                    <option value="{{ $t->id }}">{{ $t->the_loai }}</option>
                                @endif
                            @endforeach
                            </select>
                            <button id="bt-save4" class="btn btn-outline-success" style="margin-left: 10px; padding: 2px 4px; height:36px"><i class="fa fa-save"></i></button>
                        </div>  
                        @foreach($TLoai as $tl)
                        <div class="chip mb-4">
                            {{ $tl->the_loai }}
                            <!-- <button id="{{ $tl->id  }}" onclick="handleClick(event)">Click vào đây</button>
                            <input  id='closeTLs' name='closeTLs'  value="{{ $tl->the_loai  }}" hidde > -->
                            <span class="closebtn" id="{{ $tl->id  }}" onclick="handleClick(event)">&times;</span>
                        </div>
                        @endforeach
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
                            <div class="tab-pane fade show active" id="tab-pane-1">
                            @foreach($truyen as $t)
                            <textarea class="form-control" id="input-comment" name="text" placeholder="{{ $t->mo_ta }}" disabled></textarea>
                            @endforeach
                            </div>
                            <button id="bt-pen3" class="btn btn-outline-success" ><i class="fa fa-edit" ></i></button>
                            <button id="bt-save3" class="btn btn-outline-success" style="display:none;"><i class="fa fa-save" ></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row px-xl-5">
                <div class="col">
                    <div class="bg-light p-30">
                        <div class=" ">
                            <h5 style="float: left ">Danh sách chap  </h5>
                            <a  style="float: right; color:green" id="them_chap" > Thêm Chap <i class="fa fa-plus" title="Thêm chap mới"></i></a>
                        </div>
                        <div class="table-responsive">
                            <nav class="list-chap">
                            <ul class="list-group">
                            @foreach($truyen as $tr)
                                @foreach( $chap as $c)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class=" ">
                                        @if($tr->loai_truyen == 2)
                                        <a href="/admin/truyen/review-chap/{{ $c->id }}">{{ $c->ten_chap }}</a>
                                        @else
                                        <a href="/admin/truyen-chu/review-chap/{{ $c->id }}">{{ $c->ten_chap }}</a>
                                        @endif
                                    </div>
                                    <span class=" ">
                                        @if($tr->loai_truyen == 2)
                                            <a href="/admin/truyen/chap/{{ $c->id }}"  style="color:black" tittle=""><i class="fa fa-pen"></i></a>
                                        @else
                                            <a href="/admin/truyen-chu/them-nd/{{ $c->id }}"  style="color:black" ><i title="Thêm nội dung" class="fa fa-plus"></i></a>
                                            <a href="/admin/truyen-chu/get-chap/{{ $c->id }}"  style="color:blue" tittle="Edit"><i  title="Edit" class="fa fa-edit"></i></a>
                                        @endif
                                        <a class='bt_xoaChap' style="color:red" title="Xóa chap" value="{{ $c->id }}"><i class="fa fa-trash"></i></a>
                                    </span>                                
                                </li>
                                @endforeach
                            @endforeach
                            </ul
                            ></nav>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    
        <!-- Shop Detail End -->

        <!-- Modal add chap -->
        <div class="modal hide fade in" data-backdrop="static"id="modal_them_chap"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content ">
                    <div class="p-4">
                        <div class="text-center">
                            <h4 class="text-black mb-4">Thêm chap mới</h4>
                        </div>
                        <div class="modal-body ">
                            @foreach($truyen as $t)
                            <div class="table-responsive col-sm">
                                <input type="hidden" class="form-control form-control-user" id='idDrop' >
                                <form class="user" id='formadd'  enctype="multipart/form-data">
                                    @csrf
                                    <fieldset>
                                        <div class="">
                                            <input type="hidden" class="form-control form-control-user" id='idtruyen' value="{{ $t->id }}" >
                                        </div>
                                        <div class="form-group">
                                            <strong class="text-dark mr-3">Tên truyện: </strong>
                                            <input type="text" class="form-control form-control-user" id='txtname' name="txtname"
                                                placeholder="{{ $t->ten_truyen }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <strong class="text-dark mr-3">Tên chap: </strong>
                                            <input type="text" class="form-control form-control-user" id='nameChap' name="nameChap"
                                                placeholder="Nhập tên chap mới" required>
                                        </div>
                                    </fieldset>
                                    <div class="form-group" style="text-align: right">
                                        <a class="btn btn-success btn-user bt_ChapNew" id="bt_ChapNew">Thêm mới</a>
                                        <a class="btn btn-danger btn-user btAddProd" id="huy_them_chap">Hủy</a>
                                    </div>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal hide fade in" id="modal_Deleted_Chap" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nhắc nhở</h5>
                </div>
                <div class="">
                    <input type="hidden" class="form-control form-control-user" id='idDeleteChap' >
                </div>
                <div class="modal-body">Xác nhận xóa Chap <span id='nameDeleteChap' style="color:blue"></span> (Mọi dữ liệu về chap sẽ bị xóa)</div>
                <div class="modal-footer">
                    <a class="btn btn-primary bt_xacnhanxoa_Chap">Xác nhận</a>
                    <button class="btn btn-danger " type="button" data-dismiss="modal">Cancel</button>                    
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script src="{{ asset('js/ajax/ajax_truyen.js') }}"></script>
<script>
    let img = document.getElementById('av');
    let input = document.getElementById('input_av');
    input.onchange = (e) => {
    if (input.files[0])
        img.src = URL.createObjectURL(input.files[0]);
        var id = $('#idtruyen').val();
        $.ajax({
            url:'/admin/update/anhbia/' + id,
            type:'post',
            data: new FormData($('#form_anhbia')[0]),
            contentType: false,
            processData: false,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response)
            {
                alertify.success(response.message);
                setTimeout(function() {
                    location.reload();
                }, 1000);
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
    };
</script>
<script>
    function handleClick(event) {
      var buttonId = event.target.id;
      var data = {
          'theloai' : event.target.id
      };
      var id = $('#idtruyen').val();
        $.ajax({
            url:'/admin/delete/theloai/' + id,
            type:'post',
            data: data,
            // contentType: false,
            // processData: false,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response)
            {
                alertify.success(response.message);
                setTimeout(function() {
                    location.reload();
                }, 1000);
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
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection