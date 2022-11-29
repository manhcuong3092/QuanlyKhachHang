<?php
  $open = "thongke";
  require_once __DIR__. "/../../autoload/autoload.php";

  $sql = "SELECT * FROM khachhang ORDER BY tongchitieu DESC LIMIT 10";

  $dskhachhang = $db->fetchsql($sql);
  // var_dump($dskhachhang);

?>


<?php require_once __DIR__ . "/../../layouts/header.php"; ?>
  <h1 class="mt-4">Thống kê</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin'?>">Dashboard</a></li>
    <li class="breadcrumb-item active">Thống kê top 10</li>
  </ol>
  <!-- Thong bao -->
  <div class="clear-fix">
    <?php require_once __DIR__ . '/../../../libraries/Notification.php' ?>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="table-responsive">
        <table class="table table-bordered" id="" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>STT</th>
              <th>Họ tên</th>
              <th>Địa chỉ</th>
              <th>Tổng chi tiêu</th>
              <th>Tổng sản phẩm</th>
            </tr>
          </thead>
          <tbody>
            <?php $stt = 1; foreach ($dskhachhang as $khachhang) :?>
              <tr>
                <td><?php echo $stt ?></td>
                <td><?php echo $khachhang['ten'] ?></td>
                <td><?php echo $khachhang['diachi'] ?></td>
                <td><?php echo $khachhang['tongchitieu'] ?></td>
                <td><?php echo $khachhang['tongsanpham'] ?></td>
              </tr>
            <?php $stt++; endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
      <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#">Next</a>
      </li>
    </ul>
  </nav>
</div>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        Xóa khách hàng
      </div>
      <div class="modal-body">
        Bạn có chắc muốn xóa khách hàng này chứ
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
        <a class="btn btn-danger btn-ok" style="color: white;">Xóa</a>
      </div>
    </div>
  </div>
</div>
</main>
<script>
  $('#confirm-delete').on('show.bs.modal', function(e) {
      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  });
</script>
</main>
<?php require_once __DIR__ . "/../../layouts/footer.php"; ?>