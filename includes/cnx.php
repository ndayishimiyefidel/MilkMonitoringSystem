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