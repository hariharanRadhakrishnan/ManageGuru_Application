<?php
	include 'connect.php';
	extract($_POST);
	$sql = "SELECT * FROM menu WHERE dish_name='$dish_name' and dish_type='$dish_type'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{
		$sql = "UPDATE menu SET price=$price WHERE dish_type='$dish_type' and dish_name='$dish_name'";
		$result = $conn->query($sql);		
	}
	else
	{
		$sql = "INSERT INTO menu(dish_type,dish_name,price) VALUES ('$dish_type','$dish_name',$price)";
		$result = $conn->query($sql);	
	}