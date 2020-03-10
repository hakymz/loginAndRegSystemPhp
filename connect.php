<?php 
 $connect = mysqli_connect("localhost","root","","user_system");
 if(mysqli_connect_errno()){
  echo "Could Not Connect";
  die();
 }
?>