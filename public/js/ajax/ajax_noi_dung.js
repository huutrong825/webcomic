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
                alertify.success(response.mes);
                // $('#formThemTruyen').trigger("reset");
                // $('form :input').trigger("reset");
            },
            error: function ()
            {
                alertify.error('Thêm thất bại');
            }
        });
    });
});

