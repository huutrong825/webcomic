
$(document).ready(function(){
    $(document).on('click','#bt_Add_Nd', function(e){
        e.preventDefault();
        var id = $('#idChap').val();
        var data = {
            'nameChap' : $('#summernote').val(),
        }
        console.log(data);
        $.ajax({
            url : '/admin/truyen-chu/them-nd/' + id,
            type : 'post',
            data : data,
            // contentType: false,
            // processData: false,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {  
                alertify.success(response.message);
            },
            error: function ()
            {
                alertify.error('Thêm thất bại');
            }
        });
    });
});

$(document).ready(function(){
    $(document).on('click','#bt_Update_Nd', function(e){
        e.preventDefault();
        var id = $('#idChapND').val();
        var data = {
            'nameChap' : $('#summernote').val(),
        }
        console.log(data);
        $.ajax({
            url : '/admin/truyen-chu/update/' + id,
            type : 'put',
            data : data,
            // contentType: false,
            // processData: false,
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