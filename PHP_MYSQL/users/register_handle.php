<?php
$email = $password = $name = '';

if(!empty($_POST))
{
    $email      = strtolower($_POST['email']);
    $password   = $_POST['password'];
    $name       = $_POST['name'];

    // Kiem tra email co ton tai khong
    $sql = 'select email from accounts';
    $result = db_get_list($sql);
    foreach ($result as $item)
    {
        if($item['email'] == $email)
        {
            setcookie('info', 'Email đã tồn tại', time() + 1, '/');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    if($name != '' && $email != '' && $password !='')
    {
        // salt cuc bo
        $staticSalt = 'G4334#';
        // Ma hoa password voi md5 kem salt
        $crypt = md5($staticSalt.$password);
        $sql = 'insert into accounts(email, password, name, role) values("'.$email.'", "'.$crypt.'", "'.$name.'", "user")';
        db_execute($sql);
        setcookie('info', 'Đăng ký thành công<br>Bạn có thể đăng nhập', time() + 1, '/');
        header('Location: '.create_url('users', 'login'));
    }
}
?>