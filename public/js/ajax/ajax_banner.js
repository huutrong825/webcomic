
$(document).ready(function(){
    
    // Mở modal thêm the loại mới
    $(document).on('click','#add_banner', function(e){
        e.preventDefault();
        $('#modal_them_banner').modal('show');
    });

    // Hủy thêm thể loại, đóng modal
    $(document).on('click','#cancelBanner', function(e){
        e.preventDefault();
        $('#product_select').selectedIndex = -1;
        $('#type_banner').trigger("reset");
        $('#modal_them_banner').modal('hide');
    });

     // Thay ảnh đại diện
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

    
});


