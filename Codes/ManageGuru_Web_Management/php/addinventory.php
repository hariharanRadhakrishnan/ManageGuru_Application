<?php
	include 'connect.php';
	extract($_POST);
	$sql = "SELECT * FROM inventory WHERE item_name='$item_name' and item_type='$item_type'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{
		$sql = "UPDATE inventory SET quantity=$quantity WHERE item_type='$item_type' and item_name='$item_name'";
		echo $sql;
		$result = $conn->query($sql);		
	}
	else
	{
		$sql = "INSERT INTO inventory(item_type,item_name,quantity) VALUES ('$item_type','$item_name',$quantity)";
		echo $sql;
		$result = $conn->query($sql);	
	}