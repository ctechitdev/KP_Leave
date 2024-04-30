<?php
include "checksession.php";
include "function/database_connection.php";



$message_request = $_SESSION["message_request"];


if (!empty($message_request)) {
	$show_modal = 1;
}

if (isset($_POST['btninsert'])) {



	$leave_type = $_POST['leave_type'];
	$approver_id = $_POST['approver_id'];

	$reason_leave = $_POST['reason_leave'];
	$date_request = date("Y-m-d");

	$rdLeaveType = $_POST['rdLeaveType'];



	//product picture
	$main_imgFile = $_FILES['main_image']['name'];
	$main_tmp_dir = $_FILES['main_image']['tmp_name'];
	$main_imgSize = $_FILES['main_image']['size'];
	// end 

	$stmt_approve_level = $connect->prepare(" SELECT level_ap FROM  tbl_set_approval where rq_by = '$staff_id' and ap_by = '$approver_id' ");

	$stmt_approve_level->execute();
	while ($row_apl = $stmt_approve_level->fetch(PDO::FETCH_ASSOC)) {
		extract($row_apl);
		$level_doc = $row_apl['level_ap'];
	}







	$upload_main_dir = 'attach_pic/'; // upload directory



	if ($main_imgFile == '') {
		$main_pic = null;
	} else {

		$main_imgExt = strtolower(pathinfo($main_imgFile, PATHINFO_EXTENSION)); // get image extension

		// valid image extensions
		$main_valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

		// rename uploading image

		$stmt = $connect->prepare(' SELECT (count(attatch_file))+1  as numpic FROM  tbl_leave_request ');
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$mainnum = $row['numpic'];
		}

		if (empty($mainnum)) {
			$mainnum = 1;
		}

		$main_pic =  $mainnum . "." . $main_imgExt;
		move_uploaded_file($main_tmp_dir, $upload_main_dir . $main_pic);
	}

	if (empty($rdLeaveType)) {
		$check_error  = "yes";
	}


	if ($rdLeaveType == 1) {



		// calculate date leave by select 

		$get_date_from = $_POST['date_from'];
		$from_date = str_replace('/', '-', $get_date_from);
		$date_from = date('Y-m-d', strtotime($from_date));

		$get_date_to = $_POST['date_to'];
		$to_date = str_replace('/', '-', $get_date_to);
		$date_to = date('Y-m-d', strtotime($to_date));

		if ((empty($get_date_from)) || (empty($get_date_to))) {
			$check_error  = "yes";
		}


		$stmt_date = $connect->prepare(" select count(hd_date) as val_date from all_holiday where hd_date between '$date_from' and '$date_to' ");

		$stmt_date->execute();
		while ($row_cal_date = $stmt_date->fetch(PDO::FETCH_ASSOC)) {
			extract($row_cal_date);
			$val_date = $row_cal_date['val_date'];
		}

		$date_start = strtotime("$date_from");
		$date_end = strtotime("$date_to");
		$datediff =    $date_end - $date_start;
		$day_leave =  round($datediff / (60 * 60 * 24));

		$cal_day_leave = ($day_leave + 1) - $val_date;
		// end 

		$leave_day = $cal_day_leave;
		$leave_hour = 0;
		$leave_minus = 0;

		$hour_from = "08:00:00";
		$hour_to = "17:00:00";
	}





	if ($rdLeaveType == 2) {

		$hour_from = $_POST['hour_from'];

		$hour_to = $_POST['hour_to'];

		$get_date_leave = $_POST['date_leave'];
		$leave_date = str_replace('/', '-', $get_date_leave);
		$date_leave = date('Y-m-d', strtotime($leave_date));

		if ((empty($get_date_leave)) || (empty($hour_from))  || (empty($hour_to))) {
			$check_error  = "yes";
		}


		$time_start = new DateTime($hour_from, new DateTimeZone('Pacific/Nauru'));
		$time_end = new DateTime($hour_to, new DateTimeZone('Pacific/Nauru'));


		$start_breake_time = new DateTime("12:00:00", new DateTimeZone('Pacific/Nauru'));
		$end_breake_time = new DateTime("13:00:00", new DateTimeZone('Pacific/Nauru'));

		$interval = $time_start->diff($time_end);
		$hours   = $interval->format('%h');
		$minutes = $interval->format('%i');


		if ($time_start <= $start_breake_time && $time_end >= $end_breake_time) {
			$cal_hour = $hours - 1;
		} else {
			$cal_hour = $hours;
		}

		$cal_time = ($cal_hour * 60 + $minutes);

		$time_hour = $cal_time / 60;

		$show_hour =   intval($time_hour);

		if ($time_end >= $start_breake_time && $time_end <= $end_breake_time) {
			$decimal_hour = 0;
		} else {
			$decimal_hour = number_format(($time_hour - $show_hour) * 60);
		}


		if ($decimal_hour >= 1 && $decimal_hour <= 30) {
			$decimal_hour = 30;
			$round_hour = $show_hour;
		} else if ($decimal_hour >= 31 && $decimal_hour <= 59) {
			$decimal_hour = 0;
			$round_hour = $show_hour + 1;
		} else {
			$round_hour = $show_hour;
		}




		$leave_day = 0;

		$leave_hour = $round_hour;
		$leave_minus = $decimal_hour;

		if ($leave_hour >= 8 && $leave_minus >= 1) {
			$leave_hour = 8;
			$leave_minus = 0;
		} else if ($leave_hour > 8) {
			$leave_hour = 8;
			$leave_minus = 0;
		}

		$date_from = $date_leave;
		$date_to = $date_leave;

		$hour_from = $_POST['hour_from'];
		$hour_to = $_POST['hour_to'];
	}


	if ($check_error != "yes") {

		if ($leave_type == "11") {
			$leave_day = 0;
			$leave_hour = 0;
			$leave_minus = 0;
		}


		$stmt = $connect->prepare('INSERT INTO tbl_leave_request (user_ids,depart_id,leave_type,date_leave,hours_leave,minus_leave,date_from,time_from,date_to,time_to,reason,attatch_file,date_request  )
		VALUES(:uid, :dp, :ltype, :lday, :lhour,:lminus, :dfrom, :hfrom, :dto, :hto, :rleave,:pname, :drl )');
		$stmt->bindParam(':uid', $user_ids);
		$stmt->bindParam(':dp', $staff_depart);
		$stmt->bindParam(':ltype', $leave_type);
		$stmt->bindParam(':lday', $leave_day);
		$stmt->bindParam(':lhour', $leave_hour);
		$stmt->bindParam(':lminus', $leave_minus);
		$stmt->bindParam(':dfrom', $date_from);
		$stmt->bindParam(':hfrom', $hour_from);
		$stmt->bindParam(':dto', $date_to);
		$stmt->bindParam(':hto', $hour_to);
		$stmt->bindParam(':rleave', $reason_leave);
		$stmt->bindParam(':pname', $main_pic);
		$stmt->bindParam(':drl', $date_request);

		if ($stmt->execute()) {

 

			$max_lr_id = $connect->lastInsertId();


			$stmt3 = $connect->prepare('INSERT INTO tbl_approval (lr_id,approve_status,approve_by,approve_level,approve_date )
		VALUES(:maxlr, 0, :apid, :lvdoc, :drl )');
			$stmt3->bindParam(':maxlr', $max_lr_id);
			$stmt3->bindParam(':apid', $approver_id);
			$stmt3->bindParam(':lvdoc', $level_doc);
			$stmt3->bindParam(':drl', $date_request);
			$stmt3->execute();


			$stmt2 = $connect->prepare(" select lr_id,Full_name,reason,leave_name,start_date,to_date,app_email,depart_name,position_name,line_token,depart_email
			from pre_email_leave_id 
			where user_ids = '$user_ids'  and lr_id = '$max_lr_id'");

			$stmt2->execute();
			while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
				extract($row2);
				$lr_id = $row2['lr_id'];
				$Full_name = $row2['Full_name'];
				$reason = $row2['reason'];
				$leave_name = $row2['leave_name'];
				$start_date = $row2['start_date'];
				$to_date = $row2['to_date'];
				$app_email = $row2['app_email'];
				$depart_name = $row2['depart_name'];
				$position_name = $row2['position_name'];
				$line_token = $row2['line_token']; 
			}
		}


		$_SESSION['request_id'] = $lr_id;
		$_SESSION['Full_name'] = $Full_name;
		$_SESSION['reason'] = $reason;
		$_SESSION['leave_name'] = $leave_name;
		$_SESSION['start_date'] = $start_date;
		$_SESSION['to_date'] = $to_date;
		$_SESSION['app_email'] = $app_email;
		$_SESSION['depart_name'] = $depart_name;
		$_SESSION['position_name'] = $position_name;
		$_SESSION['line_token'] = $line_token; 


		header("location:request_send.php");
	} else {
		$show_modal = 2;
	}
}


?>

<!DOCTYPE html>
<html lang="en">




<head>





</head>



<?php


include "stylesheet.php";



?>

<body class="fix-header fix-sidebar card-no-border">

	<div id="main-wrapper">
		<?php
		include "header.php";
		include "menu.php";
		?>

		<div class="page-wrapper">
			<!-- Container fluid  -->
			<div class="container-fluid">
				<div class="row" id="row">
					<div class="col-12">
						<div class="card">
							<div class="card-block">

								<form class="m-t-40" novalidate action="" method="post" enctype="multipart/form-data" autocomplete="off">

									<?php
									//  echo " $status_user";

									$query = $connect->prepare(" select * from profile_leave_view WHERE user_ids = :user_ids   ");
									$query->execute(
										array(
											'user_ids'     =>     $user_ids
										)
									);
									$row = $query->fetch();
									$status_user = $row['user_ids'];
									$staff_gender = $row['staff_gender'];
									$staff_first_name = $row['staff_first_name'];
									$staff_last_name = $row['staff_last_name'];
									$staff_code = $row['staff_code'];
									$staff_position = $row['staff_position'];
									$select_staff_depart = $row['staff_depart'];
									$staff_unit = $row['staff_unit'];

									?>

									<div class="form-body">
										<div class="row p-t-20" id="result">

											<div class="form-group col-md-3">
												<img src="images/kpicon.png" class="img-rounded" width="43%" height="100%">

											</div>

											<div class="form-group col-md-6">
												<h1 class="card-title text-center"> ໃບລາພັກ </h2>
											</div>

											<div class="form-group col-md-6">
												<label for="inputEmail"> ຊື່ພະນັກງານ : </label> <label for="inputEmail"> <?php echo "$staff_gender $staff_first_name $staff_last_name"; ?> </label>
											</div>

											<div class="form-group col-md-6">
												<label for="inputEmail"> ລະຫັດພະນັກງານ : </label> <label for="inputEmail"> <?php echo "$staff_code  "; ?> </label>
											</div>

											<div class="form-group col-md-4">
												<label for="inputEmail"> ຕຳແໜ່ງ : </label> <label for="inputEmail"> <?php echo "$staff_position  "; ?> </label>
											</div>
											<div class="form-group col-md-4">
												<label for="inputEmail"> ພະແນກ/ໜ່ວຍງານ : </label> <label for="inputEmail"> <?php echo "$select_staff_depart  "; ?> </label>
											</div>
											<div class="form-group col-md-4">
												<label for="inputEmail"> ຝ່າຍ : </label> <label for="inputEmail"> <?php echo "$staff_unit  "; ?> </label>
											</div>

											<?php
											//debug echo" $role_level";

											if ($role_level > 2) {
												$syntax_query = "     where role_level > 3 and staff_depart in('$staff_depart','14')  and staff_id != $staff_id  ";
											} else {
												if ($staff_depart == 7 && $role_level == 2) {
													$syntax_query = " where role_level = 3 and staff_depart in ('$staff_depart','2') and staff_id != $staff_id ";
												} else {
													$syntax_query = " where role_level != 1 and staff_depart = '$staff_depart' and staff_id != $staff_id ";
												}
											}

											?>


											<div class="form-group col-md-4">
												<label for="inputEmail"> ຜູ້ອະນຸມັດ </label>
												<select class="form-control font" name="approver_id" id="approver_id" required>
													<option value=""> ເລືອກ ຜູ້ອະນຸມັດ </option>
													<?php
													$stmt = $connect->prepare(" SELECT staff_id,CONCAT( staff_first_name, ' ', staff_last_name) AS FULL_NAME   from tbl_set_approval a
											left join tbl_staff b on a.ap_by = b.staff_id 
											where rq_by = $staff_id and ap_by != '$staff_id'
											");
													$stmt->execute();
													if ($stmt->rowCount() > 0) {
														while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
													?> <option value="<?php echo $row['staff_id']; ?>"> <?php echo $row['FULL_NAME']; ?></option>
													<?php
														}
													}
													?>
												</select>
											</div>

											<div class="form-group col-md-9">

											</div>

											<div class="form-group col-md-6">
												<label for="inputEmail"> ປະເພດລາພັກ </label>

												<select name="leave_type" required="" class="form-control font" aria-invalid="false">
													<option value=""> ເລືອກປະເພດລາພັກ </option>
													<?php
													$stmt = $connect->prepare("SELECT lt_id,leave_name FROM tbl_leave_type");
													$stmt->execute();
													if ($stmt->rowCount() > 0) {
														while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
													?> <option value="<?php echo $row['lt_id']; ?>"> <?php echo $row['leave_name']; ?></option>
													<?php
														}
													}
													?>
												</select>
											</div>

											<div class="col-md-5">
											</div>



											<div class="col-md-3">
												<div class="form-group">
													<label class="control-label"> ລາພັກແບບ <span class="text-danger">*</span></label><br>


													<input type="radio" name="rdLeaveType" id="rdLeaveType" value="1"> ແບບມື້
													<input type="radio" name="rdLeaveType" id="rdLeaveType" value="2"> ແບບຊົ່ວໂມງ

												</div>
											</div>

											<div class="col-md-9" id="result2">
												<div class="form-group">


												</div>
											</div>



											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label"> ເຫດຜົນ </label>
													<div class="controls">
														<input type="text" name="reason_leave" class="form-control font" value="" required>
													</div>
												</div>
											</div>










											<div class="form-group   col-md-3">
												<label for="inputEmail"> ຫຼັກຖານການລາ </label>
												<input class="input-group" type="file" name="main_image" accept="image/*" />
											</div>

											<div class="form-group   col-md-6">
											</div>


											<div class="form-group   col-md-3 text-center">
												<label for="inputEmail"> FM-GA-HR CB-01-08 </label> <br>
												<label for="inputEmail"> 19/07/17-00 </label>
											</div>

										</div>

										<div class=" text-center">
											<button type="submit" name="btninsert" class="btn btn-success font"> <i class="fa fa-check"></i> ຂໍລາພັກ </button>
											<button type="reset" class="btn btn-danger font"><i class="mdi mdi-close-outline"></i> ຍົກເລີກ </button>
										</div>

									</div>
							</div>
						</div>

						</form>




					</div>
					<div class="text-center" align="center">


					</div>
				</div>



			</div>

			<div class="container-fluid">
				<div class="row" id="row">
					<div class="col-12">


						<div class="card">
							<div class="card-block">

								<h4 class="card-title text-center"> ຂໍ້ມູນ ຂໍລາພັກ</h4>
								<div class="table-responsive">
									<table id='demo-foo-addrow2' class='table table-bordered table-sm table-hover toggle-circle'>

										<thead class="btn-info">
											<tr>
												<th scope="col">ເລກທີ</th>
												<th scope="col"> ຜູ່ຂໍລາພັກ </th>
												<th scope="col"> ເຫດຜົນລາ </th>
												<th scope="col"> ຈາກວັນທີ </th>
												<th scope="col"> ຫາວັນທີ </th>
												<th scope="col"> ຂໍຜ່ານທາງ </th>
											</tr>
										</thead>
										<div class='m-t-40'>
											<?php

											//  echo "$user_ids";		

											?>
											<div class='d-flex'>
												<div class='mr-auto'>
													<div class='form-group'>

													</div>
												</div>
												<div class='ml-auto'>
													<div class='form-group'>

														<input id='demo-input-search2' type='text' placeholder='ຊອກຫານຂໍ້ມູນ' class='form-control font' autocomplete='off'>
													</div>
												</div>
											</div>
										</div>
										<tbody>
											<?PHP

											$stmt = $connect->prepare("
										select lr_id,a.user_ids as user_ids,reason,date_from,date_to,
										concat((case when staff_gender = 1 then 'ທ້າວ' else 'ນາງ' end), ' ',staff_first_name,' ',staff_last_name) as requester_full_name,
										'ຜ່ານລະບົບ' as rq_type
										from tbl_leave_request a
										left join tbl_user b on a.user_ids = b.user_ids
										left join tbl_staff c on b.staff_id = c.staff_id
										where a.user_ids = '$user_ids' 
										union all
										select lrd_id,a.staff_id as staff_id,reason,date_from,date_to,
										concat((case when staff_gender = 1 then 'ທ້າວ' else 'ນາງ' end), ' ',staff_first_name,' ',staff_last_name) as requester_full_name,
										'ຜ່ານເອກະສານ' as rq_type
										from tbl_leave_request_document a 
										left join tbl_staff b on a.staff_id = b.staff_id
										where a.staff_id ='$staff_id' order by  lr_id desc
										  ");

											$stmt->execute();
											if ($stmt->rowCount() > 0) {
												while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
													$lr_id = $row['lr_id'];
													$requester_full_name = $row['requester_full_name'];
													$reason = $row['reason'];
													$date_from = $row['date_from'];
													$date_to = $row['date_to'];
													$rq_type = $row['rq_type'];

											?>

													<tr>
														<td><?php echo "$lr_id"; ?></td>
														<td><?php echo "$requester_full_name"; ?></td>
														<td><?php echo "$reason"; ?></td>
														<td><?php echo "$date_from"; ?></td>
														<td><?php echo "$date_to"; ?></td>
														<td><?php echo "$rq_type"; ?></td>


														</td>

													</tr>

											<?php

												}
											}

											?>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="7">
													<div class="text-right">
														<ul class="pagination">
														</ul>
													</div>
												</td>
											</tr>
										</tfoot>
									</table>
								</div>





							</div>
						</div>
					</div>
				</div>
			</div>

		</div>


	</div>





	</div>
	<!-- /row -->
	</div>
	<?php include "footer.php"; ?>
	<!-- End footer -->
	</div>
	</div>
	<?php
	if ($show_modal != "") {



	?>
		<script>
			$(document).ready(function() {
				$("#myModal").modal('show');
			});
		</script>
	<?php

	}

	?>

	<div id="myModal" class="modal fade ">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<?php
					if ($show_modal == 1) {
					?>
						<h3 class="modal-title" style="color: green"> ການລົງທະບຽນ ຂໍລາພັກ ສຳເລັດ </h3>
					<?php
					} else {
					?>
						<h3 class="modal-title" style="color: red"> ຂໍ້ມູນບໍ່ຄົບຖ້ວນ </h3>
					<?php
					}

					$show_modal = "";
					$message_request = "";
					$_SESSION['message_request'] = "";

					?>

					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

			</div>
		</div>

		<script>
			$(document).ready(function() {
				$('input[type="radio"]').click(function() {
					var rdLeaveType = $(this).val();
					$.ajax({
						url: "function/radio_select/get_date_time_leave.php",
						method: "POST",
						data: {
							rdLeaveType: rdLeaveType
						},
						success: function(data) {
							$('#result2').html(data);
						}
					});
				});
			});
		</script>






		<?php include "javascript.php"; ?>
</body>

</html>