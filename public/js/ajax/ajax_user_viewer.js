$(document).ready(function(){

$(document).on('click','.bt-Delete',function(e)
{
    e.preventDefault();
    var _id = $(this).attr('value');
    $('#DeleteModal').modal('show');
    $.ajax({
        url:'/admin/get-viewer/' +_id,
        type: 'get',
        success:function(response)
        {
            $('#idDelete').val(response.viewer.id);
            $('#nameDelete').html(response.viewer.name); 
        },
        error: function (err)
        {
            alert('Lỗi');
        }
    });
});

// Xác nhận xóa

$(document).on('click','.btDSubmitDelete', function(e)
{
    e.preventDefault();
    var id = $('#idDelete').val();
    $.ajax({
        url:'/admin/delete-viewer/' + id,
        type: "GET",
        success:function(response)
        {       
            if (response.errors) {
                alertify.error(response.errors);
            };
            if (response.message) {
                alertify.success(response.message);
                $('#BlockModal').modal('hide');
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


//Alert Block

$(document).on('click','.bt-Block', function(e)
{
    e.preventDefault();
    var _id=$(this).attr('value');
    $('#BlockModal').modal('show');
    console.log(_id);
    $.ajax({
        url:'/admin/get-viewer/' +_id,
        type:"GET",
        success:function(response)
        {
            $('#idBlock').val(response.viewer.id);
            $('#nameBlock').html(response.viewer.name); 
        },
        error: function (err)
        {
            alert('Lỗi');
        }
    });
});

// Xác nhận block/open

$(document).on('click','.btDSubmitBlock',function(e)
{
    e.preventDefault();
    var _id=$('#idBlock').val();
    console.log(_id);
    $.ajax({
        url:'/admin/block-viewer/' +_id,
        type:"GET",
        success:function(response)
        {       
            if (response.errors) {
                alertify.error(response.errors);
            };
            if (response.message) {
                alertify.success(response.message);
                $('#BlockModal').modal('hide');
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

});