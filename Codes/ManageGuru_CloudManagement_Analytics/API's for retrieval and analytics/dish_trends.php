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
$sql = "SELECT * FROM (SELECT dish_id, count(dish_id) as count FROM orders GROUP BY dish_id ORDER BY count DESC) o LEFT JOIN menu m on o.dish_id=m.dish_id";
$sql2 = "SELECT count(*) FROM orders";
$dishes_data = $con->query($sql);
$count = $con->query($sql2)->fetch_assoc();
if ($dishes_data->num_rows > 0) {
    // output data of each row
    $data = array();
    $dishes = array();
    $dishes_share = array();
    while($row = $dishes_data->fetch_assoc()) {
        $dishes[] = $row["dish_name"];
        $dishes_share[] = ((int) $row["count"]) * 100 / ((int) $count["count(*)"]);
    }
    $data[] = $dishes;
    $data[] = $dishes_share;
    echo json_encode($data);
} else {
    echo "0 results";
}
$con->close();

?>