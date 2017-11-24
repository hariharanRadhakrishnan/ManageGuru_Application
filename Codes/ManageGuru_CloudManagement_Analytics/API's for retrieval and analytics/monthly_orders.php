<?php
$con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql = "SELECT EXTRACT(MONTH FROM order_time), count(order_time) FROM orders GROUP BY EXTRACT(YEAR_MONTH FROM order_time)";
$result = $con->query($sql);

/*if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		foreach ($row as $key => $value) {
			 echo $key;
			 echo $value;
			}

    }
} else {
    echo "0 results";
}*/

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  $row["EXTRACT(MONTH FROM order_time)
"]." ". $row["count(order_time)"]."<br>";
    }
} else {
    echo "0 results";
}

$con->close();
?>

EXTRACT(MONTH FROM order_time)
count(order_time)