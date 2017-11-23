<?php
$con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $date=time();
$sql = "SELECT * FROM inventory_orders";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$data["item_code"] = $row["item_code"];
		$data["quantity"] = $row["quantity"];
		$data["user_id"] = $row["user_id"];
		$data["order_time"] = $row["order_time"];

        echo  json_encode($data);
    }
} else {
    echo "0 results";
}



$con->close();
?>