<?php
	session_start();
	include "connect.php";
	extract($_POST);
	$sql = "SELECT filled_time FROM tables WHERE table_num = $table_num";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$table_fill_time = $row['filled_time'];	
	$sql = "SELECT DATE(NOW()) as date";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$date = $row["date"];

	$sql = "INSERT INTO billing(bill_date,table_num,table_fill_time,amount,payment_type,user_name) VALUES ('$date',$table_num,'$table_fill_time',$amount,'$payment_type','".$_SESSION['user_name']."')";
	$result = $conn->query($sql);

	$sql = "UPDATE tables SET filled=0 WHERE table_num=$table_num";
	$result = $conn->query($sql);
	
	echo "Success";