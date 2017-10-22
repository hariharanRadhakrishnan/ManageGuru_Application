<?php
	include "connect.php";
	extract($_GET);
	$sql = "SELECT dish_type,dish_name,SUM(quantity) as quantity FROM orders WHERE table_num='$table_num' and order_time >= (select filled_time from tables where table_num = $table_num and filled = 1) GROUP BY dish_name HAVING SUM(quantity) > 0 ORDER BY order_time ASC";
	$result = $conn->query($sql);
	if($result->num_rows>0)
	{
		$arr = array();
		while($row = $result->fetch_assoc())
		{
			$arr2 = array();
			$arr2["dish_type"] = $row["dish_type"];
			$arr2["dish_name"] = $row["dish_name"];
			$arr2["quantity"] = $row["quantity"];
			array_push($arr, $arr2);
		}
		echo json_encode($arr);
	}
	else
		echo "[]";