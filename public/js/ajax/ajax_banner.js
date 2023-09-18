
$(document).ready(function(){
    
    // Mở modal thêm the loại mới
    $(document).on('click','#add_banner', function(e){
        e.preventDefault();
        $('#modal_them_banner').modal('show');
    });

    // Hủy thêm thể loại, đóng modal
    $(document).on('click','#cancelBanner', function(e){
        e.preventDefault();
        $('#product_select').val($('#product_select option:first').val());
        $('#type_banner').val($('#type_banner option:first').val());
        var child = document.getElementById("imgbanner");
        if (child) { child.parentNode.removeChild(child);}
        $('#modal_them_banner').modal('hide');
    });

     // Thay banner
    $(document).on('click', '.add_Banner', function(e){
        e.preventDefault();
        $.ajax({
            url:'/admin/banner',
            type:'post',
            data: new FormData($('#form_banner')[0]),
            contentType: false,
            processData: false,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response)
            {
                if (response.errors) {
                    alertify.error(response.errors);
                } else {
                    alertify.success(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
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

    });

    fetch_banner();
    // Đổ data ra bảng
    function fetch_banner()
    {  
        $('#myTableBanner').DataTable({
            'processing':true,
            'serverSide':true,
            'ajax':
            {
                url : '/admin/banner/fetch',
            },
            'columns':[
                {'data' : 'id'},
                {'data' : 'image'},
                {'data' : 'ten_truyen'},
                {'data' : 'loai_banner'},
                {'data' : 'action', 'orderable' : false, 'searchable' : false}
            ],
            // 'order' : [[0, 'desc']],
            'searching':false,'info':false
        });
    }

    //Update banner
    $(document).on('click','.bt_updateBanner', function(e){
        e.preventDefault();
        var id = $(this).attr('value');
        $('#modal_update_banner').modal('show');
        $.ajax({
            type :'get',
            url : '/admin/banner/getBanner/' + id,
            success : function(response){
                var loai = response.items.loai_banner == 1 ? 'Banner carousel' : (response.items.loai_banner == 2 ? 'Banner offer' : 'Banner item');
                console.log(loai);
                $('#idbanner').val(response.items.id);
                $('#seleced_banner').val(response.items.id_truyen);
                $('#seleced_banner').html(response.items.ten_truyen);
                $('#seleced_type').val(response.items.loai_banner);
                $('#seleced_type').html(loai);

                $img = "/img_truyen/" + response.items.image ;

                var displayProduct = document.getElementById("display-up-product");
                displayProduct.innerHTML = "";
                var imgElement = document.createElement("img");
                imgElement.src = $img;
                imgElement.setAttribute('id', 'imgbanner');
                imgElement.alt = response.items.ten_truyen;
                imgElement.classList.add('s-10');                
                displayProduct.appendChild(imgElement);
            },
            error : function (err)
            {
                alert('Lỗi');
            }
        });
    });

    $(document).on('click', '.Up_Banner', function(e){
        e.preventDefault();
        $id = $('#idbanner').val();
        $.ajax({
            url:'/admin/banner/update/' + $id,
            type:'post',
            data: new FormData($('#form_update_banner')[0]),
            contentType: false,
            processData: false,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response)
            {
                if (response.errors) {
                    alertify.error(response.errors);
                } else {
                    alertify.success(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
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

    });

    $(document).on('click','#cancelUpBanner', function(e){
        e.preventDefault();
        $('#product_up_select').val($('#product_up_select option:first').val());
        $('#type_up_banner').val($('#type_up_banner option:first').val());
        var child = document.getElementById("imgbanner");
        if (child) { child.parentNode.removeChild(child);}
        $('#modal_update_banner').modal('hide');
    });

     // Mở modal xóa thể loại
     $(document).on('click','.bt_deleteBanner', function(e){
        e.preventDefault();
        var id = $(this).attr('value');
        $('#modal_Deleted_Banner').modal('show');
        $.ajax({
            type :'get',
            url : '/admin/banner/getBanner/' + id,
            success : function(response){
                $('#idDeleteBanner').val(response.items.id);
                $('#nameDeleteBanner').html(response.items.ten_truyen);
            },
            error : function (err)
            {
                alert('Lỗi');
            }
        });
    });
    

    //Xác nhận xóa
    $(document).on('click','.bt_xacnhanxoa_Banner', function(e)
    {
        e.preventDefault();
        var id = $('#idDeleteBanner').val();
        $.ajax({
            url:'/admin/banner/delete/' + id,
            type: "GET",
            success:function(response)
            {       
                if (response.errors) {
                    alertify.error(response.errors);
                };
                if (response.message) {
                    alertify.success(response.message);
                    // $('#').modal('hide');
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
    });

    // Mở modal chỉnh sủa info
    $(document).on('click','#update_info', function(e){
        e.preventDefault();
        $('#modal_update_info').modal('show');
        $.ajax({
            url:'/admin/info/getInfo',
            type:'get',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response)
            {
                $('#email').val(response.items.email);
                $('#phone').val(response.items.phone);
                $('#ten_web').val(response.items.ten_web);
                $('#tieu_de').val(response.items.tieu_de);
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
        })
    });


    fetch_info();
    // Đổ data ra bảng
    function fetch_info()
    {  
        $('#infoTable').DataTable({
            'processing':true,
            'serverSide':true,
            'ajax':
            {
                url : '/admin/info/fetch',
            },
            'columns':[
                {'data' : 'id','visible':false },
                {'data' : 'email'},
                {'data' : 'phone'},
                {'data' : 'ten_web'},
                {'data' : 'tieu_de'}
            ],
            // 'order' : [[0, 'desc']],
            'searching':false,"paging": false,'info':false

        });
    }

    $(document).on('click', '#updateInfo', function(e){
        e.preventDefault();
        $.ajax({
            url:'/admin/info/updatetInfo',
            type:'post',
            data: new FormData($('#formupdateInfo')[0]),
            contentType: false,
            processData: false,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response)
            {
                if (response.errors) {
                    alertify.error(response.errors);
                } else {
                    alertify.success(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
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
    });


    // Hủy thêm thể loại, đóng modal
    $(document).on('click','#cancelInfo', function(e){
        e.preventDefault();
        $('#modal_update_info').modal('hide');
    });

});


