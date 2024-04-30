<?php

 
include('../database_connection.php');
$query = '';
$output = array();
$query .= "SELECT * FROM tbl_depart ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE depart_id LIKE "%'.$_POST["search"]["value"].'%" OR depart_name LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY depart_id DESC ';
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
 $sub_array[] = '<button type="button" name="update" ei="'.$row["depart_id"].'" class="btn btn-info btn-sm update">ແກ້ໄຂ</button>';
 $sub_array[] = '<button type="button" name="delete" di="'.$row["depart_id"].'" class="btn btn-danger btn-sm delete">ລຶບ</button>';
 $data[] = $sub_array;
}

function get_total_all_records($connect)
{
 $statement = $connect->prepare("SELECT * FROM tbl_depart");
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