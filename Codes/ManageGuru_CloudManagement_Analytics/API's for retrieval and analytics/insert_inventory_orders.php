<?php
 header("Access-Control-Allow-Origin: *");
  extract($_GET);
  
  $con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$sql = "INSERT INTO inventory_orders(item_code,item_type,quantity,user_id,order_time,franchise_id) VALUES(".$item_code.",'".$item_type."',".$quantity.",'".$user_id."','".$order_time."','".$franchise_id."')";
//$sql = "INSERT INTO inventory_orders(item_code,item_type,quantity,user_id,order_time,franchise_id) VALUES(67,'Fruits',20,'U2','2017-01-01 12:12:12','F1')";



if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
	date_default_timezone_set('Asia/Kolkata');

	$data = date("Y-m-d H:i:s");
	
	$sql1 = "INSERT INTO time1(time1) VALUES('".$data."')";
	if ($con->query($sql1) === TRUE) {
		echo "New record created successfully";
	}


	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$con->close();