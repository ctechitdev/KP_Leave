<?php

 
include('../database_connection.php');
$query = '';
$output = array();
$query .= " SELECT staff_id,staff_code,
concat(gender_name,' ', staff_first_name,' ',staff_last_name) as full_name,
staff_gender,  
depart_name,staff_unit,unit_name,staff_position,position_name
 FROM staff_info_view ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE staff_first_name LIKE "%'.$_POST["search"]["value"].'%" OR staff_last_name LIKE "%'.$_POST["search"]["value"].'%" OR staff_code LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY staff_id DESC ';
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
 
$sub_array[] = $row["staff_code"]; 
$sub_array[] = $row["full_name"]; 
$sub_array[] = $row["position_name"]; 
$sub_array[] = $row["depart_name"];
$sub_array[] = $row["unit_name"];

 
 
$sub_array[] = '<button type="button" name="update" ei="'.$row["staff_id"].'" class="btn btn-info btn-sm update">ແກ້ໄຂ</button>';
$sub_array[] = '<button type="button" name="delete" di="'.$row["staff_id"].'" class="btn btn-danger btn-sm delete">ລຶບ</button>';
$data[] = $sub_array;
}

function get_total_all_records($connect)
{
 $statement = $connect->prepare(" SELECT staff_id,staff_code,
concat(gender_name,' ', staff_first_name,' ',staff_last_name) as full_name,
staff_gender,  
depart_name,staff_unit,unit_name,staff_position,position_name
 FROM staff_info_view ");
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