@extends('AdminPage/Index')
@section('content')
<div class="card shadow ">
    <div style="text-align:center">
    @foreach ($title as $t)
        <h2> {{ $t->ten_truyen }} </h2>
        <h4> {{ $t->ten_chap }} </h4>
    @endforeach
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive col-sm">
            <!-- <div class="container-fluid pb-5 read_img"> -->
                <ul style="list-style-type:none;">        
                    @foreach ($img as $i)
                    <li>
                        <img  src="{{ asset('truyen_ND/')}}/{{$i->noi_dung}}" alt="Image">
                    </li>
                    @endforeach
                </ul>
            <!-- </div> -->
        </div>
            <a href='' class="btn btn-danger btn-sm"  title="Click to back"><i class="fas fa-cloud-upload"></i>Trở lại</a>
    </div>
    
</div>



@endsection

@section('script')
@endsection