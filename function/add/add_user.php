<?php
 
include('../database_connection.php');

if(isset($_POST["email"]))
{
 $error = '';
 $success = '';
 $staff_email = '';  
 $date_register = date("Y-m-d");
 
 if(empty($_POST["email"]))
 {
  $error .= '<p> ຕື່ມຂໍ້ມູນ E-Mail </p>';
 }
 else
 {
  $staff_email = $_POST["email"];
 }
  
 $query2 = "  select * from tbl_user where User_names = '$staff_email' ";
 $statement2 = $connect->prepare($query2);
 $statement2->execute();
 while($row2 = $statement2->fetch(PDO::FETCH_ASSOC))
 {
  $userid = $row2['User_names'];
 
 }
 
 if(!empty($userid)){
	   $error .= "<p> email $staff_email ລົງທະບຽນແລ້ວ </p>";
 }
   
 if($error == '')
 {
  $data = array(
   ':semail'   => $staff_email,  
   ':dregis'   => $date_register,
   ':id'   => $_POST["s_id"]
  );
 
  $query = " 
  insert into tbl_user (User_names,user_password,staff_id,user_status,user_create_date) 
  values (:semail, 123 , :id , 0 , :dregis ) 
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
