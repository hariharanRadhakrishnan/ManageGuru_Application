<?php
$con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  
$result = mysqli_query($con,"SELECT COUNT(`order_time`) FROM orders WHERE DATE(`order_time`) = CURDATE()");
$num_rows = mysqli_num_rows($result);
$data["num_of_orders"] = $num_rows -1;
echo json_encode($data);
$con->close();
?>