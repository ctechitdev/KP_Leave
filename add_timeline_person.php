<?php
 include "checksession.php";
 include "function/database_connection.php";

 
   $check_error ="";
 

	if(isset($_POST['btninsert'])) { 
	
	
		$staff_ct = $_POST['staff_ct'];

		$rdLeaveType = $_POST['rdLeaveType'];

		if(empty($rdLeaveType)) {
		$check_error  = "yes";
		}
		
		//   data time line tag 
		
		if ($rdLeaveType == 1){
			
			$act_id = $_POST['act_id']; 
			$locate_name = $_POST['locate_name'];  
			$district = $_POST['district'];  
			$village_name = $_POST['village_name']; 
			
			$hour_from = $_POST['hour_from']; 
			$hour_to = $_POST['hour_to']; 
			$detail_act = $_POST['detail_act']; 
			$join_person = $_POST['join_person']; 
	 
			$date_register = date("Y-m-d");
			
			$get_date_act = $_POST['date_act'];  
			$act_date = str_replace('/', '-', $get_date_act);
			$date_act = date('Y-m-d', strtotime($act_date));
			
			
			
			if( (empty($act_id)) ||  (empty($locate_name)) ||  (empty($village_name)) ||  (empty($date_act)) ||  (empty($hour_from)) || (empty($hour_to)) ){
					$check_error  = "yes";
				}
		
		if( $check_error !="yes" ){
			 
			$stmt = $connect->prepare('INSERT INTO tbl_time_line (staff_id,atv_id,location_name,district_id,village_name,date_atv,start_atv,stop_atv,detail_atv,detail_partnert,date_register, add_by  )
			VALUES(:stfid, :atid, :loname, :disid, :vname,:dact, :hfrom, :hto, :dtact, :dtjoinp, :drs, :aby )');
			$stmt->bindParam(':stfid',$staff_ct);
			$stmt->bindParam(':atid',$act_id); 
			$stmt->bindParam(':loname',$locate_name);
			$stmt->bindParam(':disid',$district); 
			$stmt->bindParam(':vname',$village_name); 
			$stmt->bindParam(':dact',$date_act); 
			$stmt->bindParam(':hfrom',$hour_from); 
			$stmt->bindParam(':hto',$hour_to); 
			$stmt->bindParam(':dtact',$detail_act); 
			$stmt->bindParam(':dtjoinp',$join_person); 
			$stmt->bindParam(':drs',$date_register);
			$stmt->bindParam(':aby',$user_ids); 
			$stmt->execute();
			
			$show_modal = 1;
			 
			
			
		} else{
			$show_modal = 2;
		}
			
			
		}
		
		// end data time line tag
		
		
		//   data person tag 
		
		if ($rdLeaveType == 2){
			
			$stt_id = $_POST['stt_id'];     
			  
			$get_date_fl = $_POST['date_fl'];  
			$follow_date = str_replace('/', '-', $get_date_fl);
			$date_fl = date('Y-m-d', strtotime($follow_date));
			
			
			$own_follow = $_POST['own_follow']; 
			$partner_follow = $_POST['partner_follow']; 
			
			$date_register = date("Y-m-d");
			
			if( (empty($stt_id)) ||     (empty($get_date_fl)) ){
					$check_error  = "yes";
				}
 
		if( $check_error !="yes" ){
			 
			$stmt = $connect->prepare('INSERT INTO tbl_symptoms_follow (staff_id,stf_type,st_id, date_follow, dt_owner, dt_join, date_register, add_by )
			VALUES(:stfid, 2, :stt, :dfl, :wfl,:pnfl, :drs, :aby )');
			$stmt->bindParam(':stfid',$staff_ct);
			$stmt->bindParam(':stt',$stt_id);   
			$stmt->bindParam(':dfl',$date_fl);  
			$stmt->bindParam(':wfl',$own_follow); 
			$stmt->bindParam(':pnfl',$partner_follow); 
			$stmt->bindParam(':drs',$date_register);
			$stmt->bindParam(':aby',$user_ids); 
			$stmt->execute();
			
			$show_modal = 1;
			 
			
			
		} else{
			$show_modal = 2;
		}
			
			
		}
		
		// end data person tag
		
		
		//   data join person tag 
		
		if ($rdLeaveType == 3){
			
			
			
			 
			
			$stt_id = $_POST['stt_id'];     
			
			$fl_name = $_POST['fl_name'];   
			$relations = $_POST['relations'];  
			  
			$get_date_fl = $_POST['date_fl'];  
			$follow_date = str_replace('/', '-', $get_date_fl);
			$date_fl = date('Y-m-d', strtotime($follow_date));
			
			
			$own_follow = $_POST['own_follow']; 
			$partner_follow = $_POST['partner_follow']; 
			
			$date_register = date("Y-m-d");
			
			if( (empty($stt_id)) || (empty($fl_name)) || (empty($relations)) || (empty($get_date_fl)) ){
					$check_error  = "yes";
				}
 
		if( $check_error !="yes" ){
			 
			$stmt = $connect->prepare('INSERT INTO tbl_symptoms_follow (staff_id,stf_type,st_id,partner_name,partner_relation,  date_follow, dt_owner, dt_join, date_register, add_by )
			VALUES(:stfid, 3, :stt, :fln, :rls, :dfl, :wfl,:pnfl, :drs, :aby )');
			$stmt->bindParam(':stfid',$staff_ct);
			$stmt->bindParam(':stt',$stt_id);
			$stmt->bindParam(':fln',$fl_name);
			$stmt->bindParam(':rls',$relations);
			$stmt->bindParam(':dfl',$date_fl);  
			$stmt->bindParam(':wfl',$own_follow); 
			$stmt->bindParam(':pnfl',$partner_follow); 
			$stmt->bindParam(':drs',$date_register);
			$stmt->bindParam(':aby',$user_ids); 
			$stmt->execute();
			
			$show_modal = 1;
			 
			
			
		} else{
			$show_modal = 2;
		}
			
			
		}
		
		// end data join person tag



	}


?>

<!DOCTYPE html>
<html lang="en">

 
 
 
<head>
 
<script type="text/javascript" src="js/jquery.min.js"></script>      <!-- jQuery -->
 	<script>
		$(function(){
			
	 
		
		$('#dp_id').change(function(){
			var dp_id=$('#dp_id').val();
			$.post('function/dynamic_dropdown/get_unit_name.php',{
				dp_id:dp_id
			},
			function(output){
				$('#unit_id').html(output).show();
			});
		});
		
		$('#unit_id').change(function(){
			var unit_id=$('#unit_id').val();
			$.post('function/dynamic_dropdown/get_position_name.php',{
				unit_id:unit_id
			},
			function(output){
				$('#pos_id').html(output).show();
			});
		});
		
		
		$('#pos_id').change(function(){
			var pos_id=$('#pos_id').val();
			$.post('function/dynamic_dropdown/get_staff_name.php',{
				pos_id:pos_id
			},
			function(output){
				$('#staff_ct').html(output).show();
			});
		});
		
		
		});
		

		
	</script>
   
 

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
                                             
											 
											
											 <div class="form-group col-md-12">
											<h1 class="card-title text-center"> ຕິດຕາມຂໍ້ມູນຊ່ວງ COVID-19 </h2>
											</div>
											
											<div class="form-group col-md-3">
											<label for="inputEmail"> ພະແນກ/ໜ່ວຍງານ </label> 
											<select class="form-control font" name="dp_id" id ="dp_id">
											<option value=""> ເລືອກພະແນກ </option> 
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
											
											
											
											<div class="form-group col-md-3">
											<label for="inputEmail"> ຝ່າຍ  </label>

											<select class="form-control font" name="unit_id" id ="unit_id">
											<option value=""> ເລືອກ ຝ່າຍ </option> 
											</select>
											</div>
											
											<div class="form-group col-md-3">
											<label for="inputEmail"> ຕຳແໜ່ງ  </label>

											<select class="form-control font" name="pos_id" id ="pos_id">
											<option value=""> ເລືອກ ຕຳແໜ່ງ </option> 
											</select>
											</div>
											
											<div class="form-group col-md-3">
											<label for="inputEmail"> ພະນັກງານ  </label>

											<select class="form-control font" name="staff_ct" id ="staff_ct">
											<option value=""> ເລືອກ ພະນັກງານ </option> 
											</select>
											</div> 
											 
  
											
											<div class="col-md-6">
											<div class="form-group">
											<label class="control-label"> ການຕິດຕາມ <span class="text-danger">*</span></label><br>
											 
											 
											<input type="radio" name="rdLeaveType" id="rdLeaveType"   value="1" >  ຕິດຕາມການເຄືອນໄຫວ  
											<input type="radio" name="rdLeaveType"  id="rdLeaveType"  value="2" >  ຕິດຕາມອາການຕົນເອງ
											<input type="radio" name="rdLeaveType"  id="rdLeaveType"  value="3" >  ຕິດຕາມອາການຄົນໄກ້ຕົວ
											
											</div>
											</div>
											
											<div class="col-md-12" id="result2">
											<div class="form-group">
											 
											 
											</div>
											</div>
 							   
											    
                                            </div>
											
											<div class=" text-center">
											<button type="submit"  name="btninsert"  class="btn btn-success font"> <i class="fa fa-check"></i> ສົ່ງຂໍ້ມູນ </button>
											<button type="reset" class="btn btn-danger font"><i class="mdi mdi-close-outline"></i> ຍົກເລີກ </button>
											</div>
											
                                            </div>
                                        </div>
									   </div>   
									
                                </form>
						
						 
						 
                                            
                                        </div>
											<div class="text-center" align = "center">
											
											
											</div>
									   </div>   
								
                               
								
                            </div>
                            
                            <div class="container-fluid">
              <div class="row" id="row">
			      <div class="col-12">
				  
				  
							<div class="card">
							<div class="card-block">
							 
								<h4 class="card-title text-center"> ຂໍ້ມູນ Timeline </h4>
								<div class="table-responsive">
									 <table id='demo-foo-addrow2' class='table table-bordered table-sm table-hover toggle-circle' >
                                    
								<thead class="btn-info">
									<tr> 
									<th scope="col"  > ກິດຈະກຳ </th>
									<th scope="col"  > ສະຖານທີ່ </th> 
									<th scope="col"  > ບ້ານ </th> 
									<th scope="col"  > ເມືອງ </th>  
									<th scope="col"  > ວັນທີເຄື່ອນໄຫວ </th>  
									<th scope="col"  > ເວລາເລິ່ມ </th> 
									<th scope="col"  > ເວລາສິ້ນສຸດ </th>
									<th scope="col"  > ເນື້ອໃນ </th>
									<th scope="col"  > ຜູ້ກ່ຽວຂ້ອງ </th>
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
										
										(select staff_id,act_name,location_name,village_name,dt_name,date_atv,start_atv,stop_atv, 
										(case when detail_atv = '' then 'ບໍ່ມີ' else detail_atv end) as detail_atv,
										(case when detail_partnert = '' then 'ບໍ່ມີ' else detail_partnert end) as detail_partnert, 1 as type_time_line,add_by
										from tbl_time_line a
										left join tbl_activity_type b on a.atv_id = b.at_id  
										left join tbl_district c on a.district_id = c.dt_id
										where   add_by ='$user_ids'  )
										
										union all
										
										(SELECT staff_id,(case when stf_type = 2 then 'ຕິດຕາມອາການໂຕເອງ' else 'ຕິດຕາມອາການຄົນໄກ້ໂຕ' end) as stf_type ,st_name,partner_name,partner_relation,date_follow,'','', 
										(case when dt_owner = '' then 'ບໍ່ມີ' else dt_owner end) as dt_owner,
										(case when dt_join = '' then 'ບໍ່ມີ' else dt_join end) as dt_join,
										stf_type as type_time_line,add_by
										FROM tbl_symptoms_follow a 
										left join tbl_symptoms_type b on a.st_id = b.st_id
										where   add_by ='$user_ids'  )
										order by date_atv desc
 
										  ");
										
										$stmt->execute();
										if($stmt->rowCount() > 0)
										{
										while($row=$stmt->fetch(PDO::FETCH_ASSOC))
										{
										$act_name = $row['act_name']; 
										$location_name = $row['location_name'];  
										$village_name = $row['village_name']; 
										$dt_name = $row['dt_name']; 
										$date_atv = $row['date_atv']; 
										$start_atv = $row['start_atv'];
										$stop_atv = $row['stop_atv'];
										$detail_atv = $row['detail_atv'];
										$detail_partnert = $row['detail_partnert'];
									 
										?>

										<tr>   
										<td><?php echo "$act_name";?></td>
										<td><?php echo "$location_name";?></td> 
										<td><?php echo "$village_name";?></td> 
										<td><?php echo "$dt_name";?></td>  
										<td><?php echo "$date_atv";?></td>  
										<td><?php echo "$start_atv";?></td>  
										<td><?php echo "$stop_atv";?></td>
										<td><?php echo "$detail_atv";?></td>  
										<td><?php echo "$detail_partnert";?></td>


										</td>

										</tr>

										<?php
									 
											}
											}

							?>
                                    </tbody>
									 <tfoot>
                                        <tr>
                                            <td colspan="9">
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
           <?php include "footer.php";?>
            <!-- End footer -->
        </div>
    </div>
	<?php
	if($show_modal != ""){
		
	
	
	?>
<script>
	$(document).ready(function(){
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
			if ($show_modal == 1){
				?>
				 <h3 class="modal-title" style="color: green" > ການລົງທະບຽນ ຂໍລາພັກ ສຳເລັດ  </h3>
				<?php
			}else {
				?>
				 <h3 class="modal-title" style="color: red" > ຂໍ້ມູນບໍ່ຄົບຖ້ວນ   </h3>
				<?php
			}
			
$show_modal = "";
$message_request ="";
$_SESSION['message_request'] = "";

			?>
               
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
             
        </div>
    </div>
	
<script>  
 $(document).ready(function(){  
      $('input[type="radio"]').click(function(){  
           var rdLeaveType = $(this).val();  
           $.ajax({  
                url:"function/radio_select/get_form_timeline.php",  
                method:"POST",  
                data:{rdLeaveType:rdLeaveType},  
                success:function(data){  
                     $('#result2').html(data);  
                }  
           });  
      });  
 });  
 </script>  
 





	<?php include "javascript.php";?>
</body>

</html>
