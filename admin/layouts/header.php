<?php require_once __DIR__ . "/../autoload/autoload.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Bảng điều khiển</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
  <link href="<?php echo base_url() ?>public/css/style.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo base_url() . 'admin'?>" style="color: white;">Admin</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
        <div class="input-group-append">
          <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo base_url() . 'logout.php'?>">Logout</a>
        </div>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link <?php echo isset($open) && $open == 'dashboard' ? 'active' : '' ?>" href="<?php echo base_url() . 'admin'?>">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Bảng điều khiển
            </a>
            <div class="sb-sidenav-menu-heading">Quản lý</div>
            <a class="nav-link collapsed <?php echo isset($open) && $open == 'khachhang' ? 'active' : '' ?>" href="#" data-toggle="collapse" data-target="#collapseCustomers" aria-expanded="false" aria-controls="collapseLayouts">
              <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
              Khách hàng
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseCustomers" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="<?php echo modules("khachhang")?>">Danh sách</a>
                <a class="nav-link" href="<?php echo modules("khachhang/add.php")?>">Thêm khách hàng</a>
              </nav>
            </div>
            <a class="nav-link <?php echo isset($open) && $open == 'lienhe' ? 'active' : '' ?>" href="<?php echo modules("lienhe")?>">
              <div class="sb-nav-link-icon"><i class="fas fa-inbox"></i></div>
              Liên hệ
            </a>
            <a class="nav-link collapsed <?php echo isset($open) && $open == 'thongke' ? 'active' : '' ?>" href="#" data-toggle="collapse" data-target="#collapseStatistics" aria-expanded="false" aria-controls="collapseLayouts">
              <div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
              Thống kê
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseStatistics" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="<?php echo modules("thongke/top10.php")?>">Top 10 khách hàng</a>
                <a class="nav-link" href="<?php echo modules("thongke/dskhTheoTinh.php")?>">Thống kê khách hàng theo địa phương</a>
              </nav>
            </div>
            
          </div>
        </div>
        <div class="sb-sidenav-footer">
          <div class="small">Tài khoản:</div>
          <?php echo $_SESSION['user']['username'] ?>
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid">