<?php  
 //insert.php  
include "../database_connection.php";
  
 
 $leave_type = $_POST['rdLeaveType']; 
 
 if($leave_type == "1"){
	 

	 
	 
	 ?>
	     
		<div class="card"> 
		<div class="card-block">  
											
		<div class="form-group col-md-12">
			<h1 class="card-title text-center"> ຕິດຕາມການເຄືອນໄຫວ </h2>
		</div>

		<div class="form-body">
		<div class="row p-t-20"> 
		 
		
		<div class="form-group col-md-4">
		<label for="inputEmail"> ກິດຈະກຳ  </label> 
		<select class="form-control font" name="act_id" id ="act_id" required>
		<option value=""> ເລືອກ ກິດຈະກຳ </option> 
		<?php
		$stmt = $connect->prepare(" select * from tbl_activity_type ");
		$stmt->execute();
		if($stmt->rowCount() > 0)
		{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
		?> <option value="<?php echo $row['at_id']; ?>"> <?php echo $row['act_name']; ?></option> 
		<?php   
		}
		}
		?>
		</select>
		</div>
		
		<div class="form-group col-md-8">
		</div>
		
		<div class="col-md-4">
		<div class="form-group">
		<label class="control-label"> ຊື່ສະຖານທີ່  </label>
		<div class="controls">
		<input type="text" name="locate_name" class="form-control font" value="" required > 
		</div> 
		</div> 
		</div>
		
		<div class="form-group col-md-3">
		<label for="inputEmail"> ເມືອງ </label>

		<select   name="district"  required="" class="form-control font" aria-invalid="false">
		<option value=""> ເມືອງ </option> 
		<?php
		$stmt = $connect->prepare("SELECT * FROM tbl_district");
		$stmt->execute();
		if($stmt->rowCount() > 0)
		{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
		?> <option value="<?php echo $row['dt_id']; ?>"> <?php echo $row['dt_name']; ?></option> 
		<?php   
		}
		}
		?>
		</select>
		</div>
		
		<div class="col-md-3">
		<div class="form-group">
		<label class="control-label"> ບ້ານ  </label>
		<div class="controls">
		<input type="text" name="village_name" class="form-control font" value="" required > 
		</div> 
		</div> 
		</div>
		
	 

	 
		
		<div class="col-md-9" id="result2">
		<div class="form-group">
		<div class="card"> 
		<div class="card-block"> 

		<div class="form-body">
		<div class="row p-t-20">
		
			
		
			<div class="col-md-4">
			<div class="form-group">
			
			<div class="input-daterange input-group" id="flight-datepicker">
			<div class="form-item text-center">
			<span  > ວັນທີ່ເຄືອນໄຫວ </span>
			<input class="input-sm form-control font text-center" type="text" id="start-date" name="date_act" placeholder=" ກົດເລືອກວັນທີ "  />

			</div>
		 
			</div>  
			
			</div> 
			</div>


			<div class="col-md-4">
			<div class="form-group"><br><br>
			<label class="control-label"> ແຕ່ເວລາ  </label>
			<div class="controls input-group clockpicker pull-center"  data-autoclose="true">
			<input type='text' name='hour_from' class='form-control  '   >
			<span class='input-group-addon'>
			<span class='fa fa-clock-o'></span>
			</span>
			</div> 
			</div> 
			</div>

			<div class="col-md-4">
			<div class="form-group"><br><br>
			<label class="control-label"> ຫາເວລາ  </label>
			<div class="controls input-group clockpicker pull-center"  data-autoclose="true">
			<input type='text' name='hour_to' class='form-control  '   >
			<span class='input-group-addon'>
			<span class='fa fa-clock-o'></span>
			</span>
			</div> 
			</div> 
			</div> 
			
		</div> 
		</div>
		</div> 
		</div>
		 
		</div>
		 
		</div>
		
		<div class="col-md-12">
		<div class="form-group">
		<label class="control-label"> ລາຍລະອຽດກິດຈະກຳ    </label>
		<div class="controls">
		<textarea type="text" name="detail_act" class="form-control font" value=""   > </textarea>
		</div> 
		</div> 
		</div>

	
		
		<div class="col-md-12">
		<div class="form-group">
		<label class="control-label"> ລາຍລະອຽດຜູ້ຮ່ວມ (ຖ້າມີ ຂຽນຊື່ ພ້ອມເບີໂທຜູ້ຮ່ວມກິດຈະກຳ )   </label>
		<div class="controls">
		<textarea type="text" name="join_person" class="form-control font" value=""   > </textarea>
		</div> 
		</div> 
		</div>
		
		
		
		
		
 
		</div> 
		
		

		</div>
		</div> 
		</div>
		 
 
	  <?php    
 } else if($leave_type == "2"){
	 

	 
	 
	 ?>
	     
		<div class="card"> 
		<div class="card-block"> 
		 
		<div class="form-group col-md-12">
			<h1 class="card-title text-center"> ຕິດຕາມອາການຕົນເອງ </h2>
		</div>

		<div class="form-body">
		<div class="row p-t-20"> 
		  
		<div class="form-group col-md-4">
		<label for="inputEmail"> ອາການ  </label> 
		<select class="form-control font" name="stt_id" id ="stt_id" required>
		<option value=""> ສະແດງອາການ </option> 
		<?php
		$stmt = $connect->prepare(" select * from tbl_symptoms_type ");
		$stmt->execute();
		if($stmt->rowCount() > 0)
		{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
		?> <option value="<?php echo $row['st_id']; ?>"> <?php echo $row['st_name']; ?></option> 
		<?php   
		}
		}
		?>
		</select>
		</div>
	 
		 
	 
		
			
		
			<div class="col-md-4">
			<div class="form-group">
			
			<div class="input-daterange input-group" id="flight-datepicker">
			<div class="form-item text-center">
			<span  > ວັນທີ່ </span>
			<input class="input-sm form-control font text-center" type="text" id="start-date" name="date_fl" placeholder=" ກົດເລືອກວັນທີ "  />

			</div>
		 
			</div>  
			
			</div> 
			</div>
 
		
		<div class="col-md-12">
		<div class="form-group">
		<label class="control-label"> ລາຍລະອຽດອາການ    </label>
		<div class="controls">
		<textarea type="text" name="own_follow" class="form-control font" value=""   > </textarea>
		</div> 
		</div> 
		</div>

	
		
		<div class="col-md-12">
		<div class="form-group">
		<label class="control-label"> ລາຍລະອຽດສຳພັດກັບຜູ້ປິ່ນປົວ   </label>
		<div class="controls">
		<textarea type="text" name="partner_follow" class="form-control font" value=""   > </textarea>
		</div> 
		</div> 
		</div>
		
		
		
		
		
 
		</div> 
		
		

		</div>
		</div> 
		</div>
		 
 
	  <?php    
 } 
 else{
	   ?>
			
		<div class="card"> 
		<div class="card-block"> 
		
		<div class="form-group col-md-12">
			<h1 class="card-title text-center"> ຕິດຕາມອາການຄົນໄກ້ຕົວ </h2>
		</div>

		<div class="form-body">
		<div class="row p-t-20"> 
		
		<div class="col-md-3">
		<div class="form-group">
		<label class="control-label"> ຊື່ຜູ້ປ່ວຍ  </label>
		<div class="controls">
		<input type="text" name="fl_name" class="form-control font" value="" required > 
		</div> 
		</div> 
		</div>
		
		<div class="col-md-2">
		<div class="form-group">
		<label class="control-label"> ຄວາມສຳພັນ  </label>
		<div class="controls">
		<input type="text" name="relations" class="form-control font" value="" required > 
		</div> 
		</div> 
		</div>
		 
		
		<div class="form-group col-md-3">
		<label for="inputEmail"> ອາການ  </label> 
		<select class="form-control font" name="stt_id" id ="stt_id" required>
		<option value=""> ສະແດງອາການ </option> 
		<?php
		$stmt = $connect->prepare(" select * from tbl_symptoms_type ");
		$stmt->execute();
		if($stmt->rowCount() > 0)
		{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
		?> <option value="<?php echo $row['st_id']; ?>"> <?php echo $row['st_name']; ?></option> 
		<?php   
		}
		}
		?>
		</select>
		</div> 
			
		
			<div class="col-md-4">
			<div class="form-group">
			
			<div class="input-daterange input-group" id="flight-datepicker">
			<div class="form-item text-center">
			<span  > ວັນທີ່ </span>
			<input class="input-sm form-control font text-center" type="text" id="start-date" name="date_fl" placeholder=" ກົດເລືອກວັນທີ "  />

			</div>
		 
			</div>  
			
			</div> 
			</div>
 
		
		<div class="col-md-12">
		<div class="form-group">
		<label class="control-label"> ລາຍລະອຽດອາການ    </label>
		<div class="controls">
		<textarea type="text" name="own_follow" class="form-control font" value=""   > </textarea>
		</div> 
		</div> 
		</div>

	
		
		<div class="col-md-12">
		<div class="form-group">
		<label class="control-label"> ລາຍລະອຽດສຳພັດກັບຜູ້ປ່ວຍ </label>
		<div class="controls">
		<textarea type="text" name="partner_follow" class="form-control font" value=""   > </textarea>
		</div> 
		</div> 
		</div>
		
		
		
		
		
 
		</div> 
		
		

		</div>
		</div> 
		</div>
	   
			
	   
	   
	   
		 

	    <?php
 }
 
  
 ?>  
<script src='js/jquery.dateFormat.js'></script>
<script  src="js/date_picker.js"></script>
 <script type="text/javascript">
$('.clockpicker').clockpicker()
	.find('input').change(function(){
		console.log(this.value);
	});
var input = $('#single-input').clockpicker({
	placement: 'bottom',
	align: 'left',
	autoclose: true,
	'default': 'now'
});

 
 
</script>

