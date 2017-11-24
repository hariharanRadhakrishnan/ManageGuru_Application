<?php
	include "connect.php";
	$sql = "SELECT user_name,user_type FROM users WHERE login_time > logout_time ORDER BY user_name";
	$result = $conn->query($sql);
	if($result->num_rows>0)
	{
		$arr = array();
		while($row = $result->fetch_assoc())
		{
			$arr2 = array();
			$arr2["username"] = $row["user_name"];
			$arr2["usertype"] = $row["user_type"];
			array_push($arr, $arr2);
		}
		echo json_encode($arr);
	}
	else
		echo "none";