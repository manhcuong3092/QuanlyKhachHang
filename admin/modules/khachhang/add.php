<?php
  $open = "khachhang";
  require_once __DIR__ . "/../../autoload/autoload.php";

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

    if(!isset($_FILES['avatar'])) {
      $error['avatar'] = 'Hãy tải ảnh đại diện lên';
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
        }

      }

      $id_insert = $db->insert('khachhang', $data);
      
      // print_r($id_insert);
      if($id_insert > 0) {
        move_uploaded_file($file_tmp, $path.$file_name);
        $_SESSION['success'] = ' Thêm mới thành công ';
        redirectAdmin("khachhang");
      } else {
        $_SESSION['error'] = ' Thêm mới thất bại ';
      }
    }
  }
?>

<?php require_once __DIR__ . "/../../layouts/header.php"; ?>
  <h1 class="mt-4">Thêm mới khách hàng</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin'?>">Dashboard</a></li>
    <li class="breadcrumb-item active">Khách hàng</li>
    <li class="breadcrumb-item active">Thêm mới</li>
  </ol>

  <div class="row">
    <div class="col-md-12">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="name">Họ tên</label>
          <input type="text" class="form-control" id="name" name="ten" aria-describedby="emailHelp" placeholder="Nhập tên">
          <?php if(isset($error['ten'])): ?>
            <small id="emailHelp" class="form-text text-danger">
              <?php echo $error['ten']; ?>
            </small>
          <?php endif ?>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Nhập email">
          <?php if(isset($error['email'])): ?>
            <small id="emailHelp" class="form-text text-danger">
              <?php echo $error['email']; ?>
            </small>
          <?php endif ?>
        </div>
        <div class="form-group">
          <label for="tel">Số điện thoại</label>
          <input type="tel" class="form-control" name="sdt" id="tel" placeholder="">
          <?php if(isset($error['sdt'])): ?>
            <small id="emailHelp" class="form-text text-danger">
              <?php echo $error['sdt']; ?>
            </small>
          <?php endif ?>
        </div>
        <div class="form-group">
          <label for="address">Địa chỉ</label>
          <input type="text" class="form-control" name="diachi" id="address" placeholder="">
          <?php if(isset($error['diachi'])): ?>
            <small id="emailHelp" class="form-text text-danger">
              <?php echo $error['diachi']; ?>
            </small>
          <?php endif ?>
        </div>
        <div class="form-group">
          <label for="gender">Giới tính</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gioitinh" id="exampleRadios1" value="nam" checked>
            <label class="form-check-label" for="exampleRadios1">
              Nam
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gioitinh" id="exampleRadios2" value="nữ">
            <label class="form-check-label" for="exampleRadios2">
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