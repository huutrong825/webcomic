@extends('AdminPage/Index')
@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper pb-5">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <!-- <h1>Contacts</h1> -->
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Viewer</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

        <!-- Default box -->
        <div class="card card-solid viewer">
            <div class="card-body pb-0">
            <div class="row px-xl">
                @for ($i=0; $i < 1 ; $i++)
                <div class="col-12 pb-4 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0"> Thông tin  </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h3 class="lead" ><b style="font-weight: bolder;"> Tên viewer </b></h3>
                                    <p class="text-muted text-sm">Tên viewer  </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email: Demo Street 123, Demo</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> Ngày sinh : 12 12 2352</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="\img_truyen\bat_dau_tu_loi_noi_doi.jpg" alt="user-avatar" class="img-circle img-avatar">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">                                
                                <a href="#" class="btn btn-sm btn-primary bt-Block">
                                    <i class="fas fa-user "></i> Khóa người dùng
                                </a>
                                <a href="#" class="btn btn-sm btn-danger " title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
                @foreach ($viewer as $v)
                <div class="col-12 pb-4 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">Thông tin</div>
                        <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-7">
                                    <h3 class="lead" ><b style="font-weight: bolder;" > {{ $v->name }}</b></h3>
                                    <!-- <a class="text-muted text-sm" id="tenUser" value="{{ $v->name }}">Tên viewer  </a> -->
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email: {{ $v->email }}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> Ngày sinh : {{ $v->birth }}</li>
                                    </ul>
                                </div>
                            <div class="col-5 text-center">
                                <img src="{{ asset('img/')}}/{{ $v->avatar }}" alt="user-avatar" class="img-circle img-avatar">
                            </div>
                        </div>
                        </div>
                        <div class="card-footer">
                        <div class="text-right">
                            <a  class="btn btn-sm btn-primary bt-Block" value="{{ $v->id }}" >
                                    <i class="fas fa-user"></i> Khóa người dùng
                                </a>
                            <a value="{{ $v->id }}" class="btn btn-sm btn-danger bt-Delete" title="Xóa">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <nav aria-label="Contacts">
                    <ul class="pagination  m-0">
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                    <li class="page-item"><a class="page-link" href="#">7</a></li>
                    <li class="page-item"><a class="page-link" href="#">8</a></li>
                    </ul>
                </nav>
            </div>
            <!-- /.card-footer -->
        </section>
        <!-- /.content -->
    </div>

    <!-- Block Modal-->
<div class="modal fade" id="BlockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nhắc nhở</h5>
            </div>
            <div class="">
                <input type="hidden" class="form-control form-control-user" id='idBlock' >
            </div>
            <div class="modal-body">Xác nhận khóa/mở người dùng <span id='nameBlock' style="color:blue"></span></div>
            <div class="modal-footer">
                <a class="btn btn-primary btDSubmitBlock">Xác nhận</a>
                <button class="btn btn-danger " type="button" data-dismiss="modal">Cancel</button>                    
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal-->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nhắc nhở</h5>
            </div>
            <div class="">
                <input type="hidden" class="form-control form-control-user" id='idDelete' >
            </div>
            <div class="modal-body">Xác nhận xóa người dùng <span id='nameDelete' style="color:blue"></span></div>
            <div class="modal-footer">
                <a class="btn btn-primary btDSubmitDelete">Xác nhận</a>
                <button class="btn btn-danger " type="button" data-dismiss="modal">Cancel</button>                    
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/ajax/ajax_user_viewer.js') }}"></script>
@endsection