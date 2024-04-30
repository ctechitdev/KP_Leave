<?php

//fetch_single_data.php
 session_start();
include('../database_connection.php');

if(isset($_POST["ei"]))
{
 $query = " SELECT  ps_id,position_name,unit_name,b.unit_id as unit_id,depart_name,a.depart_id as depart_id
FROM  tbl_position a
left join tbl_depart_unit b on a.unit_id = b.unit_id
left join tbl_depart c on a.depart_id = c.depart_id
 WHERE ps_id = '".$_POST["ei"]."' ";
 $statement = $connect->prepare($query);
 $statement->execute();
 while($row = $statement->fetch(PDO::FETCH_ASSOC))
 {
  $data[] = $row;
 }
 echo json_encode($data);
}

 $query = " SELECT  ps_id,position_name,unit_name,b.unit_id as unit_id,depart_name,a.depart_id as depart_id
FROM  tbl_position a
left join tbl_depart_unit b on a.unit_id = b.unit_id
left join tbl_depart c on a.depart_id = c.depart_id
 WHERE ps_id = '".$_POST["ei"]."' ";
 $statement2 = $connect->prepare($query);
 $statement2->execute();
 while($row2 = $statement2->fetch(PDO::FETCH_ASSOC))
 {
  $full_name = $row2['unit_id'];
 
 }
 $_SESSION["full_name"] = $full_name;
?>