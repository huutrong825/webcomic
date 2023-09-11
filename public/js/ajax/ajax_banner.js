
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
            'searching':false,
        });
    }

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
            'searching':false,

        });
    }


    // Hủy thêm thể loại, đóng modal
    $(document).on('click','#cancelInfo', function(e){
        e.preventDefault();
        $('#modal_update_info').modal('hide');
    });

});


