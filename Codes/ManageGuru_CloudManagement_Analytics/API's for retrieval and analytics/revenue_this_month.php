<?php
 header("Access-Control-Allow-Origin: *"); 
$con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  
$sql = "SELECT sum(amount), bill_time FROM billing group by month(bill_time)";

$result = $con->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();
  $data["revenue"] = $row["sum(amount)"];
  $data["month"] = $row["bill_time"];
  echo json_encode($data);
}
$con->close();
?>