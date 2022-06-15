<?php
    if (!defined('IN_SITE')) die ('The request not found');
    include_once('./layout/header.php');

    if($user['role'] != 'admin'){
        header('Location: '.create_url('products', 'list'));
        exit();
    }
    if(isset($_GET['account_id'])){
        $id = antiInjection($_GET['account_id']);
        $id = intval($id);
        $sql = 'select * from accounts where account_id = '.$id;
        $data = db_get_row($sql);
        if(!$data){
            echo '<div class="alert alert-danger text-center">Bạn không có quyền này, quay đầu là bờ</div><br>';
			echo '<a href="'.create_url('users', 'list').'" class="alert alert-success text-center">Trở lại</a><br>';
			die();
        }
    }else{
        echo '<div class="alert alert-danger text-center">Bạn không có quyền này, quay đầu là bờ</div><br>';
        echo '<a href="'.create_url('users', 'list').'" class="alert alert-success text-center">Trở lại</a><br>';
        die();
    }
?>
    <?php if(isset($_COOKIE['success'])){
        echo    '<div class="card-header">
                    <h5 class="alert alert-success text-center">'.$_COOKIE['success'].'</h5>
                </div>';
    }?>
    <div class="card-header">
        <h3 class="card-title font-weight-bold">Sửa thông tin user</h3>
    </div>
    <form action="<?=create_url('users', 'edit_handle')?>" method="post">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Tên user</label>
                <input type="text" name="name" class="form-control" value="<?=$data['name']?>">
                <input type="hidden" name="account_id" class="form-control" value="<?=$id?>">
            </div>

            <div class="form-group">
                <label for="name">Email</label>
                <input type="email" name="email" class="form-control" value="<?=$data['email']?>">
            </div>

            <div class="form-group">
                <label for="image">Quyền</label>
                <select name="role" class="form-control">
                    <?php if($data['role'] == 'admin'){
                        echo '<option selected value="admin">admin</option>';
                        echo '<option value="user">user</option>';

                    }else{
                        echo '<option selected value="user">user</option>';
                        echo '<option value="admin">admin</option>';
                    } ?>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Sửa</button>
        </div>
    </form>
<?php include_once('./layout/footer.php') ?>