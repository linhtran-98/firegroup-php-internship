<?php
    if (!defined('IN_SITE')) die ('The request not found');
    include_once('./layout/header.php');

    // Lay danh sach category
    $sql = 'select * from category';
    $category = db_get_list($sql);
    $title_page = 'Thêm sản phẩm';
    $id = $title = $price = $image = $quantity = $description = $category_id = '';

    if(isset($_GET['id'])){
		$title_page = 'Sửa sản phẩm';
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
			// Lay sp hien thi theo id, case edit
			$sql = 'select * from products where product_id = '.$id.'';
			$product = db_get_row($sql);
			if($product != null) {
				$title       = $product['title'];
				$price       = $product['price'];
				$image       = $product['image'];
				$quantity    = $product['quantity'];
				$description = $product['description'];
				$category_id = $product['category_id'];
			}

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
        <h3 class="card-title font-weight-bold"><?=$title_page?></h3>
    </div>
    <form action="<?=create_url('products', 'add_edit_handle')?>" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Tên sản phẩm</label>
                <input type="text" required name="title" class="form-control" value="<?=$title?>">
                <input type="hidden" name="id" class="form-control" value="<?=$id?>">
                <input type="hidden" name="account_id" class="form-control" value="<?=$user['account_id']?>">
            </div>

            <div class="form-group">
                <label for="name">Giá</label>
                <input type="number" required name="price" class="form-control" value="<?=$price?>">
            </div>

            <div class="form-group">
                <label for="image">Ảnh đại diện</label>
                <input type="file" required name="image" class="form-control" id="image" value="<?=$image?>">
                <input type="hidden" name="product_image" class="form-control" id="product_image" value="<?=$image?>">
                <img src="./public/image/uploads/<?=$image?>" style="padding: 5px;" width="100px" alt="" id="product_img">
            </div>
            
            
            <div class="form-group">
                <label for="name">Số lượng tồn kho</label>
                <input type="number" required min="1" max="1000" name="quantity" class="form-control" value="<?=$quantity?>">
            </div>

            <div class="form-group">
                <label for="ckeditor_des">Chi tiết</label>
                <textarea class="form-control" required id="ckeditor_des" name="description"><?=$description?></textarea>
                <script>
                        CKEDITOR.replace( 'ckeditor_des' );
                </script>
            </div>

            <div class="form-group">
                <label>Thuộc danh Mục</label>
                <select class="form-control" name="category_id" >
                    <?php showCategories($category_id, $category) ?>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><?=$title_page?></button>
        </div>
    </form>
<?php include_once('./layout/footer.php') ?>