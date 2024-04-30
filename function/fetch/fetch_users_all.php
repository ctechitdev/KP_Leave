<?php
 
include('../database_connection.php');
$query = '';
$output = array();
$query .= " select * from users_info ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE full_name LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY user_ids DESC ';
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
 

$sub_array[] = $row["full_name"];
$sub_array[] = $row["user_names"];
$sub_array[] = $row["depart_name"];  
$sub_array[] = $row["position_name"];
//$sub_array[] = $row["user_status"];
 
 $check_register =  $row["user_names"];
 
 if(empty($check_register)){
	 $sub_array[] = '<button type="button" name="regis" ri="'.$row["staff_id"].'" class="btn btn-warning btn-sm regis"> ລົງທະບຽນ </button>';
 }else{
	 $sub_array[] = '<button type="button" name="regis" none="" class="btn btn-success btn-sm none"> ສ້າງສຳເລັດ </button>';
 }
 
 $sub_array[] = '<button type="button" name="reset" ei="'.$row["user_ids"].'" class="btn btn-info btn-sm reset"> ປ່ຽນລະຫັດ </button>';
 $sub_array[] = '<button type="button" name="disable" di="'.$row["user_ids"].'" class="btn btn-danger btn-sm disable"> ປິດນຳໃຊ້ </button>';
 $data[] = $sub_array;
}

function get_total_all_records($connect)
{
 $statement = $connect->prepare("select * from users_info ");
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