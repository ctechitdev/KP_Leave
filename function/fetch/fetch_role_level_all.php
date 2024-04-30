<?php
 
include('../database_connection.php');
$query = '';
$output = array();
$query .= " SELECT depart_name,unit_name,position_name,a.ps_id as ps_id,rlv_id,role_level
FROM  tbl_position a
left join tbl_depart_unit b on a.unit_id = b.unit_id
left join tbl_depart c on a.depart_id = c.depart_id
left join tbl_role_level d on a.ps_id = d.ps_id ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE position_name LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY depart_name DESC ';
}
if($_POST["length"] != -1)
{
 $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
 $sub_array = array();
 

$sub_array[] = $row["depart_name"];
$sub_array[] = $row["unit_name"];
$sub_array[] = $row["position_name"];  
$sub_array[] = $row["role_level"];
 
 $check_register =  $row["rlv_id"];
 
 if(empty($check_register)){
	 $sub_array[] = '<button type="button" name="regis" ri="'.$row["ps_id"].'" class="btn btn-warning btn-sm regis"> ລົງທະບຽນ </button>';
 }else{
	 $sub_array[] = '<button type="button" name="edit" ei="'.$row["rlv_id"].'" class="btn  btn-info  btn-sm edit"> ແກໄຂ </button>';
 }
 
  
 $sub_array[] = '<button type="button" name="delete" di="'.$row["rlv_id"].'" class="btn btn-danger btn-sm delete"> ລຶບ </button>';
 $data[] = $sub_array;
}

function get_total_all_records($connect)
{
 $statement = $connect->prepare(" SELECT depart_name,unit_name,position_name,a.ps_id as ps_id,rlv_id,role_level
FROM  tbl_position a
left join tbl_depart_unit b on a.unit_id = b.unit_id
left join tbl_depart c on a.depart_id = c.depart_id
left join tbl_role_level d on a.ps_id = d.ps_id  ");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => get_total_all_records($connect),
 "data"    => $data
);
echo json_encode($output);
?>