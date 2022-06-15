<?php
// Code PHP xử lý validate
$error = array();
$data = array();

if (isset($_POST['register_action']))
{
    // Lấy dữ liệu
    $data['email']    = isset($_POST['email']) ? $_POST['email'] : '';
    $data['password'] = isset($_POST['password']) ? $_POST['password'] : '';
    $data['name']     = isset($_POST['name']) ? $_POST['name'] : '';
    
    // Kiểm tra định dạng dữ liệu
    if (empty($data['name'])){
        $error['name'] = 'Bạn chưa nhập tên';
    }
    
    if (empty($data['email'])){
        $error['email'] = 'Bạn chưa nhập email';
    }
    else if (!is_email($data['email'])){
        $error['email'] = 'Email không đúng định dạng';
    }
    
    if (empty($data['password'])){
        $error['password'] = 'Bạn chưa nhập password';
    }
    if (strlen($data["password"]) < 8) {
        $error['password'] = "Mật khẩu của bạn phải có ít nhất 8 ký tự!";
    }
    elseif(!preg_match("#[0-9]+#",$data["password"]) || !preg_match("#[A-Z]+#",$data["password"]) || !preg_match("#[a-z]+#",$data["password"])) {
        $error['password'] = "Mật khẩu của bạn phải chứa ít nhất 1 số, 1 chữ cái viết thường và 1 chữ cái viết hoa!";
    }
    // Lưu dữ liệu
    if (!$error){
        include_once('./users/register_handle.php');
    }
    else{
        foreach ($error as $item) {
            echo '<div class="alert alert-danger text-light text-center">'.$item.'</div><br>';
        }
    }
}

if (isset($_POST['login_action']))
{
    // Lấy dữ liệu
    $data['email']    = isset($_POST['email']) ? $_POST['email'] : '';
    $data['password'] = isset($_POST['password']) ? $_POST['password'] : '';
    
    // Kiểm tra định dạng dữ liệu
    if (empty($data['email'])){
        $error['email'] = 'Bạn chưa nhập email';
    }
    else if (!is_email($data['email'])){
        $error['email'] = 'Email không đúng định dạng';
    }
    else if (strlen($data['email']) > 50){
        $error['email'] = 'Email không được vượt quá 50 ký tự';
    }
    
    if (empty($data['password'])){
        $error['password'] = 'Bạn chưa nhập password';
    }
    else if (strlen($data['password']) > 50){
        $error['password'] = 'password không được vượt quá 50 ký tự';
    }
    
    // Lưu dữ liệu
    if (!$error){
        include_once('./users/login_handle.php');
    }
    else{
        foreach ($error as $item) {
            echo '<div class="alert alert-danger text-light text-center">'.$item.'</div><br>';
        }
    }
}


function is_email($str) {
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}
?>