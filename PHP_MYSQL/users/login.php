<?php
  $user = validateToken();
  if($user){
      redirect_url(create_url('products', 'list'));
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" type="image/png" href="./public/image/user_icon/android-chrome-512x512.png"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&public/display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="./public/template/admin/dist/css/adminlte.min.css">
  <title>Login</title>
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Admin</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <!-- @include('admin.alert') -->
        <h5 class="login-box-msg text-danger"><?=isset($_COOKIE['info']) ? $_COOKIE['info'] : 'Đăng nhập'?></h5>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input maxlength="50" type="email" name="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input maxlength="50" type="password" name="password" class="form-control" placeholder="Mật khẩu">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
              <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember" style>
                  Ghi nhớ đăng nhập
                </label>
              </div>
          </div>

          <div class="row mb-3">
            <!-- /.col -->
            <div class="col-6">
              <button name="login_action" type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
            </div>
            
            <div class="col-6">
              <a href="<?=create_url('users', 'register')?>" class="btn btn-success btn-block">Đăng ký</a>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <div class="row mb-3">
            <div class="col-12">
              <a href="./public/image/uploads/adminAccount.pdf" class="btn text-dark btn-block" style="background-image: linear-gradient(to right,#c6ffdd, #fbd786, #f7797d);">Xem tài khoản admin tại đây <br>Thực tế tất nhên sẽ không hiển thị nút này</a>
            </div>
          </div>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
</body>
</html>
