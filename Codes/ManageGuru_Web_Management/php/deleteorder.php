<?php
	include 'connect.php';
	extract($_POST);
	$sql = "SELECT filled_time from tables WHERE table_num=$table_num";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$filled_time = $row['filled_time'];
	$sql = "SELECT * FROM orders WHERE table_num=$table_num and dish_name='$dish_name' and order_time >= '$filled_time'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		if($row['quantity'] - $quantity != 0)
		{			
			$sql = "UPDATE orders SET quantity=".$row['quantity']."-$quantity WHERE table_num=$table_num  and dish_name='$dish_name' and order_time >= '$filled_time'";
			$result = $conn->query($sql);
		}
		else
		{
			$sql = "DELETE FROM orders WHERE table_num=$table_num and dish_name='$dish_name' and order_time >= '$filled_time'";
			$result = $conn->query($sql);
		}
		$sql = "SELECT * FROM orders WHERE table_num=$table_num and dish_name='$dish_name' and order_time >= '$filled_time'";
		$result = $conn->query($sql);
		if($result->num_rows == 0)
		{
			$sql = "UPDATE tables SET filled=0 WHERE table_num=$table_num";
			$result = $conn->query($sql);
		}
	}
	echo json_encode(array('table_num'=>$table_num));