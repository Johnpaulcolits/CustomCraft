<?php
   $hostname = "localhost";
   $username = "u330866214_craft";
   $password = "Cr@ft_0123!";
   $dbname = "u330866214_craft";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>






















