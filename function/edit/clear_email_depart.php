<?php
  
include('../database_connection.php');

if(isset($_POST["di"]))
{
 $query = "
 update tbl_depart 
 set   depart_email = null
 WHERE depart_id = '".$_POST["di"]."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
}



?>

 