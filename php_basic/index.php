<?php
    session_start();
    $cart = [];
    // Total hien thi so luong sp tren cart
    $total = 0;
    if(!empty($_SESSION['carts'])){

        $cart = $_SESSION['carts'];
        foreach ($cart as $key => $value) {
            $total += $value['number'];
        }
    }
    $a = array(
        array('id' => '1', 'name' => 'Tai nghe có dây', 'quantity' => '11', 'date' => '03-06-2021', 'img' => 'https://tainghe.com.vn/media/product/3229_1.png'),
        array('id' => '2', 'name' => 'Tai nghe không dây', 'quantity' => '20', 'date' => '04-03-2022', 'img' => 'https://tainghe.com.vn/media/product/3967____________05.jpg'),
        array('id' => '3', 'name' => 'Dây thay thế', 'quantity' => '14', 'date' => '08-06-2021', 'img' => 'https://tainghe.com.vn/media/product/4376_tripowin_altea_cable_xuan_vu_5.jpg'),
        array('id' => '4', 'name' => 'Spinfit Tip', 'quantity' => '21', 'date' => '09-03-2018', 'img' => 'https://tainghe.com.vn/media/product/4452_eartip_spinfit_cp220_m2_xuan_vu_1_min.jpg'),
        array('id' => '5', 'name' => 'DAC/AMP', 'quantity' => '7', 'date' => '20-02-2020', 'img' => 'https://tainghe.com.vn/media/product/3206_ibasso_dc03_type_c_to_35mm_portable_headphone_amplifier_amp_hifigo_207653_695x695.png'),
        array('id' => '6', 'name' => 'Máy nghe nhạc', 'quantity' => '11', 'date' => '05-11-2019', 'img' => 'https://tainghe.com.vn/media/product/2547_r3_pro.jpg'),
        array('id' => '7', 'name' => 'Jack cắm tai nghe', 'quantity' => '28', 'date' => '10-01-2017', 'img' => 'https://tainghe.com.vn/media/product/2604_dd_dj35a_dj44a_25_44_balanced_adapter_for_astellkern_fiio_etc_hifigo_230760_695x695.jpg'),
        array('id' => '8', 'name' => 'Loa', 'quantity' => '9', 'date' => '06-06-2017', 'img' => 'https://tainghe.com.vn/media/product/2631_loa_jbl_pulse_4_1.jpg')
    );
    
    if(isset($_GET['id'])){

        $id = $_GET['id'];
        $carts = [];
        if(isset($_SESSION['carts'])) {
            $carts = $_SESSION['carts'];
        }
        
        // $isFind xac dinh co tim thay sp hay khong
        $isFind = false;
        if($carts){

            //Neu tim thay san pham trong cart thi tang number len 1
            $countCarts = count($carts);
            for ($i=0; $i < $countCarts; $i++) {
                if($carts[$i]['id'] == $id) {
                    $carts[$i]['number']++;
                    $isFind = true;
                    break;
                }
            }
        }
        // Truong hop khong tim thay sp hoac carts rong thi them moi sp vao carts
        if(!$isFind) {

            $countArr = count($a);
            for ($i=0; $i < $countArr ; $i++) {
                if($a[$i]['id'] == $id){
                    $product = $a[$i];
                    break;
                }
            }
            $product['number'] = 1;
            $carts[] = $product;
        }
        // Update lai SESSION
        $_SESSION['carts'] = $carts;
        // Delete id tren url, tranh truong hop reload se them moi vao gio hang
        header("Refresh:0; url=index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>PHP</title>
</head>
<body class="bg-light">
    <div class="container fixed-top">
        <nav class="navbar navbar-light bg-light d-block">
            <a class="navbar-brand btn btn-outline-success" href="#">
                <img src="https://png.pngtree.com/png-clipart/20190604/original/pngtree-business-logo-design-png-image_915991.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
                <span>Tran Quang Linh</span>
            </a>
            <a href="cart.php" class="btn btn-outline-success my-2 my-sm-0 float-end m-2">Giỏ Hàng <p class="text text-danger h3"><?=$total?></p></a>
        </nav>
    </div>
    <div class="container py-5 mt-5">
        <div class="row">
            <?php
                foreach ($a as $key => $value) {
            ?>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="<?=$value['img']?>" alt="Card image cap">
                        <div class="card-body">
                            <h7 class="card-title">ID: <?=$value['id']?></h7>
                            <h4 class="card-title text-success"><?=$value['name']?></h4>
                            <p class="card-text">Quantity: <?=$value['quantity']?></p>
                            <p class="card-text"><i>Date: <?=$value['date']?></i></p>
                            <a href="?id=<?=$value['id']?>" class="btn btn-success w-100">Mua</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>