<?php
    $token = $_COOKIE['token'];
    $sql = "update accounts set token = null where token = '$token'";
    db_execute($sql);

    setcookie('token', '', time() - 10, '/');
    redirect_url(create_url('users', 'login'));
    exit(); 
?>