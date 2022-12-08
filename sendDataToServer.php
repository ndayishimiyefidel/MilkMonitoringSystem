<?php
include 'includes/cnx.php';
$ph=$_POST['ph'];
$temp=$_POST['temp'];
$gas=$_POST['gas'];
$query="INSERT INTO milkcontent(
    Ph_level,
    Temperature_level,
    Conductivity_level
    )
VALUES(
    $ph,
    $temp,
    $gas
)";

$ex= mysqli_query($db,$query);
if($ex)
{
    echo "Successs!";
}else{
    echo "ERROR:unabe to save data";
}

