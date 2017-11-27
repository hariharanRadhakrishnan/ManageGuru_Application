<?php
 header("Access-Control-Allow-Origin: *"); 

  extract($_GET);
  
  $con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//$sql = "SELECT w.user_id, u.user_name from waiters w, users u WHERE u.user_id=w.user_id GROUP BY w.user_id ORDER BY count(w.user_id) DESC LIMIT 1";
//$sql = "SELECT o.item_id,m.dish_name,count(o.item_id) as number from orders o,menu m WHERE o.item_id=m.dish_id GROUP BY o.item_id ORDER BY count(o.item_id) DESC LIMIT 1";
$sql = "SELECT * FROM (SELECT dish_id, count(dish_id) as count FROM orders GROUP BY dish_id ORDER BY count DESC LIMIT 1) o LEFT JOIN menu m on o.dish_id=m.dish_id";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$data["dish_id"]  = $row["dish_id"];
		$data["dish_count"] = $row["count"];
		$data["dish_name"] = $row["dish_name"];
        echo json_encode($data);
    }
} else {
    echo "0 results";
}
$con->close();

?>