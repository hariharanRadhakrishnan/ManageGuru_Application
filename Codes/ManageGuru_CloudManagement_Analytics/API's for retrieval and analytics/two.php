<?php
 header("Access-Control-Allow-Origin: *"); 
$con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  echo "lollll";

$sql = "SELECT * FROM menu";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "sish_id: " . $row["dish_id"]. " - dish_name: " . $row["dish_name"]. " " . $row["price"]. "<br>";
    }
} else {
    echo "0 results";
}
$con->close();
?>