


<?php

//fetch_single_data.php

include('../database_connection.php');

if(isset($_POST["ri"]))
{
 $query = "  SELECT depart_name,unit_name,position_name,a.ps_id as ps_id,rlv_id,role_level
FROM  tbl_position a
left join tbl_depart_unit b on a.unit_id = b.unit_id
left join tbl_depart c on a.depart_id = c.depart_id
left join tbl_role_level d on a.ps_id = d.ps_id 
 WHERE a.ps_id = '".$_POST["ri"]."' ";
 $statement = $connect->prepare($query);
 $statement->execute();
 while($row = $statement->fetch(PDO::FETCH_ASSOC))
 {
  $data[] = $row;
 }
 echo json_encode($data);
}

?>