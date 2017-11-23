<?php
$con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql = "SELECT avg(amount) FROM billing";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		foreach ($row as $key => $value) {
			 $data["total_avg_income"] = $value;
			 echo json_encode($data);
			}
    }
} else {
    echo "0 results";
}
$con->close();
?>