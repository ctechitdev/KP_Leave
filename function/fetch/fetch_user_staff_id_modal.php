<?php

//fetch_single_data.php

include('../database_connection.php');

if(isset($_POST["ri"]))
{
 $query = "  select * from users_info 
 WHERE staff_id = '".$_POST["ri"]."' ";
 $statement = $connect->prepare($query);
 $statement->execute();
 while($row = $statement->fetch(PDO::FETCH_ASSOC))
 {
  $data[] = $row;
 }
 echo json_encode($data);
}

?>