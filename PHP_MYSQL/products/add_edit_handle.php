<?php
	$id = $title = $price = $image = $quantity = $description = $category_id = '';
	// Xu ly luu tru
    if(!empty($_POST)) {
		$title_page = 'Thêm sản phẩm';
		
		// Neu id ton tai thi se upload thay vi add va nguoc lai
		if(isset($_POST['id'])){
			$id = $_POST['id'];
		}

        if(isset($_POST['title'])) {
            $title = $_POST['title'];
			$title = str_replace('"', '\\"', $title);

        }

		if(!empty($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
			$image = str_replace('"', '\\"', $image);
        }else{
			$image = $_POST['product_image'];
		}

        if(isset($_POST['price'])){
			$price = $_POST['price'];
			$price = str_replace('"', '\\"', $price);

		}

        if(isset($_POST['quantity'])){
			$quantity = $_POST['quantity'];
			$quantity = str_replace('"', '\\"', $quantity);

		}

        if(isset($_POST['description'])){
			$description = $_POST['description'];
			$description = str_replace('"', '\\"', $description);

		}

		$account_id = $_POST['account_id'];

        if(isset($_POST['category_id'])){
			$category_id = $_POST['category_id'];
		}

        if(!empty($_POST['title'])) {
			if(isset($_FILES["image"]) && $_FILES["image"]["name"]){
				$image = uploadFile($_FILES["image"]);
			};

            $created_at = $updated_at = date('Y-m-d H:i:s', time());
			if(!$id){
				// Neu khong ton tai id thi insert
				$sql = 'insert into products(title, price, image, quantity, description, account_id, category_id) 
						VALUES ("'.$title.'", "'.$price.'", "'.$image.'", "'.$quantity.'", "'.$description.'", "'.$account_id.'","'.$category_id.'")';
				
				db_execute($sql);
				header('Location: ' .create_url('products', 'list'));
				exit();
			}
			else{
				// Nguoc lai thi update
				$sql = 'update products set title 		 = "'.$title.'",
											price 		 = "'.$price.'",
											image 	 	 = "'.$image.'",
											quantity	 = "'.$quantity.'",
											description  = "'.$description.'",
											category_id  = "'.$category_id.'",
											updated_at	 = "'.$updated_at.'" 
									    where product_id = "'.$id.'"';
				db_execute($sql);
				setcookie('success', 'Sủa sản phẩm thành công', time() + 1, '/');
				header('Location: ' . $_SERVER['HTTP_REFERER']);
				exit();
			}
        }
    }
?>