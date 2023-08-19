
$(document).ready(function(){

   
    $("#form-register").validate({
        rules: {
            "txtname": {
                required: true,
            },
            "email": {
                required: true,
                email: true,
            },
            "password": {
                required: true,
                minlength: 6
            },
            "password_confirmations": {
                equalTo: "#pass",
                minlength: 6
            }
        },
        messages: {
            "txtname": {
                required: "Bắt buộc nhập username",
            },
            "email": {
                required: "Bắt buộc nhập email",
                email: "Nhập đúng cấu trúc email (vd: exemple@gmail.com)"
            },
            "password": {
                required: "Bắt buộc nhập password",
                minlength: "Hãy nhập ít nhất 6 ký tự"
            },
            "password_confirmation": {
                equalTo: "Hai password phải giống nhau",
                minlength: "Hãy nhập ít nhất 6 ký tự"
            }
        },
    });
    
    // Thêm user admin
    $(document).on('click','#registerAd', function(e)
    {
        e.preventDefault();
        // $('#form-register').submit();
        $.ajax({
            url : '/admin/register',
            type : 'post',
            data : new FormData($('#form-register')[0]),
            contentType: false,
            processData: false,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {  
                alertify.success(response.message);
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
        })
    });

    // Thay ảnh đại diện
    $(document).on('click', '#bt_SaveAvatar', function(e){
        e.preventDefault();
        $.ajax({
            url:'/admin/profile',
            type:'post',
            data: new FormData($('#form_avt')[0]),
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

    });

    // Thay đổi info user
    $(document).on('click', '#btChangeInfo', function(e){
        e.preventDefault();
        $.ajax({
            url:'/admin/profile/info',
            type:'post',
            data: new FormData($('#form-info')[0]),
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
    });
    
    // Thay đổi mật khẩu
    $(document).on('click', '#btChangePass', function(e){
        e.preventDefault();
        $.ajax({
            url:'/admin/profile/changePass',
            type:'post',
            data: new FormData($('#form-password')[0]),
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

