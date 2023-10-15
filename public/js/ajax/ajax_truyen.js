$(document).ready(function(){   

    // Mở và khóa input chỉnh sửa
    $(document).on('click','#bt-pen1', function(e){
        e.preventDefault();
        $('#input-tacgia').prop('disabled', false);
        $(this).hide();
        $('#bt-save1').show();
    });

    // update tác giả
    $(document).on('click','#bt-save1', function(e){
        e.preventDefault();
        var id = $('#idtruyen').val();
        var data = {
            'tacgia' : $('#input-tacgia').val()
        }
        $.ajax({
            url : '/admin/update/tac_gia/' + id,
            type : 'post',
            data : data,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
        $('#input-tacgia').prop('disabled', true);
        $(this).hide();
        $('#bt-pen1').show();
    });

    $(document).on('click','#bt-pen2', function(e){
        e.preventDefault();
        $('#input-dich').prop('disabled', false);
        $(this).hide();
        $('#bt-save2').show();
    });
    
    //Update nhóm dịch
    $(document).on('click','#bt-save2', function(e){
        e.preventDefault();
        var id = $('#idtruyen').val();
        var data = {
            'nhomdich' : $('#input-dich').val()
        }
        $.ajax({
            url : '/admin/update/nhomdich/' + id,
            type : 'post',
            data : data,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
        $('#input-dich').prop('disabled', true);
        $(this).hide();
        $('#bt-pen2').show();
    });

    $(document).on('click','#bt-pen3', function(e){
        e.preventDefault();
        $('#input-comment').prop('disabled', false);
        $(this).hide();
        $('#bt-save3').show();
    });

    //update mô tả
    $(document).on('click','#bt-save3', function(e){
        e.preventDefault();
        var id = $('#idtruyen').val();
        var data = {
            'mota' : $('#input-comment').val()
        }
        $.ajax({
            url : '/admin/update/mota/' + id,
            type : 'post',
            data : data,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
        $('#input-comment').prop('disabled', true);
        $(this).hide();
        $('#bt-pen3').show();
    });

    //update thể loại
    $(document).on('click','#bt-save4', function(e){
        e.preventDefault();
        var id = $('#idtruyen').val();
        var data = {
            'theloai' : $('#input_theloai').val()
        }
        console.log(data);
        $.ajax({
            url : '/admin/update/theloai/' + id,
            type : 'post',
            data : data,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

    //update trạng thái
    $(document).on('change','#trangthai', function(e){
        e.preventDefault();
        var id = $('#idtruyen').val();
        var data = {
            'trangthai' : $('#trangthai').val()
        }
        $.ajax({
            url : '/admin/update/trangthai/' + id,
            type : 'post',
            data : data,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
    
    // Mở modal thêm chap mới
    $(document).on('click','#them_chap', function(e){
        e.preventDefault();
        $('#modal_them_chap').modal('show');
    });

    // Hủy thêm chap, đóng modal
    $(document).on('click','#huy_them_chap', function(e){
        e.preventDefault();
        $('form :input').val('');
        $('#modal_them_chap').modal('hide');
    });    

    $(document).on('click','#bt-av', function(e){
        e.preventDefault();
        $('#input_av').trigger('click');
    });   

    $(document).on('click', '.bt_themTruyen',function(e)
    {
        e.preventDefault();
        var data = {
            'anh' :  $('#input_anh').val().replace(/.*(\/|\\)/, ''),
            'tentruyen' :  $('#input_ten').val(),
            'tacgia' :  $('#input_tg').val(),
            'dich':  $('#input_dich').val(),
            'trangthai' :  $('#input_trangthai').val(),
            'theloai' :  $('#input_theloai').val(),
            'loai':  $('#input_loai').val(),
            'mota' :  $('#input_mota').val(),
        };
        $.ajax({
            url : '/admin/truyen/them_moi',
            type : 'post',
            data : data,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {  
                alertify.success(response.mes);
                $('#formThemTruyen').trigger("reset");
                $('form :input').trigger("reset");
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
    });

    $(document).on('click', '#bt_ChapNew', function(e)
    {
        e.preventDefault();
        var id = $('#idtruyen').val();
        var data = {
            'name' : $('#nameChap').val(),
        };
        $.ajax({
            url : '/admin/truyen/them-chap/' + id,
            type : 'post',
            data : data,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {  
                alertify.success(response.mes);
                // $('#formThemTruyen').trigger("reset");
                $('form :input').trigger("reset");
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

    //Xóa truyện
    $(document).on('click', '.bt_xoaTruyen', function(e)
    {
        e.preventDefault();
        var id = $(this).attr('value');
        $('#modal_Deleted_Truyen').modal('show');
        $.ajax({
            url : '/admin/truyen-tranh/getTruyen/' + id,
            type : 'get',
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {  
                $('#idDeleteTruyen').val(response.truyen.id);
                $('#nameDeleteTruyen').html(response.truyen.ten_truyen); 
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

    $(document).on('click', '.bt_xacnhanxoa_Truyen', function(e)
    {
        e.preventDefault();
        var id = $('#idDeleteTruyen').val();
        $.ajax({
            url : '/admin/truyen-tranh/delete/' + id,
            type : 'get',
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
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

    //Xóa chap
    $(document).on('click', '.bt_xoaChap', function(e)
    {
        e.preventDefault();
        var id = $(this).attr('value');
        $('#modal_Deleted_Chap').modal('show');
        $.ajax({
            url : '/admin/truyen/chap/get/' + id,
            type : 'get',
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {  
                $('#idDeleteChap').val(response.chap.id);
                $('#nameDeleteChap').html(response.chap.ten_chap); 
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

    $(document).on('click', '.bt_xacnhanxoa_Chap', function(e)
    {
        e.preventDefault();
        var id = $('#idDeleteChap').val();
        $.ajax({
            url : '/admin/truyen/chap/delete/' + id,
            type : 'get',
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
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

})