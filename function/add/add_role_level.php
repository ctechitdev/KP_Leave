<?php
 
include('../database_connection.php');

if(isset($_POST["lvid"]))
{
 $error = '';
 $success = '';
 $level_role = '';  
 $date_register = date("Y-m-d");
 
 
 
 if(empty($_POST["lvid"]))
 {
  $error .= "<p> ຕື່ມຂໍ້ມູນ E-Mail $nt </p>";
 }
 else
 {
  $level_role = $_POST["lvid"];
 }
   
  
   
 if($error == '')
 {
	 
	$data = array(
	':idlv'   => $level_role,  
	':dregis'   => $date_register,
	':id'   => $_POST["id_ps"]
	);
 
 
  $query = " 
  insert into tbl_role_level (ps_id,role_level,date_register) 
  values ( :id, :idlv, :dregis ) 
  ";
  $statement = $connect->prepare($query);
  $statement->execute($data);
  $success = ' ເພີ່ມຜູ້ໃຊ້ສຳເລັດ ';
 }
 $output = array(
  'success'  => $success,
  'error'   => $error
 );
 echo json_encode($output);
}

?>
