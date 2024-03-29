@extends('AdminPage/Index')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="float:left"  class="m-0 font-weight-bold text-success">Thể loại</h6>
                <a style="float:right; display:none" class="text-success" id="plus" onclick="myFunction()"><i class="fas fa-plus"></i></a>
                <a style="float:right; " class="text-success" id="minus"  onclick="myFunction()"><i class="fas fa-minus"></i></a>
            </div>
            <div class = "card-body" id="demo1">
                <div class="table-responsive">
                    <div class="input-group row">
                        <div class="input-group mb-3 col-md">
                            <a href="" class="btn btn-success btn-icon-user " id="them_theloai">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Thêm thể loại mới</span>
                            </a>
                        </div>
                    </div>
                    <table class="table table-bordered" id="myTable" style="text-align:center; width:100%">
                        <thead>
                            <tr>
                                <th >STT</th>
                                <th>Danh sách thể loại</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="float:left"  class="m-0 font-weight-bold text-success">Loại truyện</h6>
                <a style="float:right; display:none" class="text-success" id="plus1" onclick="myFunction1()"><i class="fas fa-plus"></i></a>
                <a style="float:right; " class="text-success" id="minus1"  onclick="myFunction1()"><i class="fas fa-minus"></i></a>
            </div>
            <div class="card-body" id="demo">
                <div class="table-responsive">
                    <div class="input-group row">
                        <div class="input-group mb-3 col-md">
                            <a href="" class="btn btn-success btn-icon-user" id="them_loai" >
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Thêm loại truyện mới</span>
                            </a>
                        </div>
                    </div>
                    <table class="table table-bordered" id="loaiTable" style="text-align:center; width:100%">
                        <thead>
                            <tr>
                                <th >STT</th>
                                <th>Danh sách loại truyện</th>
                                <th></th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Modal add thể loại -->
    <div class="modal hide fade in" data-backdrop="static" id="modal_them_theloai"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">   
        <div class="modal-dialog " role="document">
            <div class="modal-content ">
                <div class="p-4">
                    <div class="text-center">
                        <h4 class="text-black mb-4">Thêm thể loại mới</h4>
                    </div>
                    <div class="modal-body ">
                        <div class="table-responsive col-sm">
                            <form class="user">
                                @csrf
                                <fieldset>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id='txtTheloai' name="txtTheloai"
                                            placeholder="Nhập thể loại mới" required>
                                    </div>
                                </fieldset>
                                <div class="form-group" style="text-align: right">
                                    <a class="btn btn-success btn-user add_Theloai">Thêm mới</a>
                                    <a class="btn btn-danger btn-user btAddProd" id="huy_them_theloai">Hủy</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal add  loại -->
    <div class="modal hide fade in" data-backdrop="static" id="modal_them_loai"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">   
        <div class="modal-dialog " role="document">
            <div class="modal-content ">
                <div class="p-4">
                    <div class="text-center">
                        <h4 class="text-black mb-4">Thêm loại truyện</h4>
                    </div>
                    <div class="modal-body ">
                        <div class="table-responsive col-sm">
                            <form class="user" id='formadd' >
                                @csrf
                                <fieldset>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id='txtLoai' name="txtLoai"
                                            placeholder="Nhập loại truyện" required>
                                    </div>
                                </fieldset>
                                <div class="form-group" style="text-align: right">
                                    <a class="btn btn-success btn-user add_Loai">Thêm mới</a>
                                    <a class="btn btn-danger btn-user btAddProd" id="huy_them_loai">Hủy</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal sửa thể loại -->
    <div class="modal hide fade in" data-backdrop="static" id="modal_Update_theloai"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">   
        <div class="modal-dialog " role="document">
            <div class="modal-content ">
                <div class="p-4">
                    <div class="text-center">
                        <h4 class="text-black mb-4"> Chỉnh sửa </h4>
                    </div>
                    <div class="modal-body ">
                        <div class="table-responsive col-sm">
                            <form class="user">
                                @csrf
                                <div class="">
                                    <input type="hidden" class="form-control form-control-user" id='idUp' >
                                </div>
                                <fieldset>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id='txtTL' name="txtTL" required>
                                    </div>
                                </fieldset>
                                <div class="form-group" style="text-align: right">
                                    <a class="btn btn-success btn-user up_Theloai">Cập nhật</a>
                                    <a class="btn btn-danger btn-user " id="huy_Update_theloai">Hủy</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Modal sửa loại -->
     <div class="modal hide fade in" data-backdrop="static" id="modal_Update_Loai"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">   
        <div class="modal-dialog " role="document">
            <div class="modal-content ">
                <div class="p-4">
                    <div class="text-center">
                        <h4 class="text-black mb-4"> Chỉnh sửa </h4>
                    </div>
                    <div class="modal-body ">
                        <div class="table-responsive col-sm" >
                            <form class="user">
                                @csrf
                                <div class="">
                                    <input type="hidden" class="form-control form-control-user" id='idUp' >
                                </div>
                                <fieldset>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id='txtLT' name="txtLT" required>
                                    </div>
                                </fieldset>
                                <div class="form-group" style="text-align: right">
                                    <a class="btn btn-success btn-user up_Loai">Cập nhật</a>
                                    <a class="btn btn-danger btn-user " id="huy_Update_Loai">Hủy</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal Thể loại-->
    <div class="modal hide fade in" id="modal_Deleted_theloai" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nhắc nhở</h5>
                </div>
                <div class="">
                    <input type="hidden" class="form-control form-control-user" id='idDeleteTL' >
                </div>
                <div class="modal-body">Xác nhận xóa thể loại <span id='nameDeleteTL' style="color:blue"></span></div>
                <div class="modal-footer">
                    <a class="btn btn-primary bt_xacnhanxoa_TL">Xác nhận</a>
                    <button class="btn btn-danger " type="button" data-dismiss="modal">Cancel</button>                    
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal Loại-->
    <div class="modal hide fade in" id="modal_Deleted_Loai" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nhắc nhở</h5>
                </div>
                <div class="">
                    <input type="hidden" class="form-control form-control-user" id='idDeleteLoai' >
                </div>
                <div class="modal-body">Xác nhận xóa thể loại <span id='nameDeleteLoai' style="color:blue"></span></div>
                <div class="modal-footer">
                    <a class="btn btn-primary bt_xacnhanxoa_Loai">Xác nhận</a>
                    <button class="btn btn-danger " type="button" data-dismiss="modal">Cancel</button>                    
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
<script>
    function myFunction() {
    var x = document.getElementById("demo1");
    var y = document.getElementById("plus");
    var z = document.getElementById("minus");
    if (x.style.display === "none") {
        x.style.display = "block";
        z.style.display = "block";
        y.style.display = "none";
        
    } else {
        x.style.display = "none";
        y.style.display = "block";
        z.style.display = "none";
    }
    }

    function myFunction1() {
    var x = document.getElementById("demo");
    var y = document.getElementById("plus1");
    var z = document.getElementById("minus1");
    if (x.style.display === "none") {
        x.style.display = "block";
        z.style.display = "block";
        y.style.display = "none";
        
    } else {
        x.style.display = "none";
        y.style.display = "block";
        z.style.display = "none";
    }
    }
</script>

<script src="{{ asset('/js/ajax/ajax_theloai.js') }}"></script>
@endsection
