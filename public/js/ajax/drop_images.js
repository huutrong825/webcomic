drop();
function drop(){
    Dropzone.options.DropzoneForm = {
        autoProcessQueue: false,
        acceptedFiles:".png,.jpg,.gif,.bmp,.jpeg",
        init: function(){
            var submitButton = document.querySelector('#btDrop');
            myDropzone = this;
            submitButton.addEventListener("click", function(){
                myDropzone.processQueue();
            });
            this.on("complete", function(){
                if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
                {
                    var _this = this;
                    _this.removeAllFiles();
                }
                alertify.success('Thêm thành công');
                list_image();
            });
            // alertify.success('Thêm thất bại');
        },
    }
    list_image();
    function list_image()
    {
        var id = $('#idDrop').attr('value');
        $.ajax({
        url: "/admin/truyen/chap/review/" + id ,
        type: 'get',
        success: function(response){
            $('#preview').html(response.img);
        },
      });
    }

    $(document).on('click','.remove_image', function(){
        var id = $(this).attr('value');
        $.ajax({
            url: '/admin/truyen/chap/remove/' + id,
            type: 'get',
            success: function(response)
            {
                list_image();
            }
        });
    });
};

