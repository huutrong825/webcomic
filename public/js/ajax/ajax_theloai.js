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
                $.each(response.item, function(key, item){
                    $('#idUp').val(item.id);
                    $('#txtTL').val(item.the_loai);
                });
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
                console.log(response);
                $.each(response.item, function(key, item){
                    $('#idUp').val(item.id);
                    $('#txtLT').val(item.loai_truyen);
                });
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

});