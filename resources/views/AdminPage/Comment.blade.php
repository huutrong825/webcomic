@extends('AdminPage/Index')
@section('content')

 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1>FAQ</h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ asset('/admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Comment</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="container-fluid pb-5">
        <div class="row pb-0">
            <div class="col-12 " id="accordion">
                @foreach( $comment as $c)
                <div class="card card-primary card-outline ">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapse{{ $c->id }}">
                        <div class="card-header">
                            <h4 class="card-title w-100">{{ $c->name }} <small> - <i>{{ $c->ten_truyen }}</i></small></h4> 
                        </div>
                    </a>
                    <div id="collapse{{ $c->id }}" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            {{ $c->noi_dung }}
                            <a class='btn bt_DeleteCm' style="float:right" title='Xóa bình luận' value='{{ $c->id }}'><i class="fas fa-times"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>

  <!-- Delete Modal Comment-->
  <div class="modal hide fade in" id="modal_Deleted_Comment" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nhắc nhở</h5>
            </div>
            <div class="">
                <input type="hidden" class="form-control form-control-user" id='idDeleteComment' >
            </div>
            <div class="modal-body">Xác nhận xóa bình luận </div>
            <div class="modal-footer">
                <a class="btn btn-primary bt_xacnhan_bai">Xác nhận</a>
                <button class="btn btn-danger " type="button" data-dismiss="modal">Cancel</button>                    
            </div>
        </div>
    </div>
  </div>

@endsection

@section('script')
<script>

$(document).on('click','.bt_DeleteCm',function(e)
{
    e.preventDefault();
    var _id = $(this).attr('value');
    $('#modal_Deleted_Comment').modal('show');
    $.ajax({
        url:'/admin/comment/get/' +_id,
        type: 'get',
        success:function(response)
        {
            $('#idDeleteComment').val(response.comment.id);
            // $('#nameDelete').html(response.viewer.name); 
        },
        error: function (err)
        {
            alert('Lỗi');
        }
    });
});

// Xác nhận xóa

$(document).on('click','.bt_xacnhan_bai', function(e)
{
    e.preventDefault();
    var id = $('#idDeleteComment').val();
    $.ajax({
        url:'/admin/comment/deleted/' + id,
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
</script>
@endsection