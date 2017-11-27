<?php
 header("Access-Control-Allow-Origin: *");
  extract($_POST);
  
  $con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$sql = "INSERT INTO orders(order_id,dish_id,table_id,order_time,franchise_id) VALUES('".$order_id."','".$dish_id."','".$table_id."','".$order_time."', '".$franchise_id."')";
if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$con->close();