@extends('AdminPage/Index')
@section('content')

    <div class="container-fluid pb-5 ">  
        <div class="">
            <form id="formThemTruyen" class="row px-xl-5" enctype="multipart/form-data">
                @csrf
                <div class="col-lg-5 mb-30">
                    <div id="product-carousel" class="carousel slide">
                        <div class=" bg-light">
                            <div class="" style="padding:10px">
                                <img id="avatar-truyen" class="w-100 h-100" src="{{ asset('admin_img/image.jpg') }}" alt="Image">
                                
                                <input id='input_anh' name="input_anh" type="file">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-7 h-auto mb-3">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold ">Tên truyện:  </h6>
                            <input id="input_ten" name="input_ten" class="form-control">
                        </div>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold ">Tên tác giả:  </h6>
                            <input id="input_tg" name="input_tg" class="form-control">
                        </div>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold ">Nhóm dịch:  </h6>
                            <input id="input_dich" name="input_dich" class="form-control">
                        </div>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold ">Trạng thái:  </h6>
                            <select class="form-select form-select-lg form-control" id="input_trangthai" name="input_trangthai">
                                 <option value="1" >Đang cập nhật</option>
                                 <option value="2" >Đã hoàn thành</option>
                                 <option value="3" >Trì hoãn</option>
                            </select>
                        </div>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold ">Thể loại truyện:  </h6>
                            <select class="js-example-basic-multiple form-select form-select-lg form-control" id="input_theloai" name="input_theloai" multiple="multiple">
                                @foreach($theloai as $t)
                                    <option value="{{ $t->id }}" >{{ $t->the_loai }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold ">Loại truyện:  </h6>
                            <select class="form-select form-select-lg form-control" id="input_loai" name="input_loai" >
                                @foreach($loai as $l)
                                    <option value="{{ $l->id }}" >{{ $l->loai_truyen }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold ">Mô tả truyện :  </h6>
                        </div>
                        <div class="card-body">
                            <textarea class="form-control" id="input_mota" name="input_mota" row="5"></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div style="text-align:right; padding-right:8%">
            <a style="text-align: center"  class="btn btn-outline-success btn-user bt_themTruyen">Tạo truyện</a>
            <a style="text-align: center" href="{{ asset('/admin/truyen-tranh') }}" class="btn btn-outline-danger">Hủy</a>
        </div>
    </div>

@endsection

@section('script')
    <!-- <script src="https://cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script> -->

    <script src="{{ asset('/js/ajax/ajax_truyen.js') }}"></script>
  
  <script>
      let img = document.getElementById('avatar-truyen');
      let input = document.getElementById('input_anh');
      input.onchange = (e) => {
        if (input.files[0])
            img.src = URL.createObjectURL(input.files[0]);
      };
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
@endsection