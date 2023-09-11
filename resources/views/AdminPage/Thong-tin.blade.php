@extends('AdminPage/Index')
@section('content')

    <div class="">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="float:left"  class="m-0 font-weight-bold text-success">Banner truyện</h6>
                <a style="float:right; display:none" class="text-success" id="plus" onclick="myFunction()"><i class="fas fa-plus"></i></a>
                <a style="float:right; " class="text-success" id="minus"  onclick="myFunction()"><i class="fas fa-minus"></i></a>
            </div>
            <div class = "card-body" id="demo1">
                <div class="table-responsive">
                    <div class="form-group" >
                        <a class="btn btn-outline-success" id="add_banner"> Thêm mới </a>
                    </div>
                    <table class="table table-bordered" id="myTableBanner" style="width:100%; text-align:center">
                        <thead>
                            <tr>
                                <th >STT</th>
                                <th>Ảnh bìa</th>
                                <th> Tên truyện</th>
                                <th>Loại banner</th>
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

    <div class="">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="float:left"  class="m-0 font-weight-bold text-success">Thông tin page</h6>
                <a style="float:right; display:none" class="text-success" id="plus1" onclick="myFunction1()"><i class="fas fa-plus"></i></a>
                <a style="float:right; " class="text-success" id="minus1"  onclick="myFunction1()"><i class="fas fa-minus"></i></a>
            </div>
            <div class="card-body" id="demo">
                <div class="table-responsive">
                    <div class="form-group" >
                        <a class="btn btn-outline-success" id="update_info"> Chỉnh sửa </a>
                    </div>
                    <table class="table table-bordered" id="infoTable" style="width:100%; text-align:center">
                        <thead>
                            <tr>
                                <th >STT</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Tên web</th>
                                <th>Tiêu đề</th>
                            </tr>   
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal add banner -->
    <div class="modal hide fade in" data-backdrop="static" id="modal_them_banner"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">   
        <div class="modal-dialog " role="document">
            <div class="modal-content ">
                <div class="p-4">
                    <div class="text-center">
                        <h4 class="text-black mb-4">Chọn truyện làm banner</h4>
                    </div>
                    <div class="row px-xl-5">
                        <div class="col">
                            <div class="bg-light p-4">
                                <div id="display-product" ></div>
                            </div>
                        </div>
                    </div>
                    <form id="form_banner" class="user">
                        <div class="form-group">
                            <select class="form-control filter" id="product_select" name="product_select" onchange="changeProduct()">
                                <option disabled selected hidden>Chọn truyện</option>
                                @foreach ($truyen as $t)
                                <option value="{{ $t->id }}">{{ $t->ten_truyen }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control filter" id="type_banner" name="type_banner" >
                                <option disabled selected hidden>Chọn loại banner</option>
                                <option value="1">Banner carousel</option>
                                <option value="2">Banner offer</option>
                                <option value="3">Banner item</option>
                            </select>
                        </div>
                        <div class="form-group" style="text-align: right">
                            <a class="btn btn-success btn-user add_Banner">Thêm mới</a>
                            <a class="btn btn-danger btn-user " id="cancelBanner">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal add info -->
    <div class="modal hide fade in" data-backdrop="static" id="modal_update_info"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">   
        <div class="modal-dialog " role="document">
            <div class="modal-content ">
                <div class="p-4">
                    <div class="text-center">
                        <h4 class="text-black mb-4">Chỉnh sửa thông tin page</h4>
                    </div>
                    <div class="modal-body ">
                        <div class="table-responsive col-sm">
                            <form class="user" id='formadd' >
                                <fieldset>
                                    <div class="form-group">
                                        <lable>Email page:</lable>
                                        <input type="text" class="form-control form-control-user" id='email' name="email">
                                    </div>
                                    <div class="form-group">
                                        <lable>Phone page:</lable>
                                        <input type="text" class="form-control form-control-user" id='phone' name="phone">
                                    </div>
                                    <div class="form-group">
                                        <lable>Tên web:</lable>
                                        <input type="text" class="form-control form-control-user" id='ten_web' name="ten_web">
                                    </div>
                                    <div class="form-group">
                                        <lable>Tiêu đề page:</lable>
                                        <input type="text" class="form-control form-control-user" id='tieu_de' name="tieu_de">
                                    </div>
                                </fieldset>
                                <div class="form-group" style="text-align: right">
                                    <a class="btn btn-success btn-user add_Loai">Cập nhật</a>
                                    <a class="btn btn-danger btn-user" id="cancelInfo">Hủy</a>
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

     <!-- Modal sửa thể loại -->
     <div class="modal hide fade in" data-backdrop="static" id="modal_Update_Loai"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">   
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

    <script>
        function changeProduct() {    
            var displayProduct = document.getElementById("display-product");

            // Xóa nội dung hiện tại trong div display-product
            displayProduct.innerHTML = "";

            var id = $('#product_select').val();
            $.ajax({
                url:'/admin/banner/' + id,
                type:'get',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response)
                {
                    $img = "/img_truyen/" + response.items.bia_truyen ;

                var imgElement = document.createElement("img");
                imgElement.src = $img;
                imgElement.setAttribute('id', 'imgbanner');
                imgElement.alt = response.items.ten_truyen;
                imgElement.classList.add('s-10');

                displayProduct.appendChild(imgElement);
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
    <script src="{{ asset('/js/ajax/ajax_banner.js') }}"></script>
@endsection
