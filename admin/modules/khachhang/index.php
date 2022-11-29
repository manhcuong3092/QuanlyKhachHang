<?php
  $open = "khachhang";
  require_once __DIR__ . "/../../autoload/autoload.php";

  $dskhachhang = $db->fetchAll("khachhang");
  // var_dump($dskhachhang);

?>


<?php require_once __DIR__ . "/../../layouts/header.php"; ?>
  <h1 class="mt-4">Khách hàng</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin'?>">Dashboard</a></li>
    <li class="breadcrumb-item active">Khách hàng</li>
  </ol>
  <!-- Thong bao -->
  <div class="clear-fix">
    <?php require_once __DIR__ . '/../../../libraries/Notification.php' ?>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <a class="btn btn-success mb-3" href="add.php">Thêm mới</a>
      <div class="table-responsive">
        <table class="table table-bordered" id="" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>STT</th>
              <th>Họ tên</th>
              <th>Ảnh đại diện</th>
              <th>Email</th>
              <th>Sđt</th>
              <th>Địa chỉ</th>
              <th>Giới tính</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            <?php $stt = 1; foreach ($dskhachhang as $khachhang) :?>
              <tr>
                <td><?php echo $stt ?></td>
                <td><?php echo $khachhang['ten'] ?></td>
                <td>
                  <img src="<?php echo uploads() ?>customer/<?php echo $khachhang['avatar'] ?>" 
                    width="90px" height="80px" styte="object-fit: cover;" /> 
                </td>
                <td><?php echo $khachhang['email'] ?></td>
                <td><?php echo $khachhang['sdt'] ?></td>
                <td><?php echo $khachhang['diachi'] ?></td>
                <td><?php echo $khachhang['gioitinh'] ?></td>
                <td>
                  <a class="btn btn-sm btn-info" href="edit.php?id=<?php echo $khachhang['id']
                   ?>">Sửa <i class="fa fa-edit"></i></a> 
                  <a class="btn btn-sm btn-danger" data-href="delete.php?id=<?php echo $khachhang['id']
                   ?>" style="color: white;" data-toggle="modal" data-target="#confirm-delete">Xóa <i class="fa fa-times"></i></a>
                </td>
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