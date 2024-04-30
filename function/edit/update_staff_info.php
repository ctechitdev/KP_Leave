<?php

//update_data.php

include('../database_connection.php');

if(isset($_POST["cpcode"]))
{
 $error = '';
 $success = '';
 
 $codecp = '';
 $gender = $_POST["gen"];
 $first_name = '';
 $last_name = '';
 $depart_id = $_POST["dpid"];
 $unit_id = $_POST["unid"];
 $position_id = $_POST["psid"];
 
  
 if(empty($_POST["cpcode"]))
 {
  $error .= '<p>Name is Required</p>';
 }
 else
 {
  $codecp = $_POST["cpcode"];
 } 
  
   if(empty($_POST["fname"]))
 {
  $error .= '<p>Name is Required</p>';
 }
 else
 {
  $first_name = $_POST["fname"];
 } 

   if(empty($_POST["lname"]))
 {
  $error .= '<p>Name is Required</p>';
 }
 else
 {
  $last_name = $_POST["lname"];
 }

  
 if($error == '')
 {
  $data = array(
   ':cpnum'   => $codecp, 
   ':genid'   => $gender, 
   ':namef'   => $first_name, 
   ':namel'   => $last_name, 
   ':iddp'   => $depart_id,  
   ':idunit'   => $unit_id, 
   ':idpost'   => $position_id, 
   ':id'   => $_POST["s_id"]
  );

  $query = "
  UPDATE tbl_staff 
  SET staff_code = :cpnum , staff_first_name   = :namef , staff_last_name = :namel , staff_gender = :genid ,staff_depart = :iddp , staff_unit =:idunit , staff_position = :idpost
  WHERE staff_id = :id
  ";
  $statement = $connect->prepare($query);
  $statement->execute($data);
  $success = 'ແກ້ໄຂຂໍມູນພະນັກງານສຳເລັດ';
 }
 $output = array(
  'success'  => $success,
  'error'   => $error
 );
 echo json_encode($output);
}

?>
