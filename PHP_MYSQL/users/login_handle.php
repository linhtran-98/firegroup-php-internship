<?php 
    $email = $password = $remember = '';
    
    if (!empty($_POST)) 
    {
        if(isset($_POST['remember']))
        {
            $remember  = $_POST['remember'];
        }

        $email     = $_POST['email'];
        $password  = $_POST['password'];
        
        if($email != '' && $password != '') 
        {
            // salt bi mat
            $staticSalt = 'G4334#';
            // Kiem tra passwword co dung khong
            $crypt = md5($staticSalt.$password);
            // Kiem tra email co ton tai khong
            $sql   = "select * from accounts where email = '$email' and password = '$crypt'";
            $data  = db_get_list($sql);

            if($data != null && count($data) > 0) {
                // set cookie token voi md5
                $token = md5($data[0]['email']);
                if($remember){
                    setcookie('token', $token, time()+7*24*60*60, '/');
                }else{
                    setcookie('token', $token, 0, '/');
                }

                // update token vao db
                $sql = "update accounts set token = '$token' where account_id = ".$data[0]['account_id'];
                db_execute($sql);
                redirect_url(create_url('products', 'list'));
                exit();
            }
            else 
            {
                echo '<div class="alert alert-danger text-light text-center">Sai tên đăng nhập hoặc mật khẩu</div>';
            } 
        }
    }
?>