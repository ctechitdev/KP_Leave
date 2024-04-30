<html>
<?php
include('../function/database_connection.php');
?>  
<div class="form-group">
	<label> ຊື່ ພະແນກ/ໜ່ວຍງານ </label>
	<select     name="dp_id" id="dp_id" required="" class="form-control font" aria-invalid="false">
											<option value=""> ເລືອກ ພະແນກ/ໜ່ວຍງານ </option> 
											<?php
											$stmt = $connect->prepare("SELECT depart_id,depart_name FROM tbl_depart");
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

<div class="form-group">
 <label> ຊື່ຝ່າຍ </label>
  <input type="text" name="unit_name" id="unit_name" class="form-control" />
</div>

 

<script>
 $(document).ready(function () {

 
	var departid = localStorage.getItem('dpid');  
	var unitname = localStorage.getItem('unname');  
 
 
	$('#dp_id').val(departid);	
	$('#unit_name').val(unitname); 

  

 });
</script>

</html>