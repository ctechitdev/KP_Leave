<?php

//update_data.php

include('../database_connection.php');

if(isset($_POST["plevel"]))
{
 $error = '';
 $success = '';
 $lvpost = ''; 
 
 if(empty($_POST["plevel"]))
 {
  $error .= '<p>ເລືອກລະດັບ</p>';
 }
 else
 {
  $lvpost = $_POST["plevel"];
 } 
  

  
 if($error == '')
 {
  $data = array(
   ':lvp'   => $lvpost, 
   ':id'   => $_POST['rlv_id']
  );

  $query = "
  UPDATE tbl_role_level 
  SET role_level = :lvp
  WHERE rlv_id = :id
  ";
  $statement = $connect->prepare($query);
  $statement->execute($data);
  $success = 'ຂໍ້ມູນລະດັບຖືກແກ້ໄຂ';
 }
 $output = array(
  'success'  => $success,
  'error'   => $error
 );
 echo json_encode($output);
}

?>
