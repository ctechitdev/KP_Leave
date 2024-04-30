<?php

 

include('../database_connection.php');

if(isset($_POST["di"]))
{
 $query = "
 DELETE FROM tbl_depart 
 WHERE depart_id = '".$_POST["di"]."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>
