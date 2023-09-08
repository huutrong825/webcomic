
$(document).ready(function(){

   
    $(document).on('click','#bt-av', function(e){
        e.preventDefault();
        $('#input_av').trigger('click');
    });

     // Thay ảnh đại diện
     $(document).on('click', '#bt_SaveAvatarView', function(e){
        e.preventDefault();
        $.ajax({
            url:'/profile/avatar',
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
    $(document).on('click', '#btChangeInfoView', function(e){
        e.preventDefault();
        $.ajax({
            url:'/profile/info',
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
    $(document).on('click', '#btChangePassView', function(e){
        e.preventDefault();
        $.ajax({
            url:'/profile/changePass',
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

    const ipnElement3 = document.querySelector('#lastPass')
    const ipnElement4 = document.querySelector('#password')
    const ipnElement5 = document.querySelector('#password_confirmation')
    const btToggle1 = document.querySelector('#togglePass')
    // const btnElement = document.querySelector('#btnPassword')

    // step 2
    btToggle1.addEventListener('click', function() {
        // step 3
        const currentType3 = ipnElement3.getAttribute('type')
        const currentType4 = ipnElement4.getAttribute('type')
        const currentType5 = ipnElement5.getAttribute('type')
        // step 4
        ipnElement3.setAttribute('type', currentType3 === 'password' ? 'text' : 'password')
        ipnElement4.setAttribute('type', currentType4 === 'password' ? 'text' : 'password')
        ipnElement5.setAttribute('type', currentType5 === 'password' ? 'text' : 'password')

        this.classList.toggle('bi-eye')
    });

    let img = document.getElementById('av');
    let btSave = document.getElementById('bt_SaveAvatarView');
    let input = document.getElementById('input_av');
    input.onchange = (e) => {
    if (input.files[0])
        img.src = URL.createObjectURL(input.files[0]);
    btSave.style.display = 'block';
    };
});


