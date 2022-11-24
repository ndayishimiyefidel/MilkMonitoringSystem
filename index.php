<?php
session_start();
error_reporting(1);
//Local connection
$host = 'localhost';
$dbuser = 'root';
$dbpassword = '';
$dbname = 'milkmonitoring';
$db = mysqli_connect($host, $dbuser, $dbpassword) or
        die('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, $dbname) or die(mysqli_error($db));
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Milk Monitoring System</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    canvas {
      max-width: 200px;
    }
  </style>
</head>
<?php
 ?>

<body>

  <h1 class="text-succes text-center">Milk Monitoring System </h1>
  <div class="row m-4 p-4">
    <div class="col-md-4">
      <canvas id="myChart" width="20" height="20"></canvas>
    </div>
    <div class="col-md-4">
      <canvas id="myChart1" width="20" height="20"></canvas>
    </div>
    <div class="col-md-4">
      <canvas id="myChart2" width="20" height="20"></canvas>
    </div>
  </div>
  <?php
  
     $sql ="SELECT * FROM milkcontent";

      $result = mysqli_query($db,$sql);
      $chart_data="";
      while ($row = mysqli_fetch_array($result)) { 

         $ph_level[]  = $row['Ph_level']  ;
         $temp_level[] = $row['Temperature_level'];
         $conduct_level[]=$row['Conductivity_level'];
         $time[]=$row['createtime'];
        //  echo $row['Ph_level'];
     }
  
  ?>







  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
  <script type="text/javascript">
    var ctx = document.getElementById("myChart").getContext('2d');
    var dataValues = [12, 19, 3, 5];
    var dataLabels = [1, 2, 3, 4];
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($time); ?>,
        datasets: [{
          label: 'Ph Level',
          data: <?php echo json_encode($ph_level); ?>,
          backgroundColor: 'rgba(255, 99, 0, 1)',
        }]
      },
      options: {
        scales: {
          xAxes: [{
            display: false,
            barPercentage: 1.3,
            ticks: {
              max: 10,
            }
          }, {
            display: true,
            ticks: {
              autoSkip: false,
              max: 10,
            }
          }],
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
  </script>
  <script type="text/javascript">
    var ctx = document.getElementById("myChart2").getContext('2d');
    var dataValues = [12, 19, 3, 5];
    var dataLabels = [1, 2, 3, 4];
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($time); ?>,
        datasets: [{
          label: 'Temperature Level',
          data: <?php echo json_encode($temp_level); ?>,
          backgroundColor: 'rgba(0, 99, 132, 1)',
        }]
      },
      options: {
        scales: {
          xAxes: [{
            display: false,
            barPercentage: 1.3,
            ticks: {
              max: 3,
            }
          }, {
            display: true,
            ticks: {
              autoSkip: false,
              max: 4,
            }
          }],
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
  </script>
  <script type="text/javascript">
    var ctx = document.getElementById("myChart1").getContext('2d');
    var dataValues = [12, 19, 3, 5];
    var dataLabels = [1, 2, 3, 4];
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($time); ?>,
        datasets: [{
          label: 'Conductivity Level',
          data: <?php echo json_encode($conduct_level); ?>,
          backgroundColor: 'rgba(100, 0, 100, 1)',
        }]
      },
      options: {
        scales: {
          xAxes: [{
            display: false,
            barPercentage: 1.3,
            ticks: {
              max: 3,
            }
          }, {
            display: true,
            ticks: {
              autoSkip: false,
              max: 4,
            }
          }],
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
  </script>
</body>

</html>
