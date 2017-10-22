<?php
	include 'connect.php';
	extract($_POST);
	$sql = "SELECT filled,filled_time from tables WHERE table_num=$table_num";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		if($row['filled'] == 0)
		{
			$sql = "UPDATE tables SET filled=1,filled_time=NOW() WHERE table_num=$table_num";
			$result = $conn->query($sql);
		}
	}
	else
	{
		$sql = "INSERT INTO tables(table_num,filled,num_of_people) VALUES ($table_num,1,4)";
		$result = $conn->query($sql);
	}
	$sql = "INSERT INTO orders(table_num,dish_type,dish_name,quantity) VALUES ($table_num,'$dish_type','$dish_name',$quantity)";
	$result = $conn->query($sql);
	$sql = "SELECT dish_type,dish_name,SUM(quantity) as quantity FROM orders WHERE table_num='$table_num' and order_time >= (select filled_time from tables where table_num = $table_num and filled = 1) GROUP BY dish_name HAVING SUM(quantity) > 0 ORDER BY order_time ASC";
	$result = $conn->query($sql);
	if($result->num_rows == 0)
	{
		$sql = "UPDATE tables SET filled=0 WHERE table_num=$table_num";
		$result = $conn->query($sql);
	}	
	echo json_encode(array('table_num'=>$table_num));