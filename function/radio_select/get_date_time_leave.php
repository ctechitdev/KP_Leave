<?php  
 //insert.php  
 
 
 
 $leave_type = $_POST['rdLeaveType']; 
 
 if($leave_type == "1"){
	 ?>
	     
		<div class="card"> 
		<div class="card-block"> 

		<div class="form-body">
		<div class="row p-t-20"> 
		
		<div class="input-daterange input-group" id="flight-datepicker">
		<div class="form-item text-center">
		<span  >ລາວັນທີ </span>
		<input class="input-sm form-control font text-center" type="text" id="start-date" name="date_from" placeholder=" ກົດເລືອກວັນທີ "  />

		</div>
		<div class="form-item text-center">
		<span  >ຫາວັນທີ </span>
		<input class="input-sm form-control font text-center" type="text" id="end-date" name="date_to" placeholder=" ກົດເລືອກວັນທີ "  />

		</div>
		</div> 
 
		</div> 
		</div>
		</div> 
		</div>
		 
 
	  <?php    
 }else{
	   ?>
			
			<div class="card"> 
		<div class="card-block"> 

		<div class="form-body">
		<div class="row p-t-20">
		
			
		
			<div class="col-md-4">
			<div class="form-group">
			
			<div class="input-daterange input-group" id="flight-datepicker">
			<div class="form-item text-center">
			<span  > ລາວັນທີ </span>
			<input class="input-sm form-control font text-center" type="text" id="start-date" name="date_leave" placeholder=" ກົດເລືອກວັນທີ "  />

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

