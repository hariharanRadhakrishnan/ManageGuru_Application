<?php
	include "connect.php";
	session_start();
	$sql = "UPDATE users SET logout_time=NOW() WHERE user_name='".$_SESSION['user_name']."'";
	$result = $conn->query($sql);
	echo "logged out";