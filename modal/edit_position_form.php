<html>

<?php
 session_start();
include('../function/database_connection.php');

$full_name = $_SESSION["full_name"];

?>  

 	<script type="text/javascript" src="js/jquery.min.js"></script>      <!-- jQuery -->
 	<script>
		$(function(){
			
	  $('#edit_dp_id').change(function(){
			var edit_dp_id=$('#edit_dp_id').val();
			$.post('function/dynamic_dropdown/get_unit_name.php',{
				edit_dp_id:edit_dp_id
			},
			function(output){
				$('#edit_unit_id').html(output).show();
			});
		});
		
		
		
		});
	</script>
<?php
//debug
 //echo"test $full_name";

?>
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
									<option value=""> ເລືອກຝ່າຍ </option> 
									<?php
									$stmt = $connect->prepare(" select unit_id, unit_name from tbl_depart_unit where unit_id = '$full_name' ");
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
									
									
									 
 

<div class="form-group">
 <label> ຕຳແໜ່ງ </label>
  <input type="text" name="post_name" id="post_name" class="form-control" />
</div>
 
 
<!--
debug

<div class="form-group">
 <label> ຝ່າຍ </label>
  <input type="text" name="unit_name" id="unit_name" class="form-control" />
</div>

 

<div class="form-group">
 <label> ພະແນກ </label>
  <input type="text" name="depart_name" id="depart_name" class="form-control" />
</div>

 -->

 
 

<script>
 $(document).ready(function () {

	var get_depart_id = localStorage.getItem('edit_depart_id');
	var get_unit_id = localStorage.getItem('edit_unit_id');  	
	var get_post_name = localStorage.getItem('edit_post_name');  
	
<!-- debug	var get_unit_name = localStorage.getItem('edit_unit_name');   --!>
<!-- debug 	var get_depart_name = localStorage.getItem('edit_depart_name');   --!>
	
	
 
 
	$('#post_name').val(get_post_name);	
	$('#edit_unit_id').val(get_unit_id);
	$('#edit_dp_id').val(get_depart_id);
	
<!--	$('#unit_name').val(get_unit_name);  --!>
<!--	$('#depart_name').val(get_depart_name);   !-->    
	

  

 });
</script>

</html>