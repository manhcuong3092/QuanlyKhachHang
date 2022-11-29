<?php
  require_once __DIR__ . "/autoload.php";

  $sql = "SELECT * FROM khachhang ORDER BY tongchitieu DESC LIMIT 3";
  $top3 = $db->fetchsql($sql);

  $sql = "SELECT * FROM khachhang ORDER BY tongchitieu DESC LIMIT 10";
  $top10 = $db->fetchsql($sql);

  $sql = "SELECT COUNT(id) as soluongkhachhang FROM khachhang";
  $soluongkhachhang = $db->fetchsql($sql);

  $sql = "SELECT COUNT(id) as soluonglienhe FROM lienhe";
  $soluonglienhe = $db->fetchsql($sql);

  $sql = "SELECT DISTINCT diachi FROM khachhang";
  $dsdiachi = $db->fetchsql($sql);

  $sql = "SELECT SUM(tongsanpham) as tongsanpham FROM `khachhang`";
  $tongsanpham = $db->fetchsql($sql);
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Quản lý khách hàng</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel='stylesheet' type='text/css' media='screen' href='public/css/style.css'>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src='main.js'></script>
</head>
<body>
  <!-- Navbar -->
  <nav id="navbar" class="navbar navbar-expand-md fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Cuong store</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span><i class="fas fa-bars"></i></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <?php if(isset($_SESSION['user'])) :?>
          <div>Xin chào: <?php echo $_SESSION['user']['username'] ?> </div>
        <?php endif ?>
        <ul class="navbar-nav nav ms-auto">
          <li class="nav-item"><a href="#about-us">Về chúng tôi</a></li>
          <li class="nav-item"><a href="#customer">Khách hàng</a></li>
          <li class="nav-item"><a href="#statistic">Thống kê</a></li>
          <li class="nav-item"><a href="#contact">Liên hệ</a></li>
          <li class="nav-item"><a href="#branch">Chi nhánh</a></li>
          <?php if(!isset($_SESSION['user'])) :?>
            <li class="nav-item"><a href="<?php echo base_url() . 'login.php'?>">Đăng nhập</a></li>
          <?php endif ?>
          <?php if(isset($_SESSION['user'])) :?>
            <li class="nav-item"><a href="<?php echo base_url() . 'logout.php'?>">Đăng xuất</a></li>
          <?php endif ?>
          <?php if(isset($_SESSION['user'])) :?>
            <li class="nav-item"><a href="<?php echo base_url() . 'admin'?>">Trang quản tri</a></li>
          <?php endif ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Company section -->
  <div class="container-fluid company">
    <h1>Cuong Store</h1>
    <h4 class="m-3">Cửa hàng đồ gia dụng siêu chất! Cam kết luôn mang đến những mặt hàng chất lượng.</h4>
    <div class="subscribe-form m-4">
      <form class="form-inline">
        <div class="input-group">
          <input type="email" class="form-control" size="50" placeholder="Địa chỉ email" required>
          <div class="input-group-btn">
            <button type="button" class="btn btn-primary">Đăng ký</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- About us -->
  <div id="about-us">
    <div class="container">
      <div class="row">
        <div class="banner col-md-6">
          <h2>Tiêu chí cửa hàng</h2>
          <p><i class="fas fa-check"></i> Cam kết luôn mang đến những mặt hàng chất lượng</p>
          <p><i class="fas fa-check"></i> Cam kết về giá</p>
          <p><i class="fas fa-check"></i> Cam kết về dịch vụ hỗ trợ</p> 
          <p><i class="fas fa-check"></i> Cam kết vận chuyển</p>
          <p><i class="fas fa-check"></i> Có nhiều khuyến mại ưu đãi</p>
          <button class="btn btn-primary">Mua ngay <i class="fas fa-arrow-right"></i></button>
        </div>
        <div class="banner-image col-md-6">
          <div class="banner-image-container">
            <img src="public/images/Electronic.png" />
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Customer -->
  <div id="customer">
    <!-- Top 3 -->
    <div id="top3customer" class="container text-center">
      <h2>Top 3 khách hàng trong tháng</h2>
      <h4 class="mb-2">Đã mua sản phẩm của chúng tôi</h4>
      <div class="row text-center">
        <?php foreach ($top3 as $khachhang) :?>
          <div class="col-md-4">
            <div class="customer-img">
              <img src="<?php echo uploads() ?>customer/<?php echo $khachhang['avatar'] ?>" alt="">
              <h5><strong><?php echo $khachhang['ten'] ?></strong></h5>
              <p>Đã mua <?php echo $khachhang['tongsanpham'] ?> sản phẩm</p>
            </div>
          </div>
          <?php endforeach ?>
      </div>
    </div>

    <!-- Top 10 -->
    <div id="top10customer" class="text-center">
      <h2>Danh sách top 10 khách hàng thân thiết</h2>
      <h4 class="mb-4">Đã mua sản phẩm của chúng tôi từ trước đến giờ</h4>
      <div class="container">
        <div class="row">
          <?php $stt = 1; foreach ($top10 as $khachhang) :?>
            <div class="col-md-6">
              <div class="card mb-3 customer-card">
                <div class="row g-0">
                  <div class="col-md-2">
                    <img src="<?php echo uploads() ?>customer/<?php echo $khachhang['avatar'] ?>" class="img-fluid rounded-start" alt="...">
                  </div>
                  <div class="col-md-10">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $khachhang['ten'] ?> 
                        <span class="badge <?php echo $stt == 1 ? 'bg-warning' : '' ?> <?php echo $stt == 2 ? 'bg-danger' : '' ?> 
                        <?php echo $stt == 3 ? 'bg-primary' : '' ?> <?php echo $stt > 3 ? 'bg-secondary' : '' ?>">Top <?php echo $stt ?></span>
                      </h5>
                      <p class="card-text">Đã mua <?php echo $khachhang['tongsanpham'] ?> sản phẩm</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php $stt++; endforeach ?>
        </div>
      </div>
    </div>
  </div>
  

  <!-- Statistic -->
  <div id="statistic" class="container-fluid text-center">
    <h2>Thống kê</h2>
    <br>
    <div class="row">
      <div class="col-md-3">
        <i class="fas fa-users logo-small "></i>
        <h3 class="m-3"><?php echo $soluongkhachhang[0]['soluongkhachhang'] ?></h3>
        <p>Khách hàng đã mua sản phẩm</p>
      </div>
      <div class="col-md-3">
        <i class="fas fa-comment-alt logo-small "></i>
        <h3 class="m-3"><?php echo $soluonglienhe[0]['soluonglienhe'] ?> </h3>
        <p>Khách hàng phản hồi cho chúng tôi</p>
      </div>
      <div class="col-md-3">
      <i class="fas fa-globe-asia logo-small"></i>
        <h3 class="m-3"><?php echo count($dsdiachi) ?></h3>
        <p>Địa phương</p>
      </div>
      <div class="col-md-3">
        <i class="fas fa-shopping-cart logo-small "></i>
        <h3 class="m-3"><?php echo $tongsanpham[0]['tongsanpham'] ?></h3>
        <p>Sản phẩm đã được dặt mua</p>
      </div>
    </div>
  </div>

  <!-- What's customer say -->
  <div id="customersay" class="text-center container-fluid">
    <h2 class="m-4">Khách hàng nói gì về chúng tôi</h2>
    <div id="carouselCaptions" class="carousel slide container" data-bs-ride="carousel">
      <!-- indicator  -->
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="public/images/person2.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Mác Zúc Búc</h5>
            <p>Điều tôi thích nhất là sản phẩm luôn hoàn thiện và mới mẻ. Mang lại nhiều trải nghiệm tiện lợi</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="public/images/person1.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Bùi Thị Thanh</h5>
            <p>Điều tôi thích nhất là sản phẩm luôn hoàn thiện và mới mẻ. Mang lại nhiều trải nghiệm tiện lợi.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="public/images/person3.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Đỗ Nam Trung</h5>
            <p>Điều tôi thích nhất là sản phẩm luôn hoàn thiện và mới mẻ. Mang lại nhiều trải nghiệm tiện lợi.</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>

  <!-- Contact  -->
  <div id="contact" class="container-fluid">
    <div class="row mt-4">
      <div class="col-sm-2"></div>
      <div class="col-sm-8 contact-content">
        <h2 class="text-center"><b>LIÊN HỆ TƯ VẤN</b></h2>
        <h5 class="text-center">Hãy liên hệ với chúng tôi để có thêm nhiều ưu đãi</h5>
        <h5 class="text-center mb-4">hoặc để có thể biết thêm về các sản phẩm của chúng tôi</h5>
        <form action="" method="POST">
          <input class="form-control" id="name" name="name" placeholder="Họ tên" type="text" required>
          <div class="row mt-3 mb-3">
            <div class="col-sm-6 form-group">
              <input class="form-control" id="email" name="email" placeholder="Email" type="text" required>
            </div>
            <div class="col-sm-6 form-group">
              <input class="form-control" id="phone" name="phone" placeholder="Số điện thoại" type="email" required>
            </div>
          </div>
          <textarea class="form-control" id="content" name="content" placeholder="Lời nhắn" rows="5"></textarea><br>
          <div class="d-flex justify-content-center mb-5">
            <button id="postContact" class="btn btn-primary pull-right" type="button">Gửi thông tin</button>
          </div>
        </form>
      </div>
      <div class="col-sm-2"></div>
    </div>
  </div>

  <!-- branch -->
  <div id="branch" class="container text-center pt-5">
    <h2>Chi nhánh</h2>
    <br>
    <div class="row">
      <div class="col-lg-4 p-4">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d90574.58336868598!2d105.81373833842528!3d21.031202637901014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab64a56b1111%3A0x5e4784d266bc205d!2sLotte%20Mart!5e0!3m2!1svi!2s!4v1637224923895!5m2!1svi!2s" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        <h3 class="m-3">Hà Nội</h3>
        <p>Tầng B1, 1F Discovery Complex, 302 Cầu Giấy, Dịch Vọng, Cầu Giấy, Hà Nội 100000, Việt Nam</p>
      </div>
      <div class="col-lg-4 p-4">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2653.3615323233075!2d108.2303680129435!3d16.034992426704527!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219e42bd859f1%3A0x59203ba8579a98a5!2zTG90dGUgTWFydCDEkMOgIE7hurVuZw!5e0!3m2!1svi!2s!4v1637224736322!5m2!1svi!2s" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        <h3 class="m-3">Đà Nẵng</h3>
        <p>6 Nại Nam, Hoà Cường Bắc, Hải Châu, Đà Nẵng, Việt Nam</p>
      </div>
      <div class="col-lg-4 p-4">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1959.2791718435149!2d106.67125819783082!3d10.845071673159042!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529adf51a7051%3A0x5db03c96c4a02e7f!2sC%C3%B4ng%20ty%20TNHH%20NHO%20H%C3%92A!5e0!3m2!1svi!2s!4v1637224626764!5m2!1svi!2s" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        <h3 class="m-3">Thành phố HCM</h3>
        <p>487 Lê Đức Thọ, Phường 16, Gò Vấp, Thành phố Hồ Chí Minh 700000, Việt Nam</p>
      </div>
    </div>
  </div>

  <div class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <h3 class="my-4"><b>Cuong store</b></h3>
          <p>Cung cấp sản phẩm tốt nhất</p>
          <p class="mb-4">Ngon bổ rẻ</p>
          <p class="pt-4"><i class="far fa-copyright"></i> 2021 Designed by Cuong</p>
          <div class="d-flex">
            <button class="btn btn-primary m-1"><i class="fab fa-facebook-f"></i></button>
            <button class="btn btn-primary m-1"><i class="fab fa-google"></i></button>
            <button class="btn btn-primary m-1"><i class="fab fa-twitter"></i></button>
          </div>
        </div>
        <div class="col-md-2">
          <h5 class="mt-4"><b>Liên kết</b></h5>
          <ul class="list-unstyled">
            <li><a class="text-decoration-none" href="#">Trang chủ</a></li>
            <li><a class="text-decoration-none" href="#customer">Khách hàng</a></li>
            <li><a class="text-decoration-none" href="#statistic">Thống kê</a></li>
          </ul>
        </div>
        <div class="col-md-2">
          <h5 class="mt-4"><b>Công ty</b></h5>
          <ul class="list-unstyled">
            <li><a class="text-decoration-none" href="#about-us">Về chúng tôi</a></li>
            <li><a class="text-decoration-none" href="#brand">Chi nhánh</a></li>
            <li><a class="text-decoration-none" href="#contact">Liên hệ</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h5 class="mt-4"><b>Liên hệ</b></h5>
          <ul class="list-unstyled">
            <li><a class="text-decoration-none" href="#customer">Địa chỉ: Tầng B1, 1F Discovery Complex, 302 Cầu Giấy, Dịch Vọng, Cầu Giấy, Hà Nội 100000, Việt Nam</a></li>
            <li class="py-2"><a class="text-decoration-none" href="#customer"><i class="fas fa-envelope"></i> Cuongdm3092@gmail.com</a></li>
            <li class="py-2"><a class="text-decoration-none" href="#customer"><i class="fas fa-phone"></i> +84 012 456 789</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <script>
    $('#postContact').click(function() {
      var ten = $('#name').val();
      var email = $('#email').val();
      var sdt = $('#phone').val();
      var loinhan = $('#content').val();
      if(!(ten && email && sdt && loinhan)) {
        alert('Vui lòng nhập đủ thông tin');
        return;
      } 
      var data = {
        ten,
        email,
        sdt,
        loinhan
      }

      $.ajax({
        url: 'contact.php',
        type: 'POST',
        data: {
          'data': JSON.stringify(data)
        },
        dataType: 'json',
        success: function(data) {
          alert(data);
          ten = $('#name').val('');
          email = $('#email').val('');
          sdt = $('#phone').val('');
          loinhan = $('#content').val('');
        },
        error: function(log) {
          alert('Có lỗi xảy ra');
          // console.log(log);
        }
      })
    })
  </script>
</body>
</html>
