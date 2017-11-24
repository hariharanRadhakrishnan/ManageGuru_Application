<?php
	session_start();
	include "connect.php";
	extract($_POST);
	$sql = "SELECT password,user_type from users where user_name='$user_name'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		if($password == $row['password'])
		{
			$_SESSION['user_name'] = $user_name;
			$_SESSION['user_type'] = $row['user_type'];
			$sql = "UPDATE users SET login_time=NOW() WHERE user_name='".$_SESSION["user_name"]."'";
			$result = $conn->query($sql);
			echo json_encode(array("success",$row['user_type']));
		}
		else
			echo json_encode(array("fail"));
	}
	else
	{
		echo json_encode(array("fail"));
	}