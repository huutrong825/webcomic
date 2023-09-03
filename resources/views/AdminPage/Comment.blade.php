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
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>

@endsection

@section('script')
@endsection