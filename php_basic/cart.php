<?php
    session_start();
    $carts = [];
    if(isset($_SESSION['carts'])){
        $carts = $_SESSION['carts'];
    }
    if(isset($_GET['unset'])){
        unset($_SESSION['carts']);
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>CART</title>
</head>
<body class="bg-light">
    <div class="container fixed-top">
        <nav class="navbar navbar-light bg-light d-block">
            <a class="navbar-brand btn btn-outline-success" href="index.php">
                <img src="https://png.pngtree.com/png-clipart/20190604/original/pngtree-business-logo-design-png-image_915991.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
                <span>Trang Chủ</span>
            </a>
        </nav>
    </div>
    <section class="h-100 bg-light">
    <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-10">

                <div class="d-block text-center mb-4 mt-4">
                    <div class="alert alert-success text-center" role="alert">
                        <?php echo ($carts) ? "Giỏ hàng của bạn" : "Giỏ hàng trống !" ?>
                    </div>
                </div>
        <?php
            foreach ($carts as $key => $value) {
        ?>
                <div class="card rounded-3 mb-4">
                    <div class="card-body p-4">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <img
                                src="<?=$value['img']?>"
                                class="img-fluid rounded-3" alt="product">
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3">
                                <p class="lead fw-normal mb-2"><?=$value['name']?></p>
                                <p><span class="text-muted">ID: </span><?=$value['id']?> <span class="text-muted">Date: </span><?=$value['date']?></p>
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">

                                <input id="form1" min="0" readOnly name="quantity" value="<?=$value['number']?>" type="number"
                                class="form-control form-control-sm" />
                            </div>
                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                <a href="#!" class="text-secondary text-decoration-none" onClick="More();">Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>
        <?php } ?>
                <div class="card">
                    <div class="card-body">
                        <a type="button" class="btn btn-secondary float-start btn-block btn-lg" onClick="More();">Thanh Toán</a>
                        <a href="?unset" type="button" class="btn btn-danger float-end btn-block btn-lg">Xóa giỏ hàng</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </section> 
</body>
<script>
    function More(){
        alert("SẼ PHÁT TRIỂN THÊM NẾU ĐƯỢC YÊU CẦU !!");
    }
</script>
</html>