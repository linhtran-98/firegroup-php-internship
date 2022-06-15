<?php
if (!defined('IN_SITE')) die ('The request not found');

// Biến lưu trữ kết nối
$conn = null;

// Hàm kết nối
function db_connect()
{
    global $conn;
    if(!$conn) {
        $conn = mysqli_connect('localhost', 'root', '', 'lkaudio') or die('Kết nối database thất bại');
        mysqli_set_charset($conn, 'UTF-8');
    }
}

function db_close()
{
   global $conn;
   if($conn) {
    mysqli_close($conn);
   }
}


// Hàm lấy danh sách, kết quả trả về danh sách các record trong một mảng
function db_get_list($sql)
{
    db_connect();
    global $conn;
    $data = [];
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $data[] = $row;
    }
    return $data;
}

// Hàm lấy chi tiết, dùng select theo id vì nó trả về 1 record 
// Nếu kết quả trả về nhiều hơn 1 record thì nó sẽ trả về record đầu tiên.
function db_get_row($sql)
{
    db_connect();
    global $conn;
    $result = mysqli_query($conn, $sql);
    $row = [];
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }
    return $row;
}

// Hàm thực thi câu truy vấn insert, update, delete
function db_execute($sql)
{
    db_connect();
    global $conn;
    return mysqli_query($conn, $sql);
}

function antiInjection($value)
{
    db_connect();
    global $conn;
    return mysqli_real_escape_string($conn, $value); 
}
