<?php
if (!defined('IN_SITE')) die ('The request not found');

// Hàm tạo URL
function create_url($common = '', $action = '', $add = ''){
	if($add){
		return 'http://localhost/PHP_MYSQL/?c='.$common.'&a='.$action.$add;
	}
    return 'http://localhost/PHP_MYSQL/?c='.$common.'&a='.$action;
}
 
function redirect_url($url){
    header("Location:{$url}");
    exit();
}

// Lay thong tin user neu co cookie 'token'
function validateToken() {
	$token = '';

	if (isset($_COOKIE['token'])) {
		$token = $_COOKIE['token'];
		$sql   = "select * from accounts where token = '$token'";
		$data  = db_get_list($sql);
		if ($data != null && count($data) > 0) {
			return $data[0];
		}
	}
	return null;
}

// Linh hon cua bai tap, check quyen cua user
function checkRole($id, $user = [])
{
	$id = antiInjection($id);
	$id = intval($id);
    if($user['role'] == 'admin'){
        $sql = 'select product_id 
                from products 
                where product_id = '.$id.' and product_id not in (	select product_id 
                                                                    from products inner join accounts on products.account_id = accounts.account_id 
                                                                    where role = "admin" and products.account_id != '.$user['account_id'].')';
    }else{
		$sql = 'select product_id from products where account_id ='.$user['account_id'].' and product_id = '.$id;
	}
    $checkRole = db_get_row($sql);
	return $checkRole;
}

// Menu da cap
function showCategories($category_id, $categories, $parent_id = 0, $char = '')
{
    foreach ($categories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item['parent_id'] == $parent_id)
        {
            if($item['cate_id'] == $category_id){
                echo '<option selected value="'.$item['cate_id'].'">'.$char . $item['name'].'</option>';
            }else{
                echo '<option value="'.$item['cate_id'].'">'.$char . $item['name'].'</option>';

            }
             
            // Xóa chuyên mục đã lặp
            unset($categories[$key]);
             
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories($category_id, $categories, $item['cate_id'], $char.'↪️');
        }
    }
}

function uploadFile($file = []){
    $target_dir    = "./public/image/uploads/";

    //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
    $imageName = basename($file["name"]);
    $target_file   = $target_dir . $imageName;
    $allowUpload   = true;
  
    // Nếu file đã tồn tại thì thêm số ngẫu nhiên vào tên file
    while(file_exists($target_file))
    {
        $imageName = rand(0, 32767).'_'.$imageName;
        $target_file   = $target_dir . $imageName;
    }
  
    //Lấy phần mở rộng của file (jpg, png, ...)
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  
    // Cỡ lớn nhất được upload (bytes)
    $maxfilesize   = 800000;
  
    ////Những loại file được phép upload
    $allowtypes    = array('jpg', 'png', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', '');
  
  
    if(isset($_POST["submit"])) {
        //Kiểm tra xem có phải là ảnh bằng hàm getimagesize
        $check = getimagesize($file["tmp_name"]);
        if($check !== false)
        {
            echo "Đây là file ảnh - " . $check["mime"] . ".";
            $allowUpload = true;
        }
        else
        {
            echo "Không phải file ảnh.";
            $allowUpload = false;
        }
    }
  
    // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
    if ($file["size"] > $maxfilesize)
    {
        echo "Không được upload ảnh lớn hơn $maxfilesize (bytes).";
        $allowUpload = false;
    }
  
  
    // Kiểm tra kiểu file
    if (!in_array($imageFileType,$allowtypes ))
    {
        echo "Chỉ được upload các định dạng JPG, PNG, JPEG, GIF";
        $allowUpload = false;
    }
  
    if ($allowUpload)
    {
        move_uploaded_file($file["tmp_name"], $target_file);
    }
    else
    {
        die("Không upload được file, có thể do file lớn, kiểu file không đúng ...");
    }
    return $imageName;
}

// Dinh dang lai array cua $_FILES
function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}

