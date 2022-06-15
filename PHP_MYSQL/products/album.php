<?php
    if (!defined('IN_SITE')) die ('The request not found');
    include_once('./layout/header.php');

    if(isset($_GET['id'])){
		// Ngan SQL Injection
		$id = antiInjection($_GET['id']);
		$id = intval($id);

		// Check quyen
		$checkRole = checkRole($id, $user);
		if(!$checkRole){
			echo '<div class="alert alert-danger text-center">Bạn không có quyền thao tác trên sản phẩm này, quay đầu là bờ</div><br>';
			echo '<a href="'.create_url('products', 'list').'" class="alert alert-success text-center">Trở lại</a><br>';
			die();
		}else{
			// Lay sp hien thi theo id
			$sql = 'select title, image from products where product_id = '.$id.'';
			$product = db_get_row($sql);

            // Lay album anh
            $sql = 'select * from product_image where product_id = '.$id;
            $album = db_get_list($sql);
		}
	}
    ?>
    <?php if(isset($_COOKIE['success'])){
        echo    '<div class="card-header">
                    <h5 class="alert alert-success text-center">'.$_COOKIE['success'].'</h5>
                </div>';
    }?>
    <div class="card-header">
        <h3 class="card-title font-weight-bold">album ảnh sản phẩm</h3>
    </div>
    <form action="<?=create_url('products', 'album_handle')?>" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Tên sản phẩm</label>
                <input type="text" name="title" class="form-control" value="<?=$product['title']?>">
                <img src="./public/image/uploads/<?=$product['image']?>" style="padding: 5px;" width="100px" alt="" id="product_img">
                <input type="hidden" name="product_id" class="form-control" value="<?=$id?>">
            </div>
            
            <?php if(isset($album)){ ?>
                <div class="form-group">
                    <label for="image">Album ảnh (Bạn có thể chọn nhiều ảnh bằng cách giữ shift or ctrl)</label>
                    <input type="file" multiple name="album[]" class="form-control" id="image_album">
                        <?php foreach ($album as $key => $value) { 
                            echo '<img src="./public/image/uploads/'.$value['image_name'].'" style="padding: 5px;" width="100px" alt="" id="product_img">';
                        } ?>
                    <div id="box">
                        <img src="./public/image/uploads/<?=$image?>" width="100px" alt="" id="album_product">
                    </div>
                </div>
            <?php } else { ?>
                <div class="form-group">
                    <label for="image">Album ảnh (Bạn có thể chọn nhiều ảnh bằng cách giữ shift or ctrl)</label>
                    <input type="file" multiple name="album[]" class="form-control" id="image_album">
                    <div id="box">
                        <img src="./public/image/uploads/<?=$image?>" width="100px" alt="" id="product_img">
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="card-footer">
            <button type="submit" name="album_add" class="btn btn-primary">Thêm album</button>
            <button type="submit" name="album_delete" class="btn btn-danger float-right">Xóa album</button>
        </div>
    </form>
<?php include_once('./layout/footer.php') ?>