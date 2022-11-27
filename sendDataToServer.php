<?php
include 'includes/cnx.php';
class sendDataToServer extends dbConnection
{
  function __construct($ph_level, $temp_level, $conduct_level)
  {
    $this->connect();
    $this->senddata($ph_level, $temp_level, $conduct_level);
  }


  //saving data to databse
  function senddata($ph_level, $temp_level, $conduct_level)
  {
    $query = "insert into milkcontent set Ph_level='" . $ph_level . "',Temperature_level='" . $temp_level . "',Conductivity_level='" . $conduct_level . "'";
    $result = mysqli_query($this->link, $query) or die('could not run query' . $query);
  }
}
if ($_GET['Ph_level'] != '' && $_GET['Temperature_level'] != '' && $_GET['Conductivity_level']) {
  $sendDataToServer = new sendDataToServer($_GET['Ph_level'], $_GET['Temperature_level'], $_GET['Conductivity_level']);
  // echo $_GET['PH_level'];
  echo "<script> document.location = '../MilkMonitoringSystem/index.php'; </script>";

}

    //end point for insering data
    /*
    1. GET /MilkMonitoringSystem/sendDataToServer.php?PH_level='ph value'
    2. GET /MilkMonitoringSystem/sendDataToServer.php?Temperature_level='temperature value'
    3. GET /MilkMonitoringSystem/sendDataToServer.php?Conductivity_level='conductivity value'
    
    
    
    
    */
