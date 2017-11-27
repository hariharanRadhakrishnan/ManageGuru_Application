<?php
 header("Access-Control-Allow-Origin: *"); 
$con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  
$sql = "SELECT * FROM inventory_orders LEFT JOIN inventory ON inventory_orders.item_code=inventory.item_code WHERE inventory.item_code IS NOT NULL and inventory_orders.item_code IS NOT NULL GROUP BY inventory.item_code ORDER BY COUNT(*) DESC LIMIT  10";


$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $x = "[";
    while($row = $result->fetch_assoc()) {
		$data["item_code"] = $row["item_code"];
		$data["item_name"] = $row["item_name"];
		$data["quantity"] = $row["quantity"];
		//$data["user_id"] = $row["user_id"];
		//$data["order_time"] = $row["order_time"];
		$data["cost_per_unit"] = $row["amount"];

        echo  $x.json_encode($data);
        $x = ",";
    }
    echo "]";
} else {
    echo "0 results";
}

$con->close();
?>