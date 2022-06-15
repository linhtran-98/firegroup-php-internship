<?php
    if (!defined('IN_SITE')) die ('The request not found');
    if(isset($_GET['delete_id'])){
        $id = antiInjection($_GET['delete_id']);
		$id = intval($id);
		// Check quyen
		$checkRole = checkRole($id, $user);
		if(!$checkRole){
			echo '<div class="alert alert-danger text-center">Bạn không thể thực hiện thao tác này</div><br>';
			echo '<a href="'.create_url('products', 'list').'" class="alert alert-success text-center">Trở lại</a><br>';
			die();
		}else{
            // Xoa album trên server
            $sql = 'select * from product_image where product_id = '.$id;
            $album = db_get_list($sql);
            foreach ($album as $key => $value) {
                unlink('public/image/uploads/'.$value['image_name']);
            }

            // Xoa album tren db
            $sql = 'delete from product_image where product_id ='.$id.'';
            db_execute($sql);

            // Xoa avatar
            $sql = 'select image from products where product_id = '.$id;
            $image = db_get_row($sql);
            unlink('public/image/uploads/'.$image['image']);

            // xoa product
            $sql = 'delete from products where product_id ='.$id.'';
            db_execute($sql);
        }
    }
?>