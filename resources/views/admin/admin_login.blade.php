<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TL-Shop</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('public/backend/images/logos/favicon.png')}}" />
  <link rel="stylesheet" href="{{asset('public/backend/css/styles.min.css')}}" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0" style="width: 370px;">
              <div class="card-body">
                <a class="text-nowrap logo-img text-center d-block w-100">
{{--                   <img src="{{asset('public/backend/images/logos/favicon.png')}}" width="32" alt="">
 --}}                  <p style="text-align: center; font-size: 30px; font-weight: bold; margin-bottom: 2px;">ĐĂNG NHẬP</p>

                </a>
                <p class="text-center" style="font-weight: bold; margin-bottom: 10px">Chào mừng bạn đến với TL-Shop</p>

                <?php
                  $message = Session::get('message');
                  if($message){
                    echo '<span class="text-alert" style="font-weight: bold;">'.$message.'</span>';
                    Session::put('message', null);
                  }
                ?>

                <form action="{{URL::to('/admin-dashboard')}}" method="post">
                  {{ csrf_field() }}
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tài khoản</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="admin_email" aria-describedby="emailHelp" required="">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" name="admin_password" id="exampleInputPassword1" required="">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Ghi nhớ tài khoản
                      </label>
                    </div>
                    <a class="text-primary fw-bold" href="./index.html">Quên mật khẩu?</a>
                  </div>
                  <input type="submit" name="login" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="ĐĂNG NHẬP">
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Bạn chưa có tài khoản?</p>
                    <a class="text-primary fw-bold ms-2" href="./authentication-register.html">Tạo tài khoản mới</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{asset('public/backend/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('public/backend/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>