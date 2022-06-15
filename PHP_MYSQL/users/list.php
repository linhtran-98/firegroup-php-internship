<?php 
    if (!defined('IN_SITE')) die ('The request not found');
    include_once('./layout/header.php');

    if($user['role'] != 'admin'){
        echo '<div class="alert alert-danger text-center">Bạn không có quyền này, quay đầu là bờ</div><br>';
        echo '<a href="'.create_url('products', 'list').'" class="alert alert-success text-center">Trở lại</a><br>';
        die();
    }

    $sql = 'select * from accounts where account_id != '.$user['account_id'];
    $data = db_get_list($sql);
?>
    <div class="card-header">
        <h3 class="card-title font-weight-bold">Danh Sách User</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr class="text-center">
                    <th style="width: 10px;">#</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Quyền</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                    <th colspan="2" class="text-center">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $key => $value) { ?>
                        <tr class="text-center">
                            <td><?=$key+1?></td>
                            <td><?=$value['name']?></td>
                            <td><?=$value['email']?></td>
                            <td><?=$value['role']?></td>
                            <td><?=$value['created_at']?></td>
                            <td><?=$value['token'] ? '<p class="text-success font-weight-bold">Online</p>' : '<p class="text-secondary font-weight-bold">Offline</p>'?></td>
                            <td class="text-center"><a class="btn btn-success" href="<?=create_url('products', 'list', '&account_id='.$value['account_id'])?>">Xem</a></td>
                            <td class="text-center"><a class="btn btn-primary" href="<?=create_url('users', 'edit', '&account_id='.$value['account_id'])?>">Sửa</a></td>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php include_once('./layout/footer.php') ?>
