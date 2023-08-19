@extends('AdminPage/Index')
@section('content')
<div class="container-fluid pb-5">
    <div class="row">
        <div class="col-md-8">
        <div class="card">
            <div class="card-header border-transparent">
                <h5 style="float:left;" class="card-title">Latest Orders</h5>
                <a style="float:right; display:none" class="text-success" id="plus" onclick="myFunction()"><i class="fas fa-plus"></i></a>
                <a style="float:right; " class="text-success" id="minus"  onclick="myFunction()"><i class="fas fa-minus"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" id="demo1">
                <div class="table-responsive">
                    <table class="table m-0">
                    <thead>
                    <tr>
                        <th>Ảnh bìa</th>
                        <th>Tên truyện</th>
                        <th>Lượt thích</th>
                        <th>Lượt đọc</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><a href="pages/examples/invoice.html">OR9842</a></td>
                        <td>Call of Duty IV</td>
                        <td><span class="badge badge-success">Shipped</span></td>
                        <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="pages/examples/invoice.html">OR1848</a></td>
                        <td>Samsung Smart TV</td>
                        <td><span class="badge badge-warning">Pending</span></td>
                        <td>
                        <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="pages/examples/invoice.html">OR7429</a></td>
                        <td>iPhone 6 Plus</td>
                        <td><span class="badge badge-danger">Delivered</span></td>
                        <td>
                        <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="pages/examples/invoice.html">OR7429</a></td>
                        <td>Samsung Smart TV</td>
                        <td><span class="badge badge-info">Processing</span></td>
                        <td>
                        <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="pages/examples/invoice.html">OR1848</a></td>
                        <td>Samsung Smart TV</td>
                        <td><span class="badge badge-warning">Pending</span></td>
                        <td>
                        <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="pages/examples/invoice.html">OR7429</a></td>
                        <td>iPhone 6 Plus</td>
                        <td><span class="badge badge-danger">Delivered</span></td>
                        <td>
                        <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="pages/examples/invoice.html">OR9842</a></td>
                        <td>Call of Duty IV</td>
                        <td><span class="badge badge-success">Shipped</span></td>
                        <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                        </td>
                    </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header border-transparent">
                    <h5 style="float:left;" class="card-title">Recently Added Products</h5>
                    <a style="float:right; display:none" class="text-success" id="plus1" onclick="myFunction1()"><i class="fas fa-plus"></i></a>
                    <a style="float:right; " class="text-success" id="minus1"  onclick="myFunction1()"><i class="fas fa-minus"></i></a>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0" id="demo">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        <li class="item">
                            <div class="product-imgs" >
                                <img src="/img_truyen/bj_alex.jpg" alt="Product Image" class="img-size-50">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Samsung TV
                                <span class="badge badge-warning float-right">$1800</span></a>
                                <span class="product-description">
                                Samsung 32" 1080p 60Hz LED Smart HDTV.
                                </span>
                            </div>
                        </li>
                        <!-- /.item -->
                        <li class="item">
                            <div class="product-imgs">
                                <img src="/img_truyen/bj_alex.jpg" alt="Product Image" class="img-size-50">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Bicycle
                                <span class="badge badge-info float-right">$700</span></a>
                                <span class="product-description">
                                26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                                </span>
                            </div>
                        </li>
                        <!-- /.item -->
                        <li class="item">
                            <div class="product-imgs">
                                <img src="/img_truyen/bj_alex.jpg" alt="Product Image" class="img-size-50"> 
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">
                                Xbox One <span class="badge badge-danger float-right">
                                $350
                                </span>
                                </a>
                                <span class="product-description">
                                Xbox One Console Bundle with Halo Master Chief Collection.
                                </span>
                            </div>
                        </li>
                        <!-- /.item -->
                        <li class="item">
                            <div class="product-imgs">
                                <img src="/img_truyen/bj_alex.jpg" alt="Product Image" class="img-size-50">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">PlayStation 4
                                <span class="badge badge-success float-right">$399</span></a>
                                <span class="product-description">
                                PlayStation 4 500GB Console (PS4)
                                </span>
                            </div>
                        </li>
                        <li class="item">
                            <div class="product-imgs">
                                <img src="/img_truyen/bj_alex.jpg" alt="Product Image" class="img-size-50">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">PlayStation 4
                                <span class="badge badge-success float-right">$399</span></a>
                                <span class="product-description">
                                PlayStation 4 500GB Console (PS4)
                                </span>
                            </div>
                        </li>
                        <!-- /.item -->
                    </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                <a href="javascript:void(0)" class="uppercase">View All Products</a>
                </div>
                <!-- /.card-footer -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
function myFunction() {
  var x = document.getElementById("demo1");
  var y = document.getElementById("plus");
  var z = document.getElementById("minus");
  if (x.style.display === "none") {
    x.style.display = "block";
    z.style.display = "block";
    y.style.display = "none";
    
  } else {
    x.style.display = "none";
    y.style.display = "block";
    z.style.display = "none";
  }
}

function myFunction1() {
  var x = document.getElementById("demo");
  var y = document.getElementById("plus1");
  var z = document.getElementById("minus1");
  if (x.style.display === "none") {
    x.style.display = "block";
    z.style.display = "block";
    y.style.display = "none";
    
  } else {
    x.style.display = "none";
    y.style.display = "block";
    z.style.display = "none";
  }
}
</script>
@endsection