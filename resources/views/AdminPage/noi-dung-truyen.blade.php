@extends('AdminPage/Index')
@section('content')

<!-- <div class="card shadow mb-4">
    <div style="text-align:center">
        <h2> Dạ Ký </h2>
    </div>
</div>
<form id='test' >
@csrf
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold ">Tên chap mới :  </h6>
    </div>
    <div class="card-body">
        <div class="form-group">
            <input type="text" class="form-control form-control-user" id='nameChap' name="nameChap"
                placeholder="Nhập tên chap mới" required>
        </div>
    </div>
</div>
<input id="fileupload" type="file" name="files" multiple>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold ">Nội dung :  </h6>
    </div>
    <div class="card-body">        
            <textarea id="summernote" name="editordata"></textarea>
        <br />
            <br />
        <div style="text-align:center">
            <a  class="btn btn-success btn-sm" id="bt_Add_Nd" title="Nhấn để lưu"><i class="fas fa-cloud-upload"></i>Xác nhận</a>
            <a href='/admin/product' class="btn btn-danger btn-sm"  title="Click to back"><i class="fas fa-cloud-upload"></i>Trở lại</a>
        </div>
       
    </div>
</div>
</form> -->

<div class="card shadow ">
    <div style="text-align:center">
        @foreach ($chap as $ch)
            <h2> {{ $ch->ten_truyen }} </h2>
            <h4> {{ $ch->ten_chap }} </h4>
        @endforeach
    </div>
</div>
</br>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Hình ảnh sản phẩm :  </h6>
    </div>
    <div class="card-body">
        @foreach ($chap as $ch)
        <div class="table-responsive col-sm">
            
            <input type="hidden" class="form-control form-control-user" id='idDrop' value="{{ $ch->id }}">            
            <form method='post' action="/admin/truyen/chap/{{ $ch->id }}" class="dropzone" id="DropzoneForm" name="DropzoneForm" enctype="multipart/form-data" >
                @csrf
            </form>
            
            <br />
            <br />
            
            <br />
            <lable>Ảnh load</lable>
            <div class="dropzone" id="preview"></div>
            <br />
        </div>
            <a  class="btn btn-primary btn-sm" id="btDrop" title="Click to drop"><i class="fas fa-cloud-upload"></i>Xác nhận</a>
            <a href='/admin/truyen-tranh/{{ $ch->id_truyen }}' class="btn btn-danger btn-sm"  title="Click to back"><i class="fas fa-cloud-upload"></i>Trở lại</a>
        @endforeach
    </div>
    
</div>



@endsection

@section('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>

<!-- include libraries(jQuery, bootstrap) -->
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

<!-- include summernote css/js -->
<!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> -->

<!-- <script type="text/javascript">
            $('#summernote').summernote({
    height: 250,   //set editable area's height
    codemirror: { // codemirror options
        theme: 'monokai'
    }
    });
</script> -->

<!-- <script src="{{ asset('js/ajax/ajax_noi_dung.js') }}"></script> -->
<script src="{{asset('js/ajax/drop_images.js')}}" ></script>
@endsection