<?php
$con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $date=time();
$sql = "SELECT * FROM billing LEFT JOIN customers ON billing.bill_id=customers.bill_id";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$data["bill_id"] = $row["bill_id"];
		$data["bill_time"] = $row["bill_time"];
		$data["amount"] = $row["amount"];
		$data["table_id"] = $row["table_id"];
		$data["payment_type"] = $row["payment_type"];
		$data["customer_name"] = $row["customer_name"];


        echo  json_encode($data);
    }
} else {
    echo "0 results";
}



$con->close();
?>