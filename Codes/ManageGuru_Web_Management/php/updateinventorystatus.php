<?php
	include "connect.php";
	extract($_POST);
	if($flag == "success")
	{
		$sql = "UPDATE inventory_orders SET status=1 WHERE item_type='$itemType' and item_name='$itemName'";
		$result = $conn->query($sql);
	}
	else
	{
		$sql = "UPDATE inventory_orders SET status=2 WHERE item_type='$itemType' and item_name='$itemName'";
		$result = $conn->query($sql);
	}
	echo "success";
	