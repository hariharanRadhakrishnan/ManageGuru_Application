<?php
 header("Access-Control-Allow-Origin: *"); 
$con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  
$result = mysqli_query($con,"SELECT COUNT(`order_time`), order_time FROM orders WHERE DATE(`order_time`) = CURDATE()");
$assoc = $result->fetch_assoc();
$data["num_of_orders"] = $assoc['COUNT(`order_time`)'];
$data["time"] = $assoc['order_time'];
echo json_encode($data);
$con->close();
?>