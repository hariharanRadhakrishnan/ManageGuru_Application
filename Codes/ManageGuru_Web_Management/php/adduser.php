<?php
	include "connect.php";
	extract($_POST);
	$sql = "SELECT * from users WHERE user_name='$username'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{
		echo "Username Already Exists";
	}
	else
	{
		$sql = "INSERT INTO users(user_name,password,user_type) VALUES ('$username','$password','$usertype')";
		$result = $conn->query($sql);
		echo "Done";
	}