<?php

//update_data.php

include('../database_connection.php');

if(isset($_POST["dpid"]))
{
 $error = '';
 $success = '';
 $dpid = ''; 
 
 if(empty($_POST["dpid"]))
 {
  $error .= '<p>ເລືອກພະແນກ</p>';
 }
 else
 {
  $dpid = $_POST["dpid"];
 } 
  
   if(empty($_POST["nameunit"]))
 {
  $error .= '<p>ກະລູນາຕື່ມຂໍ້ມູນຝ່າຍ</p>';
 }
 else
 {
  $uname = $_POST["nameunit"];
 } 

  
 if($error == '')
 {
  $data = array(
   ':name'   => $dpid, 
   ':unitn'   => $uname, 
   ':id'   => $_POST["unit_id"]
  );

  $query = "
  UPDATE tbl_depart_unit 
  SET depart_id   = :name , unit_name = :unitn
  WHERE unit_id = :id
  ";
  $statement = $connect->prepare($query);
  $statement->execute($data);
  $success = 'ແກ້ໄຂ ຂໍ້ມູນຝ່າຍ ສຳເລັດ';
 }
 $output = array(
  'success'  => $success,
  'error'   => $error
 );
 echo json_encode($output);
}

?>
