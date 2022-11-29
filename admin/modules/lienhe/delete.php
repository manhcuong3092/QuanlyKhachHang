<?php
  require_once __DIR__ . "/../../autoload/autoload.php";

  $id = intval(getInput('id'));
  
  // __debug($id);
  $lienhe = $db->fetchID("lienhe", $id);
  
  if(empty($lienhe)) {
    $_SESSION['error'] = 'Dữ liệu không tồn tại';
    redirectAdmin('lienhe');
  }

  $num = $db->delete("lienhe", $id);
  if($num > 0) {
    $_SESSION['success'] = ' Xóa thành công ';
    redirectAdmin("lienhe");
  } else {
    $_SESSION['error'] = ' Xóa thất bại, dữ liệu không thay đổi ';
  }
?>
