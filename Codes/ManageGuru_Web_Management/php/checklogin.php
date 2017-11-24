<?php
	session_start();
	if(isset($_SESSION['user_name']))
	{
		echo json_encode(array($_SESSION['user_name'],$_SESSION['user_type']));
	}
	else
	{
		echo "no";
	}