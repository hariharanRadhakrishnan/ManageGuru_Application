<?php
 header("Access-Control-Allow-Origin: *");
$con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  
//$sql = "SELECT count(payment_type) FROM customers group by payment_type ";

$sql = "SELECT * FROM time1 ORDER BY time1 DESC LIMIT 1;";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		foreach ($row as $key => $value) {
			 $data["last_inventory_order_time"] = $value;
			 echo json_encode($data);
			}

    }
} else {
    echo "0 results";
}

$con->close();
?>