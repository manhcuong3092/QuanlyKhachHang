<?php
  $open = "lienhe";
  require_once __DIR__ . "/../../autoload/autoload.php";

  $dslienhe = $db->fetchAll("lienhe");
  // var_dump($dskhachhang);

?>


<?php require_once __DIR__ . "/../../layouts/header.php"; ?>
  <h1 class="mt-4">Liên hệ</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin'?>">Dashboard</a></li>
    <li class="breadcrumb-item active">Liên hệ</li>
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
              <th>Email</th>
              <th>Số điện thoại</th>
              <th>Nội dung</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            <?php $stt = 1; foreach ($dslienhe as $lienhe) :?>
              <tr>
                <td><?php echo $stt ?></td>
                <td><?php echo $lienhe['ten'] ?></td>
                <td><?php echo $lienhe['email'] ?></td>
                <td><?php echo $lienhe['sdt'] ?></td>
                <td><?php echo $lienhe['loinhan'] ?></td>
                <td>
                  <a class="btn btn-sm btn-danger" data-href="delete.php?id=<?php echo $lienhe['id']
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
        Xóa liên hệ
      </div>
      <div class="modal-body">
        Bạn có chắc muốn xóa lời nhắn này chứ
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
<?php require_once __DIR__ . "/../../layouts/footer.php"; ?>