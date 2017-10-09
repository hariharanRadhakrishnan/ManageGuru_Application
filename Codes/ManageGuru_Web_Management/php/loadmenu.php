<?php
	include 'connect.php';
	$sql = "SELECT * FROM menu ORDER BY dish_type, dish_name";
	$result = $conn->query($sql);
	if($result->num_rows>0)
	{
		$arr = array();
		while($row = $result->fetch_assoc())
		{
			$arr2 = array();
			$arr2["dish_name"] = $row["dish_name"];
			$arr2["dish_type"] = $row["dish_type"];
			$arr2["price"] = $row["price"];
			array_push($arr, $arr2);
		}
		echo json_encode($arr);
	}
	else
		echo "[]";