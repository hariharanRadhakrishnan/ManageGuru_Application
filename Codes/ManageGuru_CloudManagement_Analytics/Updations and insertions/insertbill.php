<?php

  extract($_GET);
  
  $con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $sql = "INSERT into billing(bill_id,bill_time,amount,franchise_id) VALUES ('".$bill_id."','".$bill_time."',".$amount.",'".$franchise_id."')";
//$sql="INSERT into billing(bill_id,bill_time,amount,franchise_id) VALUES ('B1666','8/31/2017 11:45',99,'F1')";
if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$con->close();

  


?>