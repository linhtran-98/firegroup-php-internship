<?php
    $product_id = $image_name = '';
    if(!empty($_POST['product_id'])){
        $product_id = $_POST['product_id'];
    }
    if(isset($_POST['album_add'])){
        
        if(isset($_FILES['album']) && $_FILES['album']['name'] != ['']){
            $image_upload = reArrayFiles($_FILES['album']);
    
            foreach ($image_upload as $key => $file) {
                $image_name = uploadFile($file);
                
                $sql = 'insert into product_image (product_id, image_name) values ("'.$product_id.'", "'.$image_name.'")';
                db_execute($sql);
            }
            setcookie('success', 'Thêm album thành công', time() + 1, '/');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }else{
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }else{
        // xoa anh tren server
        $sql = 'select * from product_image where product_id = '.$product_id;
        $album = db_get_list($sql);
        foreach ($album as $key => $value) {
            unlink('public/image/uploads/'.$value['image_name']);
        }

        // Xoa anh trong db
        $sql = 'delete from product_image where product_id = '.$product_id;
        db_execute($sql);
        setcookie('success', 'Xóa album thành công', time() + 1, '/');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

?>