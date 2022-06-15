<?php
    if(!empty($_POST)) {
        $id = $name = $email = $role = '';
        if(isset($_POST['account_id'])){
            $id = $_POST['account_id'];
        }

        if(isset($_POST['name'])) {
            $name = $_POST['name'];
            $name = str_replace('"', '\\"', $name);
        }

        if(isset($_POST['email'])){
            $email = $_POST['email'];
            $email = str_replace('"', '\\"', $email);

        }

        if(isset($_POST['role'])){
            $role = $_POST['role'];
            $role = str_replace('"', '\\"', $role);

        }

        $sql = 'select email from accounts where account_id != '.$id;
        $result = db_get_list($sql);
        foreach ($result as $item)
        {
            if($item['email'] == $email)
            {
                setcookie('success', 'Email đã tồn tại', time() + 1, '/');
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }

        if($id){
            $sql = 'update accounts set name 		 = "'.$name.'",
                                        email 		 = "'.$email.'",
                                        role 	 	 = "'.$role.'"
                                    where account_id = "'.$id.'"';
        }
        db_execute($sql);
        setcookie('success', 'Đã chỉnh sửa thông tin user', time() + 1, '/');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
?>