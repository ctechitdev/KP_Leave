<?php

 

include('../database_connection.php');

if(isset($_POST["dp_name"]))
{
 $error = '';
 $success = '';
 $name = '';
 
 if(empty($_POST["dp_name"]))
 {
  $error .= '<p> ເພີ່ມຂໍ້ມູນລົ້ມເຫລວ ຂໍ້ມູນພະແນກວ່າງ </p>';
 }
 else
 {
  $name = $_POST["dp_name"];
 }
   

 
 if($error == '')
 {
  $data = array(
   ':name'   => $name 
  );

  $query = "
  INSERT INTO tbl_depart   (depart_name )  VALUES (:name )
  ";
  $statement = $connect->prepare($query);
  $statement->execute($data);
  $success = 'ເພີ່ມຂໍ້ມູນພະແນກ ສຳເລັດ';
 }
 $output = array(
  'success'  => $success,
  'error'   => $error
 );
 echo json_encode($output);
}

?>