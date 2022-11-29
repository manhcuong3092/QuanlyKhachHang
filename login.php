<?php
  require_once __DIR__ . "/autoload.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = postInput('username');
    $password = postInput('password');

    $error = [];

    if($username == '') {
      $error['username'] = 'Hãy nhập tên tài khoản';
    }
    if($password == '') {
      $error['password'] = 'Hãy nhập mật khẩu';
    }

    $password = htmlspecialchars($password);

    $query = "username='${username}' AND password='${password}'";
    $user = $db->fetchOne('user', $query);
    if($user) {
      session_start();
      $_SESSION['user'] = $user;
      header("location: " . base_url());
    } else {
      $error['password'] = 'Sai tài khoản hoặc mật khẩu';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Page Title - SB Admin</title>
  <!-- <link href="<?php echo base_url() ?>public/css/style.css" rel="stylesheet" /> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body style="background-color: rgb(128, 252, 241);">
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container">
          <!-- Thong bao -->
          <div class="clear-fix">
            <?php require_once __DIR__ . '/libraries/Notification.php' ?>
          </div>
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                  <h3 class="text-center font-weight-light my-4">Đăng nhập</h3>
                </div>
                <div class="card-body">
                  <form action="" method="POST">
                    <div class="form-group">
                      <label class="small mb-1" for="inputEmailAddress">Tài khoản</label>
                      <input name="username" class="form-control py-4" id="inputEmailAddress" type="text" placeholder="Nhập tên tài khoản" />
                      <?php if(isset($error['username'])): ?>
                        <small id="" class="form-text text-danger">
                          <?php echo $error['username']; ?>
                        </small>
                      <?php endif ?>
                    </div>
                    <div class="form-group">
                      <label class="small mb-1" for="inputPassword">Mật khẩu</label>
                      <input name="password" class="form-control py-4" id="inputPassword" type="password" placeholder="Nhập mật khẩu" />
                      <?php if(isset($error['password'])): ?>
                        <small id="" class="form-text text-danger">
                          <?php echo $error['password']; ?>
                        </small>
                      <?php endif ?>
                    </div>
                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                      <a class="small" href="password.html">Quên mật khẩu?</a>
                      <button class="btn btn-primary">Đăng nhập</a>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center">
                  <div class="small"><a href="register.html">Đăng ký</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
    <footer class="py-4 bg-light mt-auto" style="margin-top: 182px !important;">
      <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
          <div class="text-muted">Copyright &copy; Cuong 2021</div>
      </div>
    </footer>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="<?php echo base_url() ?>public/js/scripts.js"></script>
</body>

</html>