<?php
 

include('../database_connection.php');

if(isset($_POST["di"]))
{
 $query = "
 DELETE FROM tbl_role_level 
 WHERE rlv_id = '".$_POST["di"]."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>
