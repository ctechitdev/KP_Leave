<?php

//update_data.php

include('../database_connection.php');

if(isset($_POST["dpem"]))
{
 $error = '';
 $success = '';
 $dpemail = ''; 
 
 if(empty($_POST["dpem"]))
 {
  $error .= '<p> ຕື່ມ E-Mail ພະແນກ </p>';
 }
 else
 {
  $dpemail = $_POST["dpem"];
 } 
  

  
 if($error == '')
 {
  $data = array(
   ':email'   => $dpemail, 
   ':id'   => $_POST["depart_id"]
  );

  $query = "
  UPDATE tbl_depart 
  SET depart_email = :email
  WHERE depart_id = :id
  ";
  $statement = $connect->prepare($query);
  $statement->execute($data);
  $success = ' ແກ້ໄຂຂໍ້ມູນ E-mail ພະແນກສຳເລັດ';
 }
 $output = array(
  'success'  => $success,
  'error'   => $error
 );
 echo json_encode($output);
}

?>
