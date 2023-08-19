@extends('AdminPage/Index')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1>Profile</h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <!-- <section class="content"> -->
      <div class="container-fluid pb-5">
        <div class="row">
          @if (isset($user))
            @foreach ($user as $u)
            <div class="col-md-3">
              <!-- Profile Image -->
              <div class="card card-primary card-outline">
              <form class="form" id="form_avt" contentType="multipart/form-data">
                @csrf
                <div class="card-body box-profile">
                  <div class="carousel-inner product-item bg-light">
                      <div class="carousel-item active">
                          <img class="profile-user-img img-fluid img-circle" id="av" name="av" src="{{ asset('img/')}}/{{$u->avatar}}"  alt="User profile picture">
                          <input id='input_av' name="input_av" type="file" class="form-control" hidden >
                          <div class="product-action" >
                              <a class="btn btn-outline-dark btn-square" id="bt-av"><i class="fa fa-camera" title="Đổi ảnh"></i></a>
                          </div>
                      </div>
                  </div>
                  <a class="btn btn-primary btn-block" id="bt_SaveAvatar" style="display:none"><b>Save</b></a>
                </div>
                <!-- /.card-body -->
              </form>
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Thông tin</a></li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Mật khẩu</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" id="form-info">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" name="username" value="{{ $u->name }}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="email" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" value="{{ $u->email }}" disabled>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="birth" class="col-sm-2 col-form-label">Birthday</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="birth" name="birth" value="{{ $u->birth }}" onfocus="(this.type='date')" onblur="(this.type='text')" >
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <a class="btn btn-danger" id="btChangeInfo">Lưu</a>
                          </div>
                        </div>
                      </form>
                    </div>

                    <div class="tab-pane" id="settings">
                      <form class="form-horizontal" id="form-password">
                        @csrf
                        <div class="form-group row">
                          <label for="lastPass" class="col-sm-2 col-form-label">Mật khẩu cũ</label>
                          <div class="col-sm-10 ">
                            <input type="password" class="form-control hide-pass" id="lastPass" name="lastPass" placeholder="Nhập mật khẩu cũ">
                              <i for='lastPass' id="togglePass" class="bi bi-eye-slash"></i>
                            <label for="pass" generated="false" class="error "></label>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="newPass" class="col-sm-2 col-form-label">Mật khẩu mới</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu mới">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="rePass" class="col-sm-2 col-form-label">Xác nhận mật khẩu mới</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu mới">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <a  class="btn btn-danger" id="btChangePass">Lưu</a>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
            @endforeach
          @endif
        </div>
        <!-- /.row -->
      </div>
    <!-- </section> -->
  </div>


@endsection

@section('script')
<script>
    const ipnElement = document.querySelector('#lastPass')
    const ipnElement1 = document.querySelector('#password')
    const ipnElement2 = document.querySelector('#password_confirmation')
    const btToggle = document.querySelector('#togglePass')
    // const btnElement = document.querySelector('#btnPassword')

    // step 2
    btToggle.addEventListener('click', function() {
        // step 3
        const currentType = ipnElement.getAttribute('type')
        const currentType1 = ipnElement1.getAttribute('type')
        const currentType2 = ipnElement2.getAttribute('type')
        // step 4
        ipnElement.setAttribute('type', currentType === 'password' ? 'text' : 'password')
        ipnElement1.setAttribute('type', currentType1 === 'password' ? 'text' : 'password')
        ipnElement2.setAttribute('type', currentType2 === 'password' ? 'text' : 'password')

        this.classList.toggle('bi-eye')
    })    
</script>
<script>
    let img = document.getElementById('av');
    let btSave = document.getElementById('bt_SaveAvatar');
    let input = document.getElementById('input_av');
    input.onchange = (e) => {
    if (input.files[0])
        img.src = URL.createObjectURL(input.files[0]);
    btSave.style.display = 'block';
    };
</script>
<script>
$(document).on('click','#bt-av', function(e){
    e.preventDefault();
    $('#input_av').trigger('click');
});
</script>
<script src="{{ asset('js/ajax/ajax_user.js') }}" ></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
@endsection