<html>

<?php
 session_start();
include('../function/database_connection.php');

$staff_unit = $_SESSION["staff_unit"];
$staff_position = $_SESSION["staff_position"];
 

?>  

 	<script type="text/javascript" src="js/jquery.min.js"></script>      <!-- jQuery -->
 	<script>
		$(function(){
			
	  $('#edit_dp_id').change(function(){
			var dp_id=$('#edit_dp_id').val();
			$.post('function/dynamic_dropdown/get_unit_name.php',{
				dp_id:dp_id
			},
			function(output){
				$('#edit_unit_id').html(output).show();
			});
		});
		
		$('#edit_unit_id').change(function(){
			var unit_id=$('#edit_unit_id').val();
			$.post('function/dynamic_dropdown/get_position_name.php',{
				unit_id:unit_id
			},
			function(output){
				$('#edit_post_id').html(output).show();
			});
		});
		 
		
		
		});
	</script>
<?php
//debug
// echo"test $staff_unit <br>";
// echo"test $staff_position";

?>
	<div class="form-group">
	 <label> ລະຫັດພະນັກງານ </label>
	  <input type="text" name="cp_code" id="cp_code" class="form-control" />
	</div>
	
	
	<div class="form-group">
	<label> ເພດ </label>
	<select name="gender" id="gender" class="form-control">
	<option value="1">Male</option>
	<option value="2">Female</option>
	</select>
	</div>
	
	<div class="form-group">
	<label> ຊື່ </label>
	<input type="text" name="first_name" id="first_name" class="form-control" />
	</div>

	<div class="form-group">
	<label> ນາມສະກຸນ </label>
	<input type="text" name="last_name" id="last_name" class="form-control" />
	</div>

	<div class="form-group  ">
	<label for="inputEmail"> ຊື່ ພະແນກ/ໜ່ວຍງານ  </label>

	<select class="form-control font" name="edit_dp_id" id ="edit_dp_id">
	<option value=""> ເລືອກ ພະແນກ/ໜ່ວຍງານ </option> 
	<?php
	$stmt = $connect->prepare(" SELECT depart_id,depart_name FROM tbl_depart ");
	$stmt->execute();
	if($stmt->rowCount() > 0)
	{
	while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
	?> <option value="<?php echo $row['depart_id']; ?>"> <?php echo $row['depart_name']; ?></option> 
	<?php   
	}
	}
	?>
	</select>
	</div>

	<div class="form-group  ">
	<label for="inputEmail"> ຊື່ຝ່າຍ  </label>

	<select class="form-control font" name="edit_unit_id" id ="edit_unit_id">
	<option value=""> ເລືອກຝ່າຍ  </option> 
	<?php
	$stmt = $connect->prepare(" select unit_id, unit_name from tbl_depart_unit where unit_id = '$staff_unit' ");
	$stmt->execute();
	if($stmt->rowCount() > 0)
	{
	while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
	?> <option value="<?php echo $row['unit_id']; ?>"> <?php echo $row['unit_name']; ?></option> 
	<?php   
	}
	}
	?>
	</select>
	</div>

	<div class="form-group  ">
	<label for="inputEmail"> ຕຳແໜ່ງ  </label>

	<select class="form-control font" name="edit_post_id" id ="edit_post_id">
	<option value=""> ເລືອກຕຳແໜ່ງ </option> 
	<?php
	$stmt = $connect->prepare(" select ps_id, position_name from tbl_position where ps_id = '$staff_position' ");
	$stmt->execute();
	if($stmt->rowCount() > 0)
	{
	while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
	?> <option value="<?php echo $row['ps_id']; ?>"> <?php echo $row['position_name']; ?></option> 
	<?php   
	}
	}
	?>
	</select>
	</div>
 

  
<script>
 $(document).ready(function () {

	var get_cp = localStorage.getItem('edit_cp');
	var get_gender = localStorage.getItem('edit_gender');  	
	var get_firstt_name = localStorage.getItem('edit_first_name');  
	var get_last_name = localStorage.getItem('edit_last_name');
	var get_depart_id = localStorage.getItem('edit_depart');
	var get_unit_id = localStorage.getItem('edit_unit');  	
	var get_position_id = localStorage.getItem('edit_position');  
	
  
<!-- debug	var get_unit_name = localStorage.getItem('edit_unit_name');   --!>
<!-- debug 	var get_depart_name = localStorage.getItem('edit_depart_name');   --!>
	
	 
	$('#cp_code').val(get_cp);	
	$('#gender').val(get_gender);
	$('#first_name').val(get_firstt_name);
	$('#last_name').val(get_last_name);	
	$('#edit_dp_id').val(get_depart_id);
	$('#edit_unit_id').val(get_unit_id);
	$('#edit_post_id').val(get_position_id);
	
<!--	$('#unit_name').val(get_unit_name);  --!>
<!--	$('#depart_name').val(get_depart_name);   !-->    
	

  

 });
</script>

</html>