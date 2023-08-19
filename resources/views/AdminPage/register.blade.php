@extends('AdminPage/Index')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  
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
              <li class="breadcrumb-item active">Thêm User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active">Thêm user</a></li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <form class="form-horizontal" id="form-register">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name User</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtname" placeholder="Nhập tên user" name="txtname">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" placeholder="Nhập email" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Nhập mật khẩu</label>
                        <div class="col-sm-10 ">
                            <input type="password" class="form-control hide-pass" id="password" placeholder="Nhập mật khẩu" name="password">
                            <i id="togglePass" class="bi bi-eye-slash input-group-append"></i>
                            <label for="pass" generated="false" class="error "></label>
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Nhập lại mật khẩu</label>
                        <div class="col-sm-10 ">
                            <input type="password" class="form-control" id="password_confirmation" placeholder="Nhập lại mật khẩu" name="password_confirmation">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Cấp admin</label>
                        <div class="col-sm-10 ">
                            <select type="password" class="form-control" id='ad_level' name="ad_level">
                                <option value="1"> Admin </option>
                                <option value="2"> Admin 2 </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <a  id="registerAd" class="btn btn-danger">Tạo</a>
                        </div>
                    </div>
                </form>
            </div>
        <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>


@endsection

@section('script')
<script>
    const ipnElement = document.querySelector('#pass')
    const ipnElement1 = document.querySelector('#repass')
    const btToggle = document.querySelector('#togglePass')

    // step 2
    btToggle.addEventListener('click', function() {
        // step 3
        const currentType = ipnElement.getAttribute('type')
        const currentType1 = ipnElement1.getAttribute('type')
        // step 4
        ipnElement.setAttribute('type', currentType === 'password' ? 'text' : 'password')
        ipnElement1.setAttribute('type', currentType === 'password' ? 'text' : 'password')

        this.classList.toggle('bi-eye')
    })

    
</script>

<script src="/js/ajax/ajax_user.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
@endsection