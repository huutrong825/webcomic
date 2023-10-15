@extends('AdminPage/Index')
@section('content')

<div class="card shadow mb-4">
    <div style="text-align:center">
        @foreach ($title as $t)
            <h2> {{ $t->ten_truyen }} </h2>
            <h4> {{ $t->ten_chap }} </h4>
        @endforeach
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold ">Nội dung cập nhật:  </h6>
    </div>
    <div class="card-body">
        <form id='test' >
            @foreach ($noidung as $n)
            <input type="hidden" class="form-control form-control-user" id='idChapND' value="{{ $n->id }}">
            
            <textarea id="summernote" name="editordata">{{ $n->noi_dung }}</textarea>
            @endforeach
        </form>
        <br />
        <br />
        <div style="text-align:center">
            <a  class="btn btn-success btn-sm" id="bt_Update_Nd" title="Nhấn để lưu"><i class="fas fa-cloud-upload"></i>Cập nhật</a>
            <a href='' class="btn btn-danger btn-sm"  title="Click to back"><i class="fas fa-cloud-upload"></i>Trở lại</a>
        </div>
    </div>
</div>
@endsection

@section('script')

<!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<!-- include summernote css/js-->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script type="text/javascript">
            $('#summernote').summernote({
    height: 250,   //set editable area's height
    codemirror: { // codemirror options
        theme: 'monokai'
    }
    });
</script>

<script src="{{ asset('js/ajax/ajax_noi_dung.js') }}"></script>
@endsection