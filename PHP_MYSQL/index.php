<?php
    define('IN_SITE', true);
    session_start();

    // Lấy common & action, url se co dang vd: https://php_mysql.com/?c=products&a=list
    $common = isset($_GET['c']) ? $_GET['c'] : 'users';
    $action = isset($_GET['a']) ? $_GET['a'] : 'login';

    // Neu common khong ton tai thi tro ve login
    $allow = ['layout', 'users', 'products'];
    if(!in_array($common, $allow)){
        $common = 'users';
        $action = 'login';
    }
    // Tạo đường dẫn
    $path = $common.'/'.$action.'.php';

    // Nếu path tồn tại thì import các file xử lý cần thiết
    if(file_exists($path))
    {
        include_once('./libs/database.php');
        include_once('./libs/helper.php');
        include_once('./libs/config.php');
        include_once('./users/validate.php');
        // include file hien tai
        include_once($path);
    }
    else
    {
        // 404 err
        include_once('./layout/404.php');
    }
?>