<?php
  
include('../database_connection.php');

if(isset($_POST["di"]))
{
 $query = "
 update tbl_user 
 set   user_status = 2
 WHERE user_ids = '".$_POST["di"]."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>
