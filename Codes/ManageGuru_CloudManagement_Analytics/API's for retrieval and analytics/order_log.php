<?php
 header("Access-Control-Allow-Origin: *"); 
$con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $date=time();
  $sql = "SELECT * FROM orders LEFT JOIN menu on orders.dish_id=menu.dish_id ORDER BY orders.order_time";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $x = "[";
    while($row = $result->fetch_assoc()) {
		$data["order_id"] = $row["order_id"];
		$data["order_time"] = $row["order_time"];
		$data["dish_id"] = $row["dish_id"];
		$data["table_id"] = $row["table_id"];
		$data["dish_name"] = $row["dish_name"];
        echo $x.json_encode($data);
        $x = ",";
    }
    echo "]";
} else {
    echo "0 results";
}



$con->close();
?>