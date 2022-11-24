<?php 
class dbConnection{
     
function connect(){
$this->link=mysqli_connect("localhost","root","") or die("Could not connect to the Database Server");
$fb=mysqli_select_db($this->link,"milkmonitoring") or die("Could not select the database");
    }

}