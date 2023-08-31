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
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                        <div class="card-header">
                            <h4 class="card-title w-100">{{ $c->name }}</h4>
                        </div>
                    </a>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            {{ $c->noi_dung }}
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                2. Aenean massa
                            </h4>
                        </div>
                    </a>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                3. Donec quam felis
                            </h4>
                        </div>
                    </a>
                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                        </div>
                    </div>
                </div>
                <div class="card card-warning card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                4. Donec pede justo
                            </h4>
                        </div>
                    </a>
                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
                        </div>
                    </div>
                </div>
                <div class="card card-warning card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFive">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                5. In enim justo
                            </h4>
                        </div>
                    </a>
                    <div id="collapseFive" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
                        </div>
                    </div>
                </div>
                <div class="card card-warning card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseSix">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                6. Integer tincidunt
                            </h4>
                        </div>
                    </a>
                    <div id="collapseSix" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.
                        </div>
                    </div>
                </div>
                <div class="card card-danger card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseSeven">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                7. Aenean leo ligula
                            </h4>
                        </div>
                    </a>
                    <div id="collapseSeven" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.
                        </div>
                    </div>
                </div>
                <div class="card card-danger card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseEight">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                8. Aliquam lorem ante
                            </h4>
                        </div>
                    </a>
                    <div id="collapseEight" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet.
                        </div>
                    </div>
                </div>
                <div class="card card-danger card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseNine">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                9.  Quisque rutrum
                            </h4>
                        </div>
                    </a>
                    <div id="collapseNine" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>

@endsection

@section('script')
@endsection