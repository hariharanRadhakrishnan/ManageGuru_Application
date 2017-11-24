<?php
	include "connect.php";
	$sql = "SELECT * FROM inventory_orders WHERE status=0 ORDER BY item_type,item_name";
	$result = $conn->query($sql);
	if($result->num_rows>0)
	{
		$arr = array();
		while($row = $result->fetch_assoc())
		{
			$arr2 = array();
			$arr2["itemType"] = $row["item_type"];
			$arr2["itemName"] = $row["item_name"];
			$arr2["quantity"] = $row["quantity"];
			array_push($arr, $arr2);
		}
		echo json_encode($arr);
	}
	else
		echo "none";