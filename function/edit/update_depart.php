<?php

//update_data.php

include('../database_connection.php');

if(isset($_POST["namedp"]))
{
 $error = '';
 $success = '';
 $dpname = ''; 
 
 if(empty($_POST["namedp"]))
 {
  $error .= '<p> ຕື່ມຊື່ພະແນກ </p>';
 }
 else
 {
  $dpname = $_POST["namedp"];
 } 
  

  
 if($error == '')
 {
  $data = array(
   ':name'   => $dpname, 
   ':id'   => $_POST["depart_id"]
  );

  $query = "
  UPDATE tbl_depart 
  SET depart_name = :name
  WHERE depart_id = :id
  ";
  $statement = $connect->prepare($query);
  $statement->execute($data);
  $success = ' ແກ້ໄຂຂໍ້ມູນພະແນກສຳເລັດ';
 }
 $output = array(
  'success'  => $success,
  'error'   => $error
 );
 echo json_encode($output);
}

?>
