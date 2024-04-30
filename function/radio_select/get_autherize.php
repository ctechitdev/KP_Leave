<script>
	$(function() {

		$('#dpr_id').change(function() {
			var dp_id = $('#dpr_id').val();
			$.post('function/dynamic_dropdown/get_unit_name.php', {
					dp_id: dp_id
				},
				function(output) {
					$('#unitr_id').html(output).show();
				});
		});

		$('#unitr_id').change(function() {
			var unit_id = $('#unitr_id').val();
			$.post('function/dynamic_dropdown/get_position_name.php', {
					unit_id: unit_id
				},
				function(output) {
					$('#posr_id').html(output).show();
				});
		});


		$('#posr_id').change(function() {
			var pos_id = $('#posr_id').val();
			$.post('function/dynamic_dropdown/get_staff_name.php', {
					pos_id: pos_id
				},
				function(output) {
					$('#staffr_ct').html(output).show();
				});
		});


		$('#dp_id').change(function() {
			var dp_id = $('#dp_id').val();
			$.post('function/dynamic_dropdown/get_unit_name.php', {
					dp_id: dp_id
				},
				function(output) {
					$('#unit_id').html(output).show();
				});
		});

		$('#unit_id').change(function() {
			var unit_id = $('#unit_id').val();
			$.post('function/dynamic_dropdown/get_position_name.php', {
					unit_id: unit_id
				},
				function(output) {
					$('#pos_id').html(output).show();
				});
		});


		$('#pos_id').change(function() {
			var pos_id = $('#pos_id').val();
			$.post('function/dynamic_dropdown/get_staff_name.php', {
					pos_id: pos_id
				},
				function(output) {
					$('#staff_ct').html(output).show();
				});
		});


		$('#dp_id2').change(function() {
			var dp_id = $('#dp_id2').val();
			$.post('function/dynamic_dropdown/get_unit_name.php', {
					dp_id: dp_id
				},
				function(output) {
					$('#unit_id2').html(output).show();
				});
		});

		$('#unit_id2').change(function() {
			var unit_id = $('#unit_id2').val();
			$.post('function/dynamic_dropdown/get_position_name.php', {
					unit_id: unit_id
				},
				function(output) {
					$('#pos_id2').html(output).show();
				});
		});


		$('#pos_id2').change(function() {
			var pos_id = $('#pos_id2').val();
			$.post('function/dynamic_dropdown/get_staff_name.php', {
					pos_id: pos_id
				},
				function(output) {
					$('#staff_ct2').html(output).show();
				});
		});


	});
</script>


<?php
//insert.php  
include "../database_connection.php";


$leave_type = $_POST['rdLeaveType'];

if ($leave_type == "1") {




?>



	<div class="card">
		<div class="card-block">

			<div class="form-group col-md-12">
				<h1 class="card-title text-center"> ພະນັກງານຜູ້ຂໍ </h2>
			</div>

			<div class="form-body">
				<div class="row p-t-20">


					<div class="form-group col-md-3">
						<label for="inputEmail"> ພະແນກ/ໜ່ວຍງານ </label>
						<select class="form-control font" name="dpr_id" id="dpr_id">
							<option value="0"> ເລືອກພະແນກ </option>
							<?php
							$stmt = $connect->prepare(" SELECT depart_id,depart_name FROM tbl_depart ");
							$stmt->execute();
							if ($stmt->rowCount() > 0) {
								while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							?> <option value="<?php echo $row['depart_id']; ?>"> <?php echo $row['depart_name']; ?></option>
							<?php
								}
							}
							?>
						</select>
					</div>



					<div class="form-group col-md-3">
						<label for="inputEmail"> ຝ່າຍ </label>

						<select class="form-control font" name="unitr_id" id="unitr_id">
							<option value=""> ເລືອກ ຝ່າຍ </option>
						</select>
					</div>

					<div class="form-group col-md-3">
						<label for="inputEmail"> ຕຳແໜ່ງ </label>

						<select class="form-control font" name="posr_id" id="posr_id">
							<option value=""> ເລືອກ ຕຳແໜ່ງ </option>
						</select>
					</div>

					<div class="form-group col-md-3">
						<label for="inputEmail"> ພະນັກງານ </label>

						<select class="form-control font" name="staffr_ct" id="staffr_ct">
							<option value=""> ເລືອກ ພະນັກງານ </option>
						</select>
					</div>

				</div>



			</div>

			<div class="form-group col-md-12">
				<h1 class="card-title text-center"> ຜູ້ຈັດການ </h2>
			</div>

			<div class="form-body">
				<div class="row p-t-20">


					<div class="form-group col-md-3">
						<label for="inputEmail"> ພະແນກ/ໜ່ວຍງານ </label>
						<select class="form-control font" name="dp_id" id="dp_id">
							<option value="0"> ເລືອກພະແນກ </option>
							<?php
							$stmt = $connect->prepare(" SELECT depart_id,depart_name FROM tbl_depart ");
							$stmt->execute();
							if ($stmt->rowCount() > 0) {
								while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							?> <option value="<?php echo $row['depart_id']; ?>"> <?php echo $row['depart_name']; ?></option>
							<?php
								}
							}
							?>
						</select>
					</div>



					<div class="form-group col-md-3">
						<label for="inputEmail"> ຝ່າຍ </label>

						<select class="form-control font" name="unit_id" id="unit_id">
							<option value=""> ເລືອກ ຝ່າຍ </option>
						</select>
					</div>

					<div class="form-group col-md-3">
						<label for="inputEmail"> ຕຳແໜ່ງ </label>

						<select class="form-control font" name="pos_id" id="pos_id">
							<option value=""> ເລືອກ ຕຳແໜ່ງ </option>
						</select>
					</div>

					<div class="form-group col-md-3">
						<label for="inputEmail"> ພະນັກງານ </label>

						<select class="form-control font" name="staff_ct" id="staff_ct">
							<option value=""> ເລືອກ ພະນັກງານ </option>
						</select>
					</div>

				</div>



			</div>
		</div>
	</div>


<?php
} else if ($leave_type == "2") {




?>

	<div class="card">
		<div class="card-block">
			<div class="form-group col-md-12">
				<h1 class="card-title text-center"> ພະນັກງານຜູ້ຂໍ </h2>
			</div>

			<div class="form-body">
				<div class="row p-t-20">


					<div class="form-group col-md-3">
						<label for="inputEmail"> ພະແນກ/ໜ່ວຍງານ </label>
						<select class="form-control font" name="dpr_id" id="dpr_id">
							<option value="0"> ເລືອກພະແນກ </option>
							<?php
							$stmt = $connect->prepare(" SELECT depart_id,depart_name FROM tbl_depart ");
							$stmt->execute();
							if ($stmt->rowCount() > 0) {
								while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							?> <option value="<?php echo $row['depart_id']; ?>"> <?php echo $row['depart_name']; ?></option>
							<?php
								}
							}
							?>
						</select>
					</div>



					<div class="form-group col-md-3">
						<label for="inputEmail"> ຝ່າຍ </label>

						<select class="form-control font" name="unitr_id" id="unitr_id">
							<option value=""> ເລືອກ ຝ່າຍ </option>
						</select>
					</div>

					<div class="form-group col-md-3">
						<label for="inputEmail"> ຕຳແໜ່ງ </label>

						<select class="form-control font" name="posr_id" id="posr_id">
							<option value=""> ເລືອກ ຕຳແໜ່ງ </option>
						</select>
					</div>

					<div class="form-group col-md-3">
						<label for="inputEmail"> ພະນັກງານ </label>

						<select class="form-control font" name="staffr_ct" id="staffr_ct">
							<option value=""> ເລືອກ ພະນັກງານ </option>
						</select>
					</div>

				</div>



			</div>

			<div class="form-group col-md-12">
				<h1 class="card-title text-center"> ຮອງປະທານ/ຜູ້ບໍລິຫານ </h2>
			</div>

			<div class="form-body">
				<div class="row p-t-20">


					<div class="form-group col-md-3">
						<label for="inputEmail"> ພະແນກ/ໜ່ວຍງານ </label>
						<select class="form-control font" name="dp_id2" id="dp_id2">
							<option value="0"> ເລືອກພະແນກ </option>
							<?php
							$stmt = $connect->prepare(" SELECT depart_id,depart_name FROM tbl_depart ");
							$stmt->execute();
							if ($stmt->rowCount() > 0) {
								while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							?> <option value="<?php echo $row['depart_id']; ?>"> <?php echo $row['depart_name']; ?></option>
							<?php
								}
							}
							?>
						</select>
					</div>

					<div class="form-group col-md-3">
						<label for="inputEmail"> ຝ່າຍ </label>

						<select class="form-control font" name="unit_id2" id="unit_id2">
							<option value=""> ເລືອກ ຝ່າຍ </option>
						</select>
					</div>

					<div class="form-group col-md-3">
						<label for="inputEmail"> ຕຳແໜ່ງ </label>

						<select class="form-control font" name="pos_id2" id="pos_id2">
							<option value=""> ເລືອກ ຕຳແໜ່ງ </option>
						</select>
					</div>

					<div class="form-group col-md-3">
						<label for="inputEmail"> ພະນັກງານ </label>

						<select class="form-control font" name="staff_ct2" id="staff_ct2">
							<option value=""> ເລືອກ ພະນັກງານ </option>
						</select>
					</div>

				</div>



			</div>
		</div>
	</div>


<?php
} else {
?>


	<div class="card">
		<div class="card-block">

			<div class="form-group col-md-12">
				<h1 class="card-title text-center"> ພະນັກງານຜູ້ຂໍ </h2>
			</div>

			<div class="form-body">
				<div class="row p-t-20">


					<div class="form-group col-md-3">
						<label for="inputEmail"> ພະແນກ/ໜ່ວຍງານ </label>
						<select class="form-control font" name="dpr_id" id="dpr_id">
							<option value="0"> ເລືອກພະແນກ </option>
							<?php
							$stmt = $connect->prepare(" SELECT depart_id,depart_name FROM tbl_depart ");
							$stmt->execute();
							if ($stmt->rowCount() > 0) {
								while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							?> <option value="<?php echo $row['depart_id']; ?>"> <?php echo $row['depart_name']; ?></option>
							<?php
								}
							}
							?>
						</select>
					</div>



					<div class="form-group col-md-3">
						<label for="inputEmail"> ຝ່າຍ </label>

						<select class="form-control font" name="unitr_id" id="unitr_id">
							<option value=""> ເລືອກ ຝ່າຍ </option>
						</select>
					</div>

					<div class="form-group col-md-3">
						<label for="inputEmail"> ຕຳແໜ່ງ </label>

						<select class="form-control font" name="posr_id" id="posr_id">
							<option value=""> ເລືອກ ຕຳແໜ່ງ </option>
						</select>
					</div>

					<div class="form-group col-md-3">
						<label for="inputEmail"> ພະນັກງານ </label>

						<select class="form-control font" name="staffr_ct" id="staffr_ct">
							<option value=""> ເລືອກ ພະນັກງານ </option>
						</select>
					</div>

				</div>



			</div>

			<div class="form-body">
				<div class="row p-t-20">

					<div class="form-group col-md-12">
						<h1 class="card-title text-center"> ຜູ້ຈັດການ </h1>
					</div>

					<div class="form-group col-md-3">
						<label for="inputEmail"> ພະແນກ/ໜ່ວຍງານ </label>
						<select class="form-control font" name="dp_id" id="dp_id">
							<option value="0"> ເລືອກພະແນກ </option>
							<?php
							$stmt = $connect->prepare(" SELECT depart_id,depart_name FROM tbl_depart ");
							$stmt->execute();
							if ($stmt->rowCount() > 0) {
								while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							?> <option value="<?php echo $row['depart_id']; ?>"> <?php echo $row['depart_name']; ?></option>
							<?php
								}
							}
							?>
						</select>
					</div>



					<div class="form-group col-md-3">
						<label for="inputEmail"> ຝ່າຍ </label>

						<select class="form-control font" name="unit_id" id="unit_id">
							<option value=""> ເລືອກ ຝ່າຍ </option>
						</select>
					</div>

					<div class="form-group col-md-3">
						<label for="inputEmail"> ຕຳແໜ່ງ </label>

						<select class="form-control font" name="pos_id" id="pos_id">
							<option value=""> ເລືອກ ຕຳແໜ່ງ </option>
						</select>
					</div>

					<div class="form-group col-md-3">
						<label for="inputEmail"> ພະນັກງານ </label>

						<select class="form-control font" name="staff_ct" id="staff_ct">
							<option value=""> ເລືອກ ພະນັກງານ </option>
						</select>
					</div>


					<div class="form-group col-md-12">
						<h1 class="card-title text-center"> ຮອງປະທານ/ຜູ້ບໍລິຫານ </h1>
					</div>



					<div class="form-group col-md-3">
						<label for="inputEmail"> ພະແນກ/ໜ່ວຍງານ </label>
						<select class="form-control font" name="dp_id2" id="dp_id2">
							<option value="0"> ເລືອກພະແນກ </option>
							<?php
							$stmt = $connect->prepare(" SELECT depart_id,depart_name FROM tbl_depart ");
							$stmt->execute();
							if ($stmt->rowCount() > 0) {
								while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							?> <option value="<?php echo $row['depart_id']; ?>"> <?php echo $row['depart_name']; ?></option>
							<?php
								}
							}
							?>
						</select>
					</div>

					<div class="form-group col-md-3">
						<label for="inputEmail"> ຝ່າຍ </label>

						<select class="form-control font" name="unit_id2" id="unit_id2">
							<option value=""> ເລືອກ ຝ່າຍ </option>
						</select>
					</div>

					<div class="form-group col-md-3">
						<label for="inputEmail"> ຕຳແໜ່ງ </label>

						<select class="form-control font" name="pos_id2" id="pos_id2">
							<option value=""> ເລືອກ ຕຳແໜ່ງ </option>
						</select>
					</div>

					<div class="form-group col-md-3">
						<label for="inputEmail"> ພະນັກງານ </label>

						<select class="form-control font" name="staff_ct2" id="staff_ct2">
							<option value=""> ເລືອກ ພະນັກງານ </option>
						</select>
					</div>



				</div>



			</div>
		</div>
	</div>







<?php
}


?>
<script src='js/jquery.dateFormat.js'></script>
<script src="js/date_picker.js"></script>
<script type="text/javascript">
	$('.clockpicker').clockpicker()
		.find('input').change(function() {
			console.log(this.value);
		});
	var input = $('#single-input').clockpicker({
		placement: 'bottom',
		align: 'left',
		autoclose: true,
		'default': 'now'
	});
</script>