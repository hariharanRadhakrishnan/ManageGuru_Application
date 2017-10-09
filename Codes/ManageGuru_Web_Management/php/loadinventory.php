<?php
	include 'connect.php';
	$sql = "SELECT * FROM inventory ORDER BY item_type, item_name ASC";
	$result = $conn->query($sql);
	if($result->num_rows>0)
	{
		$arr = array();
		while($row = $result->fetch_assoc())
		{
			$arr2 = array();
			$arr2["item_code"] = $row["item_code"];
			$arr2["item_type"] = $row["item_type"];
			$arr2["item_name"] = $row["item_name"];
			$arr2["quantity"] = $row["quantity"];
			array_push($arr, $arr2);
		}
		echo json_encode($arr);
	}
	else
		echo "[]";
