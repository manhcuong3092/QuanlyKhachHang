<?php
  require_once __DIR__."/autoload/autoload.php";
  $open = "dashboard";

  $sql = "SELECT COUNT(id) as soluongkhachhang FROM khachhang";
  $soluongkhachhang = $db->fetchsql($sql);

  $sql = "SELECT COUNT(id) as soluonglienhe FROM lienhe";
  $soluonglienhe = $db->fetchsql($sql);

  $sql = "SELECT DISTINCT diachi FROM khachhang";
  $dsdiachi = $db->fetchsql($sql);

  $sql = "SELECT SUM(tongsanpham) as tongsanpham FROM `khachhang`";
  $tongsanpham = $db->fetchsql($sql);
?>

<?php require_once __DIR__."/layouts/header.php"; ?>
          <h1 class="mt-4">Bảng điều khiển</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
          <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                  <?php echo $soluongkhachhang[0]['soluongkhachhang'] ?> khách hàng
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="<?php echo modules("khachhang")?>">Xem chi tiết</a>
                  <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                  <?php echo $soluonglienhe[0]['soluonglienhe'] ?> liên hệ
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo modules("lienhe")?>">Xem chi tiết</a>
                  <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-success text-white mb-4">
                <div class="card-body">
                  <?php echo count($dsdiachi) ?> địa phương
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo modules("thongke/dskhTheoTinh.php")?>">Xem chi tiết</a>
                  <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                  <?php echo $tongsanpham[0]['tongsanpham'] ?> sản phẩm được bán
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="#">Xem chi tiết</a>
                  <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
              </div>
            </div>
          </div>

          <div>

          </div>
        </div>
      </main>
<?php require_once __DIR__."/layouts/footer.php"; ?>