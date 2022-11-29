<?php
  $open = "thongke";
  require_once __DIR__. "/../../autoload/autoload.php";

  $sql = "SELECT diachi, COUNT(id) as soluong FROM khachhang GROUP BY diachi ORDER BY soluong DESC";

  $dsketqua = $db->fetchsql($sql);

  $sql = "SELECT gioitinh, COUNT(id) as soluong FROM khachhang GROUP BY gioitinh ORDER BY gioitinh DESC";

  $dsgioitinh = $db->fetchsql($sql);

?>


<?php require_once __DIR__ . "/../../layouts/header.php"; ?>
  <h1 class="mt-4">Thống kê</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin'?>">Dashboard</a></li>
    <li class="breadcrumb-item active">Thống kê địa phương</li>
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
              <th>Địa phương</th>
              <th>Số lượng khách hàng</th>
            </tr>
          </thead>
          <tbody>
            <?php $stt = 1; foreach ($dsketqua as $ketqua) :?>
              <tr>
                <td><?php echo $stt ?></td>
                <td><?php echo $ketqua['diachi'] ?></td>
                <td><?php echo $ketqua['soluong'] ?></td>
              </tr>
            <?php $stt++; endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar mr-1"></i>
                Thống kê địa phương
            </div>
            <div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>
            <div class="card-footer small text-muted">Cập nhật lúc 11:59 PM</div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-pie mr-1"></i>
                Thống kê giới tinh
            </div>
            <div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
            <div class="card-footer small text-muted">Cập nhật lúc 11:59 PM</div>
        </div>
    </div>
</div>
</main>
<?php require_once __DIR__ . "/../../layouts/footer.php"; ?>
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    var ctx = document.getElementById("myPieChart");
      var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: [<?php $i = 0; foreach ($dsgioitinh as $gioitinh) { echo $i != 0 ? ', "' . $gioitinh['gioitinh'] . '"' : '"'. $gioitinh['gioitinh'] . '"'; $i++; } ?>],
          datasets: [{
            data: [<?php foreach ($dsgioitinh as $gioitinh) echo $gioitinh['soluong'] . ', ' ?>],
            backgroundColor: ['#dc3545', '#007bff'],
          }],
        },
    });          

    
    
    // Bar Chart Example
    var ctx = document.getElementById("myBarChart");
    var myLineChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [<?php $i = 0; foreach ($dsketqua as $ketqua) { echo $i != 0 ? ', "' . $ketqua['diachi'] . '"' : '"'. $ketqua['diachi'] . '"'; $i++; } ?>],
        datasets: [{
          label: "Số lượng",
          backgroundColor: "rgba(2,117,216,1)",
          borderColor: "rgba(2,117,216,1)",
          data: [<?php foreach ($dsketqua as $ketqua) echo $ketqua['soluong'] . ', ' ?>],
        }],
      },
      options: {
        scales: {
          xAxes: [{
            time: {
              unit: 'tên'
            },
            gridLines: {
              display: false
            },
            ticks: {
              maxTicksLimit: 6
            }
          }],
          yAxes: [{
            ticks: {
              min: 0,
              max: 15,
              maxTicksLimit: 5
            },
            gridLines: {
              display: true
            }
          }],
        },
        legend: {
          display: false
        }
      }
    });
  </script>