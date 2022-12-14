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
  <div class="container">
    <div class="row m-4 p-4">
      <div class="col-md-4">
        <canvas id="myChart" width="100" height="100"></canvas>
      </div>
      <div class="col-md-4">
        <canvas id="myChart1" width="100" height="100"></canvas>
      </div>
      <div class="col-md-4">
        <canvas id="myChart2" width="100" height="100"></canvas>
      </div>
    </div>

    <div class="row">
        <div class="col-md-12 " style="height:50%;">
            <h2>Permitted Milk quality for Drinking</h2>
            <div id="temperature">
            <?php
                $query = "SELECT* FROM milkcontent";
                $result = mysqli_query($db, $query);
                $chart_data = '';
                while($row = mysqli_fetch_array($result)){
                //echo $row['Gas'];
                $chart_data .= "{date:'".$row["createtime"]."', Temperature:".$row["Temperature_level"].", Gas:".$row["Conductivity_level"].", PH:".$row["Ph_level"]."}, ";
              }
                $chart_data = substr ($chart_data, 0, -2);
                ?>

            </div>
          </div>
      </div>

    <div class="row">
      <div class="col-md-12">
        <h2 class="m-4 p-4 text-center">Record taken by sensors</h2>
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Ph Level</th>
              <th scope="col">Temperature Level</th>
              <th scope="col">Gas Level</th>
              <th scope="col">Taken Time</th>
            </tr>
          </thead>
    

  <?php

  $sql = "SELECT * FROM milkcontent order by id desc limit 1000";

  $result = mysqli_query($db, $sql);
  $i=0;
  while ($row = mysqli_fetch_array($result)) {

    $ph_level[]  = $row['Ph_level'];
    $temp_level[] = $row['Temperature_level'];
    $conduct_level[] = $row['Conductivity_level'];
    $time[] = $row['createtime'];
    $i++;
    ?>
    
   
          <tbody>
            <tr>
              <td><?php echo$i;?></td>
              <td><?=$row['Ph_level']?></td>
              <td><?=$row['Temperature_level']?></td>
              <td><?=$row['Conductivity_level']?></td>
              <td><?=$row['createtime']?></td>
            </tr>  
          </tbody>
    <?php
   
  }


  ?>
  </table>
      </div>
    </div>
</div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
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
          label: 'Gas Level',
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
  <script>
Morris.Bar({
element:'temperature',
data:[<?php echo $chart_data ;?>],
xkey:'date',
ykeys:['Temperature','Gas','PH'],
labels:['Temperature','Gas','PH'],
hideHover:'auto'
});
</script>
</body>

</html>