<?php
  
include('../database_connection.php');

if(isset($_POST["ei"]))
{
 $query = "
 update tbl_user 
 set user_password = 123 , user_status = 0 
 WHERE user_ids = '".$_POST["ei"]."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>
