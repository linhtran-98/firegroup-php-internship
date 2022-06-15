<?php 
    if (!defined('IN_SITE')) die ('The request not found');
    include_once('./layout/header.php');
    include_once('./products/delete.php');

    $title_page = 'Danh sách sản phẩm';
    if(isset($_GET['account_id'])){
        $account_id = antiInjection($_GET['account_id']);
		$account_id = intval($account_id);
        $getName    = 'select name from accounts where account_id = '.$account_id;
        $name       = db_get_row($getName);
        if($name)
        {
            $title_page = 'Danh sách sản phẩm của <span class="text text-primary">'.$name['name'].'</span>';
        }
        $sql = 'select product_id, title, image, price, c.name as c_name, quantity, p.created_at p_created_at, updated_at, a.name as a_name from accounts as a, category as c, products as p where a.account_id = p.account_id and p.category_id = c.cate_id and a.account_id = '.$account_id.' order by product_id desc';
        
    }else if($user['role'] == 'user'){
        $sql = 'select product_id, title, image, price, c.name as c_name, quantity, p.created_at p_created_at, updated_at, a.name as a_name from accounts as a, category as c, products as p where a.account_id = p.account_id and p.category_id = c.cate_id and a.account_id = '.$user['account_id'].' order by product_id desc';
    }else{
        $sql = 'select product_id, title, image, price, c.name as c_name, quantity, p.created_at p_created_at, updated_at, a.name as a_name from accounts as a, category as c, products as p where a.account_id = p.account_id and p.category_id = c.cate_id order by product_id desc';
    }
    $data = db_get_list($sql);
?>
    <?php if(isset($_COOKIE['success'])){
        echo    '<div class="card-header">
                    <h5 class="alert alert-success text-center">'.$_COOKIE['success'].'</h5>
                </div>';
    }?>
    <div class="card-header">
        <h3 class="card-title font-weight-bold"><?=$title_page?></h3>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr class="text-center">
                    <th style="width: 10px;">#</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Giá</th>
                    <th>Danh mục</th>
                    <th>Kho</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Người tạo</th>
                    <th colspan="3" class="text-center">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $key => $value) { ?>
                        <tr class="text-center">
                        <td><?=$key+1?></td>
                        <td><?=$value['title']?></td>
                        <td><img src="./public/image/uploads/<?=$value['image']?>" width="100px" alt="" srcset=""></td>
                        <td><?=number_format($value['price'], '0', '.', '.')?>đ</td>
                        <td><?=$value['c_name']?></td>
                        <td><?=$value['quantity']?></td>
                        <td><?=$value['p_created_at']?></td>
                        <td><?=$value['updated_at']?></td>
                        <td class="text-success font-weight-bold"><?=$value['a_name']?></td>
                            <?php if(checkRole($value['product_id'], $user)){ ?>
                                <td class="text-center"><a class="btn btn-success" href="<?=create_url('products', 'album', '&id='.$value['product_id'].'')?>">Album</a></td>
                                <td class="text-center"><a class="btn btn-primary" href="<?=create_url('products', 'add_edit', '&id='.$value['product_id'].'')?>">Sửa</a></td>
                                <td class="text-center"><a class="btn btn-danger" href="<?= create_url('products', 'list', '&delete_id='.$value['product_id'].'') ?>">Xóa</a></td>
                            <?php } else{ ?>
                                <td class="text-center"><a class="btn btn-secondary" style="cursor: not-allowed;">Album</a></td>
                                <td class="text-center"><a class="btn btn-secondary" style="cursor: not-allowed;">Sửa</a></td>
                                <td class="text-center"><a class="btn btn-secondary" style="cursor: not-allowed;">Xóa</a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php include_once('./layout/footer.php') ?>
