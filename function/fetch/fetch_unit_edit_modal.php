<?php

//fetch_single_data.php

include('../database_connection.php');

if(isset($_POST["ei"]))
{
 $query = " SELECT unit_id,depart_name,unit_name,a.depart_id as depart_id 
 FROM tbl_depart_unit a left join tbl_depart b on a.depart_id = b.depart_id  
 WHERE unit_id = '".$_POST["ei"]."' ";
 $statement = $connect->prepare($query);
 $statement->execute();
 while($row = $statement->fetch(PDO::FETCH_ASSOC))
 {
  $data[] = $row;
 }
 echo json_encode($data);
}

?>