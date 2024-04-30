<?php

//update_data.php

include('../database_connection.php');

if(isset($_POST["unitid"]))
{
 $error = '';
 $success = '';
 $unitid = ''; 
 $post_name = '';
 
 if(empty($_POST["unitid"]))
 {
  $error .= '<p> ກະລຸນາ ເລືອກຝ່າຍ </p>';
 }
 else
 {
  $unitid = $_POST["unitid"];
 } 
  
   if(empty($_POST["pname"]))
 {
  $error .= '<p> ຂໍ້ມູນຕຳແໜ່ງວ່າງ </p>';
 }
 else
 {
  $post_name = $_POST["pname"];
 } 

   if(empty($_POST["depid"]))
 {
  $error .= '<p> ກະລຸນາ ເລືອກພະແນກ </p>';
 }
 else
 {
  $depart_id = $_POST["depid"];
 }

  
 if($error == '')
 {
  $data = array(
   ':dpid'   => $depart_id, 
   ':uid'   => $unitid, 
   ':pname'   => $post_name, 
   ':id'   => $_POST["ps_id"]
  );

  $query = "
  UPDATE tbl_position 
  SET depart_id = :dpid , unit_id   = :uid , position_name = :pname
  WHERE ps_id = :id
  ";
  $statement = $connect->prepare($query);
  $statement->execute($data);
  $success = 'Employee Data Updated';
 }
 $output = array(
  'success'  => $success,
  'error'   => $error
 );
 echo json_encode($output);
}

?>
