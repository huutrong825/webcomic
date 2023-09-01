@extends('AdminPage/Index')
@section('content')

<div class="card shadow mb-4">
    <div style="text-align:center">
        @foreach ($chap as $ch)
            <h2> {{ $ch->ten_truyen }} </h2>
            <h4> {{ $ch->ten_chap }} </h4>
        @endforeach

    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold ">Nội dung :  </h6>
    </div>
    <div class="card-body">
        <form id='test' >
            @csrf
            @foreach ($chap as $ch)
            <input type="hidden" class="form-control form-control-user" id='idChap' value="{{ $ch->id }}">
            @endforeach
            <textarea id="summernote" name="editordata"></textarea>
        </form>
        <br />
        <br />
        <div style="text-align:center">
            <a  class="btn btn-success btn-sm" id="bt_Add_Nd" title="Nhấn để lưu"><i class="fas fa-cloud-upload"></i>Xác nhận</a>
            <a href='/admin/truyen-tranh/{{ $ch->id_truyen }}' class="btn btn-danger btn-sm"  title="Click to back"><i class="fas fa-cloud-upload"></i>Trở lại</a>
        </div>
       
    </div>
</div>




@endsection

@section('script')

<!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

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
<!-- <script src="{{asset('js/ajax/drop_images.js')}}" ></script> -->
@endsection