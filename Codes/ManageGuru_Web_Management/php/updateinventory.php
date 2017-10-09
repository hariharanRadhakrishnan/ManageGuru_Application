<?php
	include 'connect.php';
	extract($_POST);
	$sql = "UPDATE inventory SET quantity=$quantity WHERE item_type='$item_type' and item_name='$item_name'";
	$result = $conn->query($sql);