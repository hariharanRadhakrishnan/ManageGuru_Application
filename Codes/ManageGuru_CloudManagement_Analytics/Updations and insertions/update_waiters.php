<?php

  extract($_GET);
  
  $con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$sql = "INSERT INTO waiters(table_id,user_id,order_time,franchise_id) VALUES(".$table_id.",'".$user_id."','".$order_time."','".$franchise_id."')";
//$sql="INSERT into waiters(table_id,user_id,order_time,franchise_id) VALUES('19','U19','8/31/17 12:45','F1')";
if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$con->close();