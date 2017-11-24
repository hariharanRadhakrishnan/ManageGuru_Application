<?php
	session_start();
	include "connect.php";
	extract($_POST);
	$sql = "SELECT * FROM inventory_orders WHERE item_name='$item_name' and item_type='$item_type'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		$sql = "UPDATE inventory_orders SET quantity=".$row['quantity']."+$quantity WHERE item_type='$item_type' and item_name='$item_name'";
		$result = $conn->query($sql);
		echo json_encode(array("item_name"=>$item_name,"item_type"=>$item_type,"quant"=>$row['quantity']+$quantity));		
	}
	else
	{
		$sql = "INSERT INTO inventory_orders(item_type,item_name,quantity,user_name) VALUES ('$item_type','$item_name',$quantity,'".$_SESSION["user_name"]."')";
		$result = $conn->query($sql);
		echo json_encode(array("item_name"=>$item_name,"item_type"=>$item_type,"quant"=>$quantity));	
	}