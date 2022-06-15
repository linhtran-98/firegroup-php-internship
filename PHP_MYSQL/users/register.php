<?php
  $user = validateToken();
  if($user){
      redirect_url(create_url('layout', 'main'));
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" type="image/png" href="./public/image/user_icon/android-chrome-512x512.png"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&public/display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="./public/template/admin/dist/css/adminlte.min.css">
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
          <h5 class="login-box-msg text-danger"><?=isset($_COOKIE['info']) ? $_COOKIE['info'] : 'Đăng ký'?></h5>

          <form id="RegisterForm" action="" method="post">
            <div class="input-group mb-3">
              <input maxlength="50" required type="text" name="name" class="form-control" placeholder="Tên của bạn">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="	fab fa-amilia"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input maxlength="50" required type="email" name="email" class="form-control" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input maxlength="50" required type="password" name="password" class="form-control" placeholder="Mật khẩu">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              <small class="form-text text-muted">Có ít nhất 8 ký tự bao gồm chữ viết hoa, thường và số</small>
            </div>
            <div class="input-group mb-3">
              <input maxlength="50" required type="password" name="re_password" class="form-control" placeholder="Nhập lại mật khẩu">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-undo"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- /.col -->
              <div class="col-6">
                  <button name="register_action" type="submit" class="btn btn-primary btn-block">Đăng ký</button>
                </div>
            <div class="col-6">
                <a href="<?=create_url('users', 'login')?>" class="btn btn-success btn-block">Trở lại đăng nhập</a>
            </div>
          </form>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
  <!-- /.login-box -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(function() {
      $('#RegisterForm').submit(function() {
        if($('[name=password]').val() != $('[name=re_password]').val()) {
          alert('Mật khẩu không khớp, vui lòng nhập lại !!!')
          return false;
        }
        return true;
      })
    });
  </script>
  </body>
</html>
