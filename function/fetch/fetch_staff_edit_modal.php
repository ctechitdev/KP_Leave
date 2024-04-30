<?php

//fetch_single_data.php
 session_start();
include('../database_connection.php');

if(isset($_POST["ei"]))
{
 $query = " SELECT staff_id,staff_code,
 gender_name, staff_first_name,staff_last_name,
staff_gender,  
staff_depart,depart_name,staff_unit,unit_name,staff_position,position_name
 FROM staff_info_view 
 WHERE staff_id = '".$_POST["ei"]."' ";
 $statement = $connect->prepare($query);
 $statement->execute();
 while($row = $statement->fetch(PDO::FETCH_ASSOC))
 {
  $data[] = $row;
 }
 echo json_encode($data);
}


 $query2 = " SELECT staff_id,staff_code,
 gender_name, staff_first_name,staff_last_name,staff_gender,  
staff_depart,depart_name,staff_unit,unit_name,staff_position,position_name
 FROM staff_info_view 
 WHERE staff_id = '".$_POST["ei"]."' ";
 $statement2 = $connect->prepare($query2);
 $statement2->execute();
 while($row2 = $statement2->fetch(PDO::FETCH_ASSOC))
 {
  $staff_unit = $row2['staff_unit'];
  $staff_position = $row2['staff_position'];
 
 }

 $_SESSION["staff_unit"] = $staff_unit;
 $_SESSION["staff_position"] = $staff_position;


?>