<?php
 include "checksession.php";
 include "function/database_connection.php";

 
   $check_error ="";
 

	if(isset($_POST['btninsert'])) { 


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
			$stmt->bindParam(':stfid',$staff_id);
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
			$stmt->bindParam(':stfid',$staff_id);
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
			$stmt->bindParam(':stfid',$staff_id);
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
                                         
											<div class="form-group col-md-6">
											<label for="inputEmail"> ຊື່ພະນັກງານ :  </label> <label for="inputEmail"> <?php echo "$staff_gender $staff_first_name $staff_last_name";?> </label>
											</div>	  
											
											<div class="form-group col-md-6">
											<label for="inputEmail"> ລະຫັດພະນັກງານ :  </label> <label for="inputEmail"> <?php echo "$staff_code  ";?> </label>
											</div>

											<div class="form-group col-md-4">
											<label for="inputEmail"> ຕຳແໜ່ງ :  </label> <label for="inputEmail"> <?php echo "$staff_position  ";?> </label>
											</div>
											<div class="form-group col-md-4">
											<label for="inputEmail"> ພະແນກ/ໜ່ວຍງານ :  </label> <label for="inputEmail"> <?php echo "$select_staff_depart  ";?> </label>
											</div>
											<div class="form-group col-md-4">
											<label for="inputEmail"> ຝ່າຍ :  </label> <label for="inputEmail"> <?php echo "$staff_unit  ";?> </label>
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
									<table id='demo-foo-addrow2' class='table ' >
                                    
							 
									 
                                    <tbody>
									 <?PHP
							
										$stmt = $connect->prepare(" 
										
										(select distinct staff_id,date_atv from tbl_time_line where  staff_id ='$staff_id' ) 
										union all 
										(select distinct staff_id,date_follow from tbl_symptoms_follow where  staff_id ='$staff_id' ) order by date_atv desc
										  ");
										
										$stmt->execute();
										if($stmt->rowCount() > 0)
										{
										while($row=$stmt->fetch(PDO::FETCH_ASSOC))
										{
										 
										$sdate_atv = $row['date_atv']; 
									 
										?>

										<tr>   
									 
										<td class = 'tdr' ><?php echo "$sdate_atv";?></td>
										<td  class ='tdl' >

										<?php
										
										$stmt2 = $connect->prepare("
										
										select staff_id,act_name,location_name,village_name,dt_name,date_atv,start_atv,stop_atv, 
										(case when detail_atv = '' then 'ບໍ່ມີ' else detail_atv end) as detail_atv,
										(case when detail_partnert = '' then 'ບໍ່ມີ' else detail_partnert end) as detail_partnert, 1 as type_time_line,add_by
										from tbl_time_line a
										left join tbl_activity_type b on a.atv_id = b.at_id  
										left join tbl_district c on a.district_id = c.dt_id
										where  staff_id ='$staff_id' and date_atv = '$sdate_atv'
										union all
										SELECT staff_id,(case when stf_type = 2 then 'ຕິດຕາມອາການໂຕເອງ' else 'ຕິດຕາມອາການຄົນໄກ້ໂຕ' end) as stf_type ,st_name,partner_name,partner_relation,date_follow,'','', 
										(case when dt_owner = '' then 'ບໍ່ມີ' else dt_owner end) as dt_owner,
										(case when dt_join = '' then 'ບໍ່ມີ' else dt_join end) as dt_join,
										stf_type as type_time_line,add_by
										FROM tbl_symptoms_follow a 
										left join tbl_symptoms_type b on a.st_id = b.st_id
										where  staff_id ='$staff_id' and date_follow = '$sdate_atv'
										 
										  ");
										
										$stmt2->execute();
										if($stmt2->rowCount() > 0)
										{
										while($row2=$stmt2->fetch(PDO::FETCH_ASSOC))
										{
										$act_name = $row2['act_name']; 
										$location_name = $row2['location_name'];  
										$village_name = $row2['village_name']; 
										$dt_name = $row2['dt_name']; 
										$date_atv = $row2['date_atv']; 
										$start_atv = $row2['start_atv'];
										$stop_atv = $row2['stop_atv'];
										$detail_atv = $row2['detail_atv'];
										$detail_partnert = $row2['detail_partnert'];
										$type_time_line = $row2['type_time_line'];
										
										 
										if($type_time_line == 1){
										  echo "$start_atv ຫາ $stop_atv $act_name ທີ່ $location_name ບ້ານ $village_name ເມືອງ $dt_name <br>";   
										  echo "ເຄື່ອນໄຫວ: $detail_atv <br> ມີຜູ້ຮ່ວມ $detail_partnert <br> ";
											
										}
										if($type_time_line == 2){
										  echo " $act_name  ອາການ $location_name $village_name  $dt_name <br>";   
										  echo "ລາຍລະອຽດ: $detail_atv <br> ການຖືກສຳພັດ $detail_partnert <br> ";
											
										}
										if($type_time_line == 3){
										  echo " $act_name  ອາການ $location_name $village_name  $dt_name <br>";   
										  echo "ລາຍລະອຽດ: $detail_atv <br> ສຳພັດໂດຍ $detail_partnert <br> ";
											
										}
										
										  
										  ?> 
										
										<br>
										<?php
										
										}
										}
										
										?>
										</td>   


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
				 <h3 class="modal-title" style="color: green" > ການລົງທະບຽນ ຂໍ້ມູນ ສຳເລັດ  </h3>
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
