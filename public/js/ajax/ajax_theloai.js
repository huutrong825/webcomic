$(document).ready(function(){   


// Mở modal thêm the loại mới
$(document).on('click','#them_theloai', function(e){
    e.preventDefault();
    $('#modal_them_theloai').modal('show');
});

// Hủy thêm thể loại, đóng modal
$(document).on('click','#huy_them_theloai', function(e){
    e.preventDefault();
    $('form :input').val('');
    $('#modal_them_theloai').modal('hide');
});

// Mở modal thêm loại mới
$(document).on('click','#them_loai', function(e){
    e.preventDefault();
    $('#modal_them_loai').modal('show');
});

// Hủy thêm  loại, đóng modal
$(document).on('click','#huy_them_loai', function(e){
    e.preventDefault();
    $('form :input').val('');
    $('#modal_them_loai').modal('hide');
});

// Thêm thể loại mới
    $(document).on('click', '.add_Theloai',function(e)
    {
        e.preventDefault();
        var data = {
            'theloai' : $('#txtTheloai').val()
        };
        $.ajax({
            url : '/admin/the-loai/them-the-loai',
            type : 'post',
            data : data,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {  
                alertify.success(response.mes);
                $('form :input').val('');
            },
        });
    });

    fetch_theloai();
    // Đổ data ra bảng
    function fetch_theloai()
    {  
        $('#myTable').DataTable({
            'ajax':
            {
                url : '/admin/the-loai/fetch',
            },
            'columns':[
                {'data' : 'id'},
                {'data' : 'the_loai'},
                {'data' : 'action', 'orderable' : false, 'searchable' : false}
            ],
            // 'order' : [[0, 'desc']],
            'searching':false,
        });
    }

    $(document).on('click', '.add_Loai',function(e)
    {
        e.preventDefault();
        var data = {
            'loai' : $('#txtLoai').val()
        };
        $.ajax({
            url : '/admin/loai/them-loai',
            type : 'post',
            data : data,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response)
            {  
                alertify.success(response.mes);
            },
            error: function ()
            {
                alertify.error('Thêm thất bại');
            }
        });
    });

    fetch_loai();
    // Đổ data ra bảng
    function fetch_loai()
    {  
        $('#loaiTable').DataTable({
            'ajax':
            {
                url : '/admin/loai',
            },
            'columns':[
                {'data' : 'id'},
                {'data' : 'loai_truyen'},
                {'data' : 'action', 'orderable' : false, 'searchable' : false}
            ],
            // 'order' : [[0, 'desc']],
            'searching':false,
        });
    }

    $(document).on('click', '.bt-Update-TL',function(e)
    {
        e.preventDefault();
        var id = $(this).attr('value');
        $('#modal_Update_theloai').modal('show');
        $.ajax({
            type :'get',
            url : '/admin/the-loai/getId/' + id,
            success : function(response){
                $('#idUp').val(response.item.id);
                $('#txtTL').val(response.item.the_loai);
            },
            error : function (err)
            {
                alert('Lỗi');
            }
        });
    });

    // Hủy thêm  loại, đóng modal
    $(document).on('click','#huy_Update_theloai', function(e){
        e.preventDefault();
        $('#modal_Update_theloai').modal('hide');
    });

    $(document).on('click', '.up_Theloai',function(e)
    {
        e.preventDefault();
        var id = $('#idUp').val();
        var data = {
            'theloai': $('#txtTL').val(),
        }
        console.log(id);
        $.ajax({
            url : '/admin/the-loai/update/' + id,
            type : "put",
            data : data,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function(response)
            {
                alertify.success(response.mes);
                $('#modal_Update_theloai').modal('hide');
            },
            error : function (err)
            {
                alert('Lỗi');
            },
        });
    });

    // Update Loai
    $(document).on('click', '.bt-Update-Loai',function(e)
    {
        e.preventDefault();
        var id = $(this).attr('value');
        $('#modal_Update_Loai').modal('show');
        $.ajax({
            type :'get',
            url : '/admin/loai/getId/' + id,
            success : function(response){
                $('#idUp').val(response.item.id);
                $('#txtLT').val(response.item.loai_truyen);
            },
            error : function (err)
            {
                alert('Lỗi');
            }
        });
    });

    // Hủy thêm  loại, đóng modal
    $(document).on('click','#huy_Update_Loai', function(e){
        e.preventDefault();
        $('#modal_Update_Loai').modal('hide');
    });

    $(document).on('click', '.up_Loai',function(e)
    {
        e.preventDefault();
        var id = $('#idUp').val();
        var data = {
            'loai': $('#txtLoai').val(),
        }
        $.ajax({
            url : '/admin/loai/update/' + id,
            type : "put",
            data : data,
            dataType : 'json',
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function(response)
            {
                alertify.success(response.mes);
                $('#modal_Update_Loai').modal('hide');
            },
            error : function (err)
            {
                alert('Lỗi');
            },
        });
    });

    // Mở modal xóa thể loại
    $(document).on('click','.bt-Delete-TL', function(e){
        e.preventDefault();
        var id = $(this).attr('value');
        $('#modal_Deleted_theloai').modal('show');
        $.ajax({
            type :'get',
            url : '/admin/the-loai/getId/' + id,
            success : function(response){
                $('#idDeleteTL').val(response.item.id);
                $('#nameDeleteTL').html(response.item.the_loai);
            },
            error : function (err)
            {
                alert('Lỗi');
            }
        });
    });
    
    

    //Xác nhận xóa
    $(document).on('click','.bt_xacnhanxoa_TL', function(e)
    {
        e.preventDefault();
        var id = $('#idDeleteTL').val();
        $.ajax({
            url:'/admin/the-loai/delete/' + id,
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

    // Mở modal xóa  loại
    $(document).on('click','.bt-Delete-Loai', function(e){
        e.preventDefault();
        var id = $(this).attr('value');
        $('#modal_Deleted_Loai').modal('show');
        $.ajax({
            type :'get',
            url : '/admin/loai/getId/' + id,
            success : function(response){
                $('#idDeleteLoai').val(response.item.id);
                $('#nameDeleteLoai').html(response.item.loai_truyen);
            },
            error : function (err)
            {
                alert('Lỗi');
            }
        });
    });

    //Xác nhận xóa loại
    $(document).on('click','.bt_xacnhanxoa_Loai', function(e)
    {
        e.preventDefault();
        var id = $('#idDeleteLoai').val();
        $.ajax({
            url:'/admin/loai/delete/' + id,
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

});