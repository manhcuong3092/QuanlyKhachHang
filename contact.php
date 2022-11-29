<?php
  require_once __DIR__ . "/autoload.php";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //$ten = postInput("ten"); // isset($_POST['fullname']) ? $_POST['fullname'] : '';
    $data = json_decode($_POST['data'], true);
    if(isset($data)) {
      $result = $db->insert('lienhe', $data);
      echo json_encode("Lời nhắn của bạn đã được ghi nhận");
    } else {
      die(header("HTTP/1.0 400 Bad Request"));
    }
  }
?>