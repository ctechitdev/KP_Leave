<?php

//fetch_single_data.php

include('../database_connection.php');

if(isset($_POST["ei"]))
{
 $query = " select rlv_id,position_name,role_level  
							from tbl_role_level a
							left join tbl_position b on a.ps_id = b.ps_id  
 WHERE rlv_id = '".$_POST["ei"]."' ";
 $statement = $connect->prepare($query);
 $statement->execute();
 while($row = $statement->fetch(PDO::FETCH_ASSOC))
 {
  $data[] = $row;
 }
 echo json_encode($data);
}

?>