<?php
	session_start();
	include "connect.php";
	extract($_POST);
	$item_code = -1;
	$sql = "SELECT item_code from inventory where item_name='$item_name' and item_type='$item_type'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		$item_code = $row['item_code'];
	}
	else
	{
		$sql = "SELECT max(item_code) as item_code from inventory";
		$result = $conn->query($sql);
		if($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
			$item_code = $row['item_code'] + 1;
		}
	}
	if($item_code == -1)
	{
		exit();
	}
	$sql = "INSERT INTO inventory_orders(item_code,item_type,item_name,quantity,user_name) VALUES ($item_code,'$item_type','$item_name',$quantity,'".$_SESSION["user_name"]."')";
	$result = $conn->query($sql);
	echo json_encode(array("item_name"=>$item_name,"item_type"=>$item_type,"quant"=>$quantity));