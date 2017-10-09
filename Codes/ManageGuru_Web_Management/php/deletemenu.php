<?php
	include 'connect.php';
	extract($_POST);
	$sql = "DELETE FROM menu WHERE dish_type = '$dish_type' and dish_name = '$dish_name'";
	$result = $conn->query($sql);