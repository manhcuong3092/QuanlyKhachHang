<?php
  $open = "khachhang";
  require_once __DIR__ . "/../../autoload/autoload.php";

  $id = intval(getInput('id'));
  
  // __debug($id);
  $khachhang = $db->fetchID("khachhang", $id);
  
  if(empty($khachhang)) {
    $_SESSION['error'] = 'Dữ liệu không tồn tại';
    redirectAdmin('khachhang');
  }

  $num = $db->delete("khachhang", $id);
  if($num > 0) {
    $_SESSION['success'] = ' Xóa thành công ';
    redirectAdmin("khachhang");
  } else {
    $_SESSION['error'] = ' Xóa thất bại, dữ liệu không thay đổi ';
  }
?>
