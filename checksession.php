<?php

session_start();
	if($_SESSION['user_ids'] == "" )
	{
	header("location:Logout.php");
	}
	if($_SESSION['status_user'] == "0" )
	{
	header("location:change_password.php");
	}
	 
	else{
		$user_ids = $_SESSION["user_ids"];
		$staff_depart = $_SESSION["staff_depart"]; 
		$staff_code = $_SESSION["staff_code"]; 
		$staff_id = $_SESSION["staff_id"];
		$role_level = $_SESSION["role_level"];
		$status_user = $_SESSION["status_user"];
		$full_name = $_SESSION["full_name"]; 
		 
		 
	}
 
?>