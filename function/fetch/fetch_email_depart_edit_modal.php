<?php

//fetch_single_data.php

include('../database_connection.php');

if(isset($_POST["ei"]))
{
 $query = "
 SELECT * FROM tbl_depart WHERE depart_id = '".$_POST["ei"]."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 while($row = $statement->fetch(PDO::FETCH_ASSOC))
 {
  $data[] = $row;
 }
 echo json_encode($data);
}

?>