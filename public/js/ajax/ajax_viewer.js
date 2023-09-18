
$(document).ready(function(){

   
    $("#form-regin").validate({
        rules: {
            "email": {
                required: true,
                email: true,
            },
            "password": {
                required: true,
                minlength: 6
            }
        },
        messages: {
            "email": {
                required: "Bắt buộc nhập email",
                email: "Nhập đúng cấu trúc email (vd: exemple@gmail.com)"
            },
            "password": {
                required: "Bắt buộc nhập password",
                minlength: "Hãy nhập ít nhất 6 ký tự"
            }
        },
    });
    
    // Thêm user viewer
    $(document).on('click','#sub_reg', function(e)
    {
        e.preventDefault();
        $.ajax({
            url : '/register',
            type : 'post',
            data : new FormData($('#form_regin')[0]),
            contentType: false,
            processData: false,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
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
        })
    });

    $(document).on('click','#sub_Login', function(e)
    {
        e.preventDefault();
        $.ajax({
            url : '/login',
            type : 'post',
            data : new FormData($('#form_login')[0]),
            contentType: false,
            processData: false,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {  
                
                if (response.errors) {
                    alertify.error(response.errors);
                };
                if (response.message) {
                    alertify.success(response.message);
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
    
    //Tạo bình luận
    $(document).on('click','#bt_comment', function(e)
    {
        e.preventDefault();
        // alertify.success('Hoạt d');
        $.ajax({
            url : '/post-comment',
            type : 'post',
            data : new FormData($('#form_comment')[0]),
            contentType: false,
            processData: false,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {  
                
                if (response.errors) {
                    alertify.error(response.errors);
                };
                if (response.message) {
                    alertify.success(response.message);
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
        })
    });


});

