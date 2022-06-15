  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=create_url('products', 'list')?>" class="brand-link">
      <img src="./public/template/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Trang quản trị</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./public/image/user_icon/246377710_566793411217195_3812271172031304993_n.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <p style="cursor: default;" class="d-block text-light"><?=$user['name'].' - '.$user['role']?></p>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-headphones"></i>
              <p>
                Sản phẩm
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=create_url('products', 'add_edit')?>" class="nav-link">
                  <i class="fa fa-angle-right nav-icon"></i>
                  <p>Thêm sản phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= create_url('products', 'list') ?>" class="nav-link">
                  <i class="fa fa-angle-right nav-icon"></i>
                  <p>Danh sách sản phẩm</p>
                </a>
              </li>
            </ul>
          </li>
          <?php if($user['role'] == 'admin') { ?>
            <li class="nav-item">
              <a href="<?=create_url('users', 'list')?>" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>
                  Danh sách User
                  <i class="fa fa-bars right"></i>
                </p>
              </a>
            </li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </aside>