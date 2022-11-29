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

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //$ten = postInput("ten"); // isset($_POST['fullname']) ? $_POST['fullname'] : '';
    $data = [
      "ten" => postInput("ten"),
      "email" => postInput("email"),
      "sdt" => postInput("sdt"),
      "diachi" => postInput("diachi"),
      "gioitinh" => postInput("gioitinh")
    ];

    $error = [];

    foreach($data as $field => $value){
      if($value == '') {
        $error[$field] = 'Hãy nhập đầy đủ trường này';
      }
    }

    if(empty($error)) {
      if(isset($_FILES['avatar'])) {
        $file_name = $_FILES['avatar']['name'];
        $file_tmp = $_FILES['avatar']['tmp_name'];
        $file_type = $_FILES['avatar']['type'];
        $file_error = $_FILES['avatar']['error'];

        if($file_error == 0) {
          $path = ROOT . "customer/";
          $data['avatar'] = $file_name;
          move_uploaded_file($file_tmp, $path.$file_name);
        }

      }

      $id_update = $db->update('khachhang', $data, array('id' => $id));
      // print_r($id_insert);
      if($id_update) {
        $_SESSION['success'] = ' Cập nhật thành công ';
        redirectAdmin("khachhang");
      } else {
        $_SESSION['error'] = ' Cập nhật thất bại, dữ liệu không thay đổi ';
        redirectAdmin("khachhang");
      }
    }
  }
?>

<?php require_once __DIR__ . "/../../layouts/header.php"; ?>
  <h1 class="mt-4">Sửa khách hàng</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin'?>">Dashboard</a></li>
    <li class="breadcrumb-item active">Khách hàng</li>
    <li class="breadcrumb-item active">Sửa</li>
  </ol>

  <div class="row">
    <div class="col-md-12">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="name">Họ tên</label>
          <input type="text" class="form-control" id="name" name="ten" aria-describedby="emailHelp" placeholder="Nhập tên"
            value="<?php echo $khachhang['ten'] ?>">
          <?php if(isset($error['ten'])): ?>
            <small id="emailHelp" class="form-text text-danger">
              <?php echo $error['ten']; ?>
            </small>
          <?php endif ?>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Nhập email"
            value="<?php echo $khachhang['email'] ?>">
          <?php if(isset($error['email'])): ?>
            <small id="emailHelp" class="form-text text-danger">
              <?php echo $error['email']; ?>
            </small>
          <?php endif ?>
        </div>
        <div class="form-group">
          <label for="tel">Số điện thoại</label>
          <input type="tel" class="form-control" name="sdt" id="tel" placeholder="Nhập sđt"
            value="<?php echo $khachhang['sdt'] ?>">
          <?php if(isset($error['sdt'])): ?>
            <small id="emailHelp" class="form-text text-danger">
              <?php echo $error['sdt']; ?>
            </small>
          <?php endif ?>
        </div>
        <div class="form-group">
          <label for="address">Địa chỉ</label>
          <input type="text" class="form-control" name="diachi" id="address" placeholder="Nhập địa chỉ"
            value="<?php echo $khachhang['diachi'] ?>">
          <?php if(isset($error['diachi'])): ?>
            <small id="emailHelp" class="form-text text-danger">
              <?php echo $error['diachi']; ?>
            </small>
          <?php endif ?>
        </div>
        <div class="form-group">
          <label for="gender">Giới tính</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gioitinh" id="" value="nam" 
              <?php if ($khachhang['gioitinh']=="nam") echo "checked";?>>
            <label class="form-check-label" for="">
              Nam
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gioitinh" id="" value="nữ"
              <?php if ($khachhang['gioitinh']=="nữ") echo "checked";?>>
            <label class="form-check-label" for="">
              Nữ
            </label>
          </div>
          <?php if(isset($error['gioitinh'])): ?>
            <small id="emailHelp" class="form-text text-danger">
              <?php echo $error['gioitinh']; ?>
            </small>
          <?php endif ?>
        </div>
        <div class="form-group">
          <label for="avatar">Ảnh đại diện</label>
          <?php if($khachhang['avatar'] != '' || $khachhang['avatar'] != null) :?>
            <img src="<?php echo uploads() ?>customer/<?php echo $khachhang['avatar'] ?>" 
              width="200px" height="200px"/>
          <?php endif ?>
          <input type="file" class="form-control" name="avatar" id="avatar">
          <?php if(isset($error['avatar'])): ?>
            <small id="emailHelp" class="form-text text-danger">
              <?php echo $error['avatar']; ?>
            </small>
          <?php endif ?>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
      </form>
    </div>
  </div>
</div>
</main>
<?php require_once __DIR__ . "/../../layouts/footer.php"; ?>